<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BalanceCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Coupons';
        $empty_message = 'No Result Found';
        $coupons = BalanceCoupon::orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.balance_coupon.index', compact('coupons', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $req->validate( [
            'code' => 'required|string|max:20',
            'code' => Rule::unique('balance_coupons'),
            'balance' => 'required|numeric',
        ]);
        $balance = new BalanceCoupon();
        $balance->code = $req['code'];
        $balance->balance = $req['balance'];
        $balance->status = $req['status'] == 'on' ? 1 : 0;
        $balance->user_id = 0;
        $balance->save();
        return back()->with('success', trans('Successfully Updated'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = BalanceCoupon::find($id);
        if ($coupon->status == 1)
            $coupon->status = 0;
        else $coupon->status = 1;
        $coupon->save();
        return back()->with('success', trans('Successfully Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
