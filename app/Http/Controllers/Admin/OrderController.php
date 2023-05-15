<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $pageTitle = "All Orders";
        $orders    = $this->orderData();
        return view('admin.order.index', compact('pageTitle', 'orders'));
    }

    public function pending()
    {
        $pageTitle = "Pending Orders";
        $orders    = $this->orderData('pending');
        return view('admin.order.index', compact('pageTitle', 'orders'));
    }

    public function processing()
    {
        $pageTitle = "Processing Orders";
        $orders    = $this->orderData('processing');
        return view('admin.order.index', compact('pageTitle', 'orders'));
    }

    public function completed()
    {
        $pageTitle = "Completed Orders";
        $orders    = $this->orderData('completed');
        return view('admin.order.index', compact('pageTitle', 'orders'));
    }

    public function cancelled()
    {
        $pageTitle = "Cancelled Orders";
        $orders    = $this->orderData('cancelled');
        return view('admin.order.index', compact('pageTitle', 'orders'));
    }

    public function refunded()
    {
        $pageTitle = "Refunded Orders";
        $orders    = $this->orderData('refunded');
        return view('admin.order.index', compact('pageTitle', 'orders'));
    }

    protected function orderData($scope = null)
    {
        if ($scope) {
            $orders = Order::$scope();
        } else {
            $orders = Order::query();
        }
        return $orders->searchable(['user:username', 'category:name', 'service:name'])->with(['category', 'user', 'service'])->orderBy('id', 'desc')->paginate(getPaginate());
    }

    public function details($id)
    {
        $pageTitle = 'Order Details';
        $order     = Order::findOrFail($id);
        return view('admin.order.details', compact('pageTitle', 'order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::with('user', 'category')->findOrFail($id);

        $request->validate([
            'start_count' => 'required|integer|gte:0|lte:' . $order->quantity,
            'status'      => 'required|integer|in:0,1,2,3,4',
        ]);
        $order->start_counter = $request->start_count;
        $order->remain        = ($order->quantity - $request->start_count);
        $user                 = $order->user;

        if ($request->status == Status::ORDER_PROCESSING) {
            $order->status = Status::ORDER_PROCESSING;
            $order->save();

            notify($user, 'PROCESSING_ORDER', [
                'service_name'  => $order->service->name,
                'username' => $order->user->username,
                'price' => $order->price,
                'full_name' => $order->user->fullname,
                'category' => $order->category->name

            ]);
        }

        //Complete Order
        if ($request->status == Status::ORDER_COMPLETED) {
            $order->status = Status::ORDER_COMPLETED;
            $order->save();
            //Send email to user
            notify($user, 'COMPLETED_ORDER', [
                'service_name' => $order->service->name,
                'username' => $order->user->username,
                'price' => $order->price,
                'full_name' => $order->user->fullname,
                'category' =>  $order->category->name
            ]);
        }

        //Cancelled
        if ($request->status == Status::ORDER_CANCELLED) {
            $order->status = Status::ORDER_CANCELLED;
            $order->save();

            //Send email to user
            notify($user, 'CANCELLED_ORDER', [
                'service_name' => $order->service->name,
                'username' => $order->user->username,
                'full_name' => $order->user->fullname,
                'price' => $order->price,
                'category' => $order->category->name
            ]);
        }

        //Refunded
        if ($request->status == Status::ORDER_REFUNDED) {
            if ($order->status == Status::ORDER_COMPLETED || $order->status == Status::ORDER_CANCELLED) {
                $notify[] = ['error', 'This order is not refundable'];
                return back()->withNotify($notify);
            }

            $order->status = Status::ORDER_REFUNDED;
            $order->save();

            //Refund balance
            $user->balance += $order->price;
            $user->save();

            //Create Transaction
            $transaction               = new Transaction();
            $transaction->user_id      = $user->id;
            $transaction->amount       = $order->price;
            $transaction->post_balance = $user->balance;
            $transaction->trx_type     = '+';
            $transaction->remark       = "refund_order";
            $transaction->details      = 'Refund for Order ' . $order->service->name;
            $transaction->trx          = getTrx();
            $transaction->save();

            //Send email to user

            notify($user, 'REFUNDED_ORDER', [
                'service_name' => $order->service->name,
                'price'        => getAmount($order->price),
                'currency'     => gs()->cur_text,
                'post_balance' => getAmount($user->balance),
                'trx'          => $transaction->trx,
            ]);
        }

        $order->save();
        $notify[] = ['success', 'Order successfully updated'];
        return back()->withNotify($notify);
    }
}