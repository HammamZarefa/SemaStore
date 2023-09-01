<?php

namespace App\Http\Controllers;

use App\Models\ApiProvider;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CronController extends Controller
{
    public function updateOrderApiStatus()
    {
        $updatableOrders = Order::select('id', 'api_order_id', 'order_placed_to_api')->where('api_order', 1)
            ->where('updated_at', '>=', now()->subMinutes(12)->toDateTimeString())->get();
        if (!$updatableOrders)
            die();
        $general = ApiProvider::where('status', 1)->get();

        $cashmmOrders = collect($updatableOrders)->where('order_placed_to_api', 1);
        if ($cashmmOrders->isNotEmpty()) {
            $arr = [
                'key' => $general[0]->api_key,
                'action' => "status",
                'orders' => $cashmmOrders->pluck('api_order_id')->implode(',')
            ];
            $response = json_decode(curlPostContent($general[0]->api_url, $arr));
            foreach ($response as $id => $value) {
                $order = Order::where('api_order_id', $value->order)->first();
                if ($order && isset($value->status)) {
                    $status = $this->setStatus($value->status);
                    if ($status == 3)
                        $status = 4;
                    $this->changeStatus($order, $status);
                }
            }
        }

        $xporders = collect($updatableOrders)->where('order_placed_to_api', 2);
        if ($xporders->isNotEmpty()) {
            foreach ($xporders as $order) {
                $arr = [
                    'api_key' => $general[1]->api_key,
                    'order_id' => $order->api_order_id
                ];
                Log::info($order->api_order_id);
                $response = json_decode(curlPostContent($general[1]->api_url . '/order-details', $arr));
                $order = Order::where('api_order_id', $order->api_order_id)->first();
                if ($order && isset($response->items->status)) {
                    $status = $this->setXpStatus($response->items->status);
                    if ($status != $order->status)
                        $this->changeStatus($order, $status);
                }
            }
        }

        $msaderOrder = collect($updatableOrders)->where('order_placed_to_api', 3);
        if ($msaderOrder->isNotEmpty()) {
            $arr = [
                'key' => $general[2]->api_key,
                'action' => "orders",
                'orders' => $msaderOrder->pluck('api_order_id')->implode(',')
            ];
            $response = json_decode(curlPostContent($general[2]->api_url, $arr));
            foreach ($response as $id => $value) {
                $order = Order::where('api_order_id', $value->order)->first();
                if ($order && isset($value->status)) {
                    $status = $this->setStatus($value->status);
                    if ($order->category->type == "NUMBER") {
                        if ($status == 2 && isset($value->code))
                            if ($status == 2 && isset($value->code))
                                (new OrderController())->finishNumberOrder($order->id, ["smsCode" => $value->code]);
                    } elseif ($status == 3)
                        $status = 4;
                    $this->changeStatus($order, $status);
                }
            }
        }
        return 'success';
    }

    public function setStatus($status)
    {
        $status = strtolower($status);
        if ($status == "in progress")
            return 1;
        elseif ($status == "completed")
            return 2;
        elseif ($status == "canceled")
            return 3;
        elseif ($status == "refunded")
            return 4;
        else return 0;
    }

    public
    function setXpStatus($status)
    {
        if ($status == "processing")
            return 1;
        elseif ($status == "completed")
            return 2;
        elseif ($status == "canceled")
            return 3;
        elseif ($status == "reject")
            return 4;
        else return 0;
    }

    public
    function changeStatus($order, $status)
    {
        Log::info($status);
        DB::beginTransaction();
        try {
            $user = $order->user;
            if ($status == 4) {
                if ($order->status != 4) {
                    $user->balance += $order->price;
                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->amount = $order->price;
                    $transaction->post_balance = getAmount($user->balance);
                    $transaction->trx_type = '+';
                    $transaction->details = 'استرجاع الرصيد بعد تحويل حالة الطلب الى مسترجع ' . $order->id;
                    $transaction->trx = getTrx();
                    $transaction->save();
                    if ($user->save()) {
                        $transaction->save();
                    }
                }
            }
            $order->status = $status;
            $order->save();
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

}
