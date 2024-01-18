<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiProvider;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{


    public function service()
    {
        $page_title = 'Inventory By Services';
        $inventories = Order::groupBy('service_id')
            ->selectRaw('*, sum(price) as sum,count(*) as count')
            ->whereNotIn('status', [0, 3, 4, 5])
            ->whereDate('created_at', Carbon::today())
            ->orderBy('category_id')
            ->get();
        $from = Carbon::now()->toDateString();
        $empty_message = 'No Result Found';
        return view('admin.inventory.service.index', compact('inventories', 'from', 'page_title', 'empty_message'));
    }

    public function serviceSearch(Request $request)
    {
        $page_title = 'Inventory By Services';
        $search = $request->all();
        $from = $request->from;
        $datefrom = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $from);
        $to = $request->to;
        $dateto = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $to);
        $inventories = Order::groupBy('service_id')
            ->selectRaw('*, sum(price) as sum,count(*) as count')
            ->whereNotIn('status', [0, 3, 4, 5])
            ->when($datefrom == 1, function ($query) use ($from) {
                return $query->whereDate("created_at", '>=', date($from));
            })
            ->when($dateto == 1, function ($query) use ($to) {
                return $query->whereDate("created_at", '<=', date($to));
            })
            ->orderBy('category_id')
            ->get();
        $empty_message = 'No Result Found';
        return view('admin.inventory.service.index', compact('inventories', 'from', 'to', 'page_title', 'empty_message'));
    }

    public function category()
    {
        $page_title = 'Inventory By Category';
        $inventories = Order::groupBy('category_id')
            ->selectRaw('*, sum(price) as sum,count(*) as count')
            ->whereNotIn('status', [0, 3, 4, 5])
            ->whereDate('created_at', Carbon::today())
            ->orderBy('category_id')
            ->get();
        $from = Carbon::now()->toDateString();
        $empty_message = 'No Result Found';
        return view('admin.inventory.category.index', compact('inventories', 'from', 'page_title', 'empty_message'));
    }

    public function categorySearch(Request $request)
    {
        $page_title = 'Inventory By Category';
        $search = $request->all();
        $from = $request->from;
        $datefrom = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $from);
        $to = $request->to;
        $dateto = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $to);
        $inventories = Order::groupBy('category_id')
            ->selectRaw('*, sum(price) as sum,count(*) as count')
            ->whereNotIn('status', [0, 3, 4, 5])
            ->when($datefrom == 1, function ($query) use ($from) {
                return $query->whereDate("created_at", '>=', date($from));
            })
            ->when($dateto == 1, function ($query) use ($to) {
                return $query->whereDate("created_at", '<=', date($to));
            })
            ->orderBy('category_id')
            ->get();
        $empty_message = 'No Result Found';


        return view('admin.inventory.category.index', compact('inventories', 'from', 'to', 'page_title', 'empty_message'));
    }


    public function provider()
    {
        $page_title = 'Inventory By Provider';
        $inventories = Order::groupBy('order_placed_to_api')
            ->selectRaw('*, sum(price) as sum,count(*) as count')
            ->whereNotIn('status', [0, 3, 4, 5])
            ->whereDate('created_at', Carbon::today())
            ->where('order_placed_to_api', '<>', 0)
            ->orderBy('order_placed_to_api')
            ->get();
        $apiProviders = ApiProvider::all();
        $from = Carbon::now()->toDateString();
        $empty_message = 'No Result Found';
        return view('admin.inventory.provider.index', compact('inventories', 'from', 'page_title', 'empty_message', 'apiProviders'));
    }

    public function providerSearch(Request $request)
    {
        $page_title = 'Inventory By Provider';
        $search = $request->all();
        $from = $request->from;
        $datefrom = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $from);
        $to = $request->to;
        $dateto = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $to);
        $inventories = Order::groupBy('order_placed_to_api')
            ->selectRaw('*, sum(price) as sum,count(*) as count')
            ->whereNotIn('status', [0, 3, 4, 5])
            ->when($datefrom == 1, function ($query) use ($from) {
                return $query->whereDate("created_at", '>=', date($from));
            })
            ->when($dateto == 1, function ($query) use ($to) {
                return $query->whereDate("created_at", '<=', date($to));
            })
            ->where('order_placed_to_api', '<>', 0)
            ->orderBy('order_placed_to_api')
            ->get();
        $empty_message = 'No Result Found';
        $apiProviders = ApiProvider::all();
        return view('admin.inventory.provider.index', compact('inventories', 'from', 'page_title', 'empty_message', 'apiProviders'));
    }


    public function user()
    {
        $page_title = 'Inventory By User';
        $inventories = Order::groupBy('user_id')
            ->selectRaw('*, sum(price) as sum,count(*) as count')
            ->whereNotIn('status', [0, 3, 4, 5])
            ->whereDate('created_at', Carbon::today())
            ->orderBy('user_id')
            ->get();
        $from = Carbon::now()->toDateString();
        $empty_message = 'No Result Found';
        return view('admin.inventory.user.index', compact('inventories', 'from', 'page_title', 'empty_message'));
    }

    public function userSearch(Request $request)
    {
        $page_title = 'Inventory By User';
        $search = $request->all();
        $from = $request->from;
        $datefrom = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $from);
        $to = $request->to;
        $dateto = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $to);
        $inventories = Order::groupBy('user_id')
            ->selectRaw('*, sum(price) as sum,count(*) as count')
            ->whereNotIn('status', [0, 3, 4, 5])
            ->when($datefrom == 1, function ($query) use ($from) {
                return $query->whereDate("created_at", '>=', date($from));
            })
            ->when($dateto == 1, function ($query) use ($to) {
                return $query->whereDate("created_at", '<=', date($to));
            })
            ->orderBy('user_id')
            ->get();
        $empty_message = 'No Result Found';
        return view('admin.inventory.user.index', compact('inventories', 'from', 'page_title', 'empty_message'));
    }


//    public function provider()
//    {
//        $inventories = ApiProvider::with(['services', 'services.orders'])
//            ->whereNotIn('orders.status', ['draft','unchecked','canceled','refunded','code-waiting'])
//            ->whereDate('orders.created_at', Carbon::today())
//            ->select('api_providers.id', 'api_providers.api_name',
//                DB::raw('SUM(orders.price) as total_price'),
//                DB::raw('count(*) as total_count'),
//                DB::raw('SUM(orders.profit) as total_profit'))
//            ->join('services', 'api_providers.id', '=', 'services.api_provider_id')
//            ->join('orders', 'services.id', '=', 'orders.service_id')
//            ->groupBy('api_providers.id', 'api_providers.api_name')
//            ->get();
//        $providers = ApiProvider::all();
//        $from = Carbon::now()->toDateString();
//        return view('admin.pages.inventory.provider', compact('inventories', 'from', 'providers'));
//    }
//
//    public function providerSearch(Request $request)
//    {
//        $search = $request->all();
//        $from = $request->from;
//        $datefrom = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $from);
//        $to = $request->to;
//        $dateto = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $to);
//        $providerId = $request->provider_name;
//        $inventories = ApiProvider::with(['services', 'services.orders'])
//            ->whereNotIn('orders.status', ['draft','unchecked','canceled','refunded','code-waiting'])
//            ->select('api_providers.id', 'api_providers.api_name',
//                DB::raw('SUM(orders.price) as total_price'),
//                DB::raw('count(*) as total_count'),
//                DB::raw('SUM(orders.profit) as total_profit'))
//            ->join('services', 'api_providers.id', '=', 'services.api_provider_id')
//            ->join('orders', 'services.id', '=', 'orders.service_id')
//            ->when($datefrom == 1, function ($query) use ($from) {
//                return $query->whereDate("orders.created_at", '>=', date($from));
//            })
//            ->when($dateto == 1, function ($query) use ($to) {
//                return $query->whereDate("orders.created_at", '<=', date($to));
//            })
//            ->when($providerId != "-1", function ($query) use ($providerId) {
//                return $query->where("api_providers.id", (int)$providerId);
//            })
//            ->groupBy('api_providers.id', 'api_providers.api_name')
//            ->get();
//        $providers = ApiProvider::all();
//        return view('admin.pages.inventory.provider', compact('inventories', 'from', 'to', 'providers'));
//
//    }
}
