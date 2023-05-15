<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Lib\CurlRequest;
use App\Models\GeneralSetting;
use App\Models\Order;

class CronController extends Controller
{
	public function placeOrderToApi()
	{
		$apiOrders          = Order::pending()->with('provider')->where('api_provider_id', '!=', Status::API_ORDER_NOT_PLACE)->where('order_placed_to_api', Status::API_ORDER_NOT_PLACE)->get();
		$general            = GeneralSetting::first();
		$general->last_cron = now();
		$general->save();

		foreach ($apiOrders as $order) {
			$response = CurlRequest::curlPostContent($order->provider->api_url, [
				'key'      => $order->provider->api_key,
				'action'   => "add",
				'service'  => $order->api_service_id,
				'link'     => $order->link,
				'quantity' => $order->quantity,
			]);
			$response = json_decode($response);

			if ($response->error) {
				echo response()->json(['error' => $response->error]) . '<br>';
				continue;
			}

			//Order placed
			$order->status              = Status::ORDER_PROCESSING;
			$order->order_placed_to_api = 1;
			$order->api_order_id        = $response->order;
			$order->save();
		}
	}

	public function serviceUpdate()
	{
		$orders             = Order::where('status', Status::ORDER_PROCESSING)->with('provider')->where('api_provider_id', '!=', 0)->where('order_placed_to_api', 1)->get();
		$general            = GeneralSetting::first();
		$general->last_cron = now();
		$general->save();

		foreach ($orders as $order) {
			$response = CurlRequest::curlPostContent($order->provider->api_url, [
				'key'    => $order->provider->api_key,
				'action' => "status",
				'order'  => $order->api_order_id,
			]);
			$response = json_decode($response);

			if ($response->error) {
				echo response()->json(['error' => $response->error]) . '<br>';
				continue;
			}

			$order->start_counter = $response->start_count;
			$order->remain        = $response->remains;

			if ($response->status == 'Completed') {
				$order->status = Status::ORDER_COMPLETED;
			}

			if ($response->status == 'Cancelled') {
				$order->status = Status::ORDER_CANCELLED;
			}

			if ($response->status == 'Refunded') {
				$order->status = Status::ORDER_REFUNDED;
			}

			$order->save();
		}
	}
}