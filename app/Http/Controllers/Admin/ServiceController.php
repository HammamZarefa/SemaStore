<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Lib\CurlRequest;
use App\Models\ApiProvider;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ServiceController extends Controller
{

    public function index()
    {
        $pageTitle  = "Manage Service";
        $categories = Category::active()->orderBy('name')->get();
        $apiLists   = ApiProvider::active()->get();
        $services   = Service::with('category', 'provider')->searchable(['name', 'category:name'])->whereHas('category', function ($query) {
            $query->active();
        })->orderBy('name')->paginate(getPaginate());
        return view('admin.service.index', compact('pageTitle', 'categories', 'services', 'apiLists'));
    }

    public function add()
    {
        $pageTitle  = "Add Service";
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.service.add', compact('pageTitle', 'categories'));
    }

    public function store(Request $request)
    {

        $id = $request->id ?? 0;
        $request->validate([
            'category'       => 'required',
            'name'           => 'required',
            'price_per_k'    => 'required|numeric|gt:0',
            'min'            => 'required|integer|gt:0|lte:' . $request->max,
            'max'            => 'required|integer|gte:' . $request->min,
            'details'        => 'required',
            'api_service_id' => 'nullable|integer|gt:0|unique:services,api_service_id,' . $id,
        ]);

        $category    = Category::active()->findOrFail($request->category);

        if ($id) {
            $service = Service::findOrFail($id);
            $message = "Service updated successfully";
        } else {
            $service = new Service();
            $message = "Service added successfully";
        }

        $service->category_id     = $category->id;
        $service->api_provider_id = $request->api_provider_id ?? 0;
        $service->name            = $request->name;
        $service->price_per_k     = $request->price_per_k;
        $service->min             = $request->min;
        $service->max             = $request->max;
        $service->details         = $request->details;
        $service->api_service_id  = $request->api_service_id;
        $service->save();

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function edit($id)
    {
        $pageTitle  = "Update Service";
        $service    = Service::findOrFail($id);
        $categories = Category::active()->orderBy('name')->get();
        return view('admin.service.edit', compact('pageTitle', 'categories', 'service'));
    }

    public function status($id)
    {
        return Service::changeStatus($id);
    }

    public function apiServicesStore(Request $request)
    {
        $request->validate([
            'category'        => 'required',
            'name'            => 'required',
            'price_per_k'     => 'required|numeric|gt:0',
            'min'             => 'required|integer|gt:0|lte:' . $request->max,
            'max'             => 'required|integer|gte:' . $request->min,
            'details'         => 'required',
            'api_provider_id' => 'numeric|gt:0',
        ]);

        $category = Category::where('name', $request->category)->first();

        if (!$category) {
            $category       = new Category();
            $category->name = $request->category;
            $category->save();
        }

        $apiService = Service::where('api_service_id', $request->api_service_id)->where('api_provider_id', $request->api_provider_id)->first();

        if ($apiService) {
            $notify[] = ['error', "This API service already listed"];
            return back()->withNotify($notify);
        }

        $service                  = new Service();
        $service->category_id     = $category->id;
        $service->api_provider_id = $request->api_provider_id;
        $service->name            = $request->name;
        $service->price_per_k     = $request->price_per_k;
        $service->min             = $request->min;
        $service->max             = $request->max;
        $service->details         = $request->details;
        $service->api_service_id  = $request->api_service_id;
        $service->save();

        $notify[] = ['success', 'Service added form API successfully'];
        return back()->withNotify($notify);
    }

    //Api services
    public function apiServices($id)
    {


        $pageTitle  = "API Services";
        $api        = ApiProvider::active()->findOrFail($id);
        $existsServices = Service::where('api_provider_id', $api->id)->count();
        $url        = $api->api_url;
        $arr        = [
            'key'    => $api->api_key,
            'action' => 'services',
        ];
        $response = CurlRequest::curlPostContent($url, $arr);
        $response = json_decode($response);

        if (@$response->error) {
            $notify[] = ['info', 'Please enter your api credentials from API Setting Option'];
            $notify[] = ['error', $response->error];
            return back()->withNotify($notify);
        }
        $data = [];
        foreach ($response as $value) {
            $value->api_id = $id;
            array_push($data, $value);
        }

        $response = collect($data);
        $response = $response->skip($existsServices);
        $services = $this->paginate($response, getPaginate(100), null, ['path' => route('admin.service.api', $id)]);
        return view('admin.service.api_services', compact('pageTitle', 'services'));
    }

    public function addService(Request $request)
    {

        $services = $request->services;
        foreach ($services as $serviceValue) {
            $api_service_id  = $serviceValue['api_service_id'];
            $category        = $serviceValue['category'];
            $api_provider_id = $serviceValue['api_provider_id'];
            $checkService    = Service::where('api_service_id', $api_service_id)->where('api_provider_id', $api_provider_id)->first();

            if ($checkService) {
                continue;
            }
            $existCategory = Category::where('name', $category)->first();
            if ($existCategory) {
                $category_id = $existCategory->id;
            }

            if (!$existCategory) {
                $categoryNew       = new Category();
                $categoryNew->name = $category;
                $categoryNew->save();
                $category_id = $categoryNew->id;
            }
            $service                  = new Service();
            $service->category_id     = $category_id;
            $service->api_provider_id = $api_provider_id;
            $service->name            = $serviceValue['name'];
            $service->price_per_k     = $serviceValue['price_per_k'] * $serviceValue['incressTimes'];
            $service->min             = $serviceValue['min'];
            $service->max             = $serviceValue['max'];
            $service->api_service_id  = $serviceValue['api_service_id'];
            $service->save();
        }

        return response()->json(['success' => true, 'message' => 'All service added successfully']);
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page  = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}