<?php

namespace App\Console\Commands;

use App\Models\ApiProvider;
use App\Models\GeneralSetting;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateApiOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateOrders:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update api orders status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $updatableOrders = Order::select('id', 'api_order_id','order_placed_to_api')->where('api_order', 1)
            ->where('updated_at', '>=', now()->subMinutes(60)->toDateTimeString())->get();
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
                Order::where('api_order_id', $value->order)->update(['status' => $this->setStatus($value->status)]);
            }
        }

        $xporder = collect($updatableOrders)->where('order_placed_to_api', 2)->pluck('api_order_id');
        if ($xporder->isNotEmpty()) {
            $arr = [
                'key' => $general[1]->api_key,
                'action' => "orders",
                'orders' => $xporder->pluck('api_order_id')->implode(',')
            ];
            $response = json_decode(curlPostContent($general[1]->api_url, $arr));

            foreach ($response as $id => $value) {
                Order::where('api_order_id', $id)->update(['status' => $this->setXpStatus($value->status)]);
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
                Order::where('api_order_id', $value->order)->update(['status' => $this->setStatus($value->status)]);
            }
        }
        return 'success';
    }

    public function setStatus($status)
    {
        if ($status == "In progress")
            return 1;
        elseif ($status == "Completed")
            return 2;
        elseif ($status == "Canceled")
            return 3;
        elseif ($status == "refunded")
            return 4;
        else return 0;
    }
    public function setXpStatus($status)
    {
        if ($status == "processing")
            return 1;
        elseif ($status == "completed")
            return 2;
        elseif ($status == "canceled")
            return 3;
        elseif ($status == "refunded")
            return 4;
        else return 0;
    }
}
