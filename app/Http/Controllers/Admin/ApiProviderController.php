<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiProvider;
use Illuminate\Http\Request;

class ApiProviderController extends Controller
{
    public function index()
    {
        $pageTitle    = "Api Providers";
        $apiProviders = ApiProvider::orderBy('name')->paginate(getPaginate());
        return view('admin.api_provider.index', compact('pageTitle', 'apiProviders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'api_url'    => 'required|url',
            'api_key'    => 'required',
            'short_name' => 'required|max:4',

        ]);
        if ($request->id) {
            $apiProvider = ApiProvider::findOrFail($request->id);
            $message     = "API provider updated successfully";
        } else {
            $apiProvider = new ApiProvider();
            $message     = "API provider added successfully";
        }

        $apiProvider->name       = $request->name;
        $apiProvider->short_name = $request->short_name;
        $apiProvider->api_url    = $request->api_url;
        $apiProvider->api_key    = $request->api_key;
        $apiProvider->save();

        $notify[] = ['success', $message];
        return back()->withNotify($notify);
    }

    public function status($id)
    {
        return ApiProvider::changeStatus($id);
    }
}
