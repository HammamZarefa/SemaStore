<?php

namespace App\Http\Controllers;

use App\Lib\GoogleAuthenticator;
use App\Models\AdminNotification;
use App\Models\BalanceCoupon;
use App\Models\Category;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Service;
use App\Models\Transaction;
use HammamZarefa\RapidRanker\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Image;
use Validator;
use Illuminate\Support\Facades\Artisan;

class UserController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function home()
    {
        // $exitCode = Artisan::call('route:clear');

        // if ($exitCode === 0) {
        //     return 'route cache cleared successfully.';
        // } else {
        //     return 'Failed to clear optimization cache.';
        // }
        $page_title = 'Dashboard';
        $user = \auth()->user();

        $widget['balance'] = $user->balance;
        $widget['total_spent'] = Order::where('status', '!=', 4)->where('user_id', $user->id)->sum('price');
        $widget['total_transaction'] = Transaction::where('user_id', $user->id)->count();
        $widget['total_order'] = Order::where('user_id', $user->id)->count();
        $widget['pending_order'] = Order::where('user_id', $user->id)->pending()->count();
        $widget['processing_order'] = Order::where('user_id', $user->id)->processing()->count();
        $widget['completed_order'] = Order::where('user_id', $user->id)->completed()->count();
        $widget['cancelled_order'] = Order::where('user_id', $user->id)->cancelled()->count();
        $widget['refunded_order'] = Order::where('user_id', $user->id)->refunded()->count();

        return view($this->activeTemplate . 'user.dashboard', compact('page_title', 'widget'));
    }

    public function profile()
    {
        $data['page_title'] = "Profile Setting";
        $data['user'] = Auth::user();
        return view($this->activeTemplate . 'user.profile-setting', $data);
    }

    public function submitProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'address' => "sometimes|required|max:80",
            'state' => 'sometimes|required|max:80',
            'zip' => 'sometimes|required|max:40',
            'city' => 'sometimes|required|max:50',
            'image' => 'mimes:png,jpg,jpeg'
        ], [
            'firstname.required' => 'First Name Field is required',
            'lastname.required' => 'Last Name Field is required'
        ]);


        $in['firstname'] = $request->firstname;
        $in['lastname'] = $request->lastname;

        $in['address'] = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'city' => $request->city,
        ];

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $user->username . '.jpg';
            $location = 'assets/images/user/profile/' . $filename;
            $in['image'] = $filename;

            $path = './assets/images/user/profile/';
            $link = $path . $user->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            $size = imagePath()['profile']['user']['size'];
            $image = Image::make($image);
            $size = explode('x', strtolower($size));
            $image->resize($size[0], $size[1]);
            $image->save($location);
        }
        $user->fill($in)->save();
        $notify[] = ['success', 'Profile Updated successfully.'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        $data['page_title'] = "CHANGE PASSWORD";
        return view($this->activeTemplate . 'user.password', $data);
    }

    public function submitPassword(Request $request)
    {

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $user = auth()->user();
            if (Hash::check($request->current_password, $user->password)) {
                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                $notify[] = ['success', 'Password Changes successfully.'];
                return back()->withNotify($notify);
            } else {
                $notify[] = ['error', 'Current password not match.'];
                return back()->withNotify($notify);
            }
        } catch (\PDOException $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
    }

    /*
     * Deposit History
     */
    public function depositHistory()
    {
        $page_title = 'Deposit History';
        $empty_message = 'No history found.';
        $logs = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'user.deposit_history', compact('page_title', 'empty_message', 'logs'));
    }

    /*
     * Transaction History
     */
    public function transactionHistory()
    {
        $page_title = 'Transaction History';
        $empty_message = 'No history found.';
        $transactions = Transaction::where('user_id', \auth()->id())->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'user.transaction_history', compact('page_title', 'empty_message', 'transactions'));
    }

    public function show2faForm()
    {
        $gnl = GeneralSetting::first();
        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $gnl->sitename, $secret);
        $prevcode = $user->tsc;
        $prevqr = $ga->getQRCodeGoogleUrl($user->username . '@' . $gnl->sitename, $prevcode);
        $page_title = 'Two Factor';
        return view($this->activeTemplate . 'user.twofactor', compact('page_title', 'secret', 'qrCodeUrl', 'prevcode', 'prevqr'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);

        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);

        if ($oneCode === $request->code) {
            $user->tsc = $request->key;
            $user->ts = 1;
            $user->tv = 1;
            $user->save();


            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_ENABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);


            $notify[] = ['success', 'Google Authenticator Enabled Successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong Verification Code'];
            return back()->withNotify($notify);
        }
    }


    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth()->user();
        $ga = new GoogleAuthenticator();

        $secret = $user->tsc;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode) {

            $user->tsc = null;
            $user->ts = 1;
            $user->tv = 1;
            $user->save();


            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_DISABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);


            $notify[] = ['success', 'Two Factor Authenticator Disable Successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong Verification Code'];
            return back()->with($notify);
        }
    }

    //Services
    public function services()
    {
        $page_title = 'Services';
        $empty_message = "No result found";
        $categories = Category::active()->orderBy('sort')->get();
        return view(activeTemplate() . 'user.services.services', compact('page_title', 'categories', 'empty_message'));
    }

    //Services
    public function service($id)
    {
        $category = Category::find($id);
        $page_title = $category->name;
        $empty_message = "No result found";
        $services = Service::where("category_id", $id)->active()->orderBy('name')->get();
        return view(activeTemplate() . 'user.services.service', compact('page_title', 'services', 'empty_message', 'category'));
    }

    public function chargeViaCoupon()
    {
        $page_title = 'Coupon Balance';
        return view(activeTemplate() . 'user.add_coupon',
            compact('page_title'));
    }

    public function applyBalanceCoupon(Request $request)
    {
        $this->validate($request, ['code' => 'required']);

        $user = Auth::user();
        $coupon = BalanceCoupon::where('code', $request['code'])->first();
        if ($coupon != null && $coupon->is_sold != 1 && $coupon->status != 0) {
            $balance = $coupon->balance;
        } else {
            $notify[] = ['error', trans('Coupon Is Not Found.')];
            return back()->withNotify($notify);
        }

        DB::beginTransaction();
        try {
            $user->balance += (float)$balance;
            $user->save();
            $coupon->is_sold = 1;
            $coupon->user_id = $user->id;
            $coupon->save();
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $balance;
            $transaction->post_balance = getAmount($user->balance);
            $transaction->trx_type = '+';
            $transaction->details = 'add balance via coupon';
            $transaction->trx = getTrx();
            $transaction->save();
            $data = new Deposit();
            $data->user_id = $user->id;
            $data->method_code = 'coupon';
            $data->method_currency = strtoupper('USD');
            $data->amount = $balance;
            $data->charge = 0;
            $data->rate = 0;
            $data->final_amo = $balance;
            $data->btc_amo = 0;
            $data->btc_wallet = "";
            $data->trx = getTrx();
            $data->try = 0;
            $data->status = 1;
            $data->save();
            DB::commit();
            $notify[] = ['success', trans('Balance Is Updated Successfully.')];
            return back()->withNotify($notify);
        } catch (\Exception $e) {
            DB::rollBack();
            $notify[] = ['error', trans("يرجى التواصل مع مدير الموقع")];
            return back()->with()->withInput($notify);
        }
    }

    public function levelsInfo()
    {
        $levels = Level::all();
        $page_title = "معلومات الشرائح";
        return view(activeTemplate() . 'user.levels-info',
            compact('levels','page_title'));
    }
}
