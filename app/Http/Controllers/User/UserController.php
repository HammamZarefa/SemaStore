<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Lib\GoogleAuthenticator;
use App\Models\Category;
use App\Models\Deposit;
use App\Models\Order;
use App\Models\Service;
use App\Models\SupportTicket;
use App\Models\Transaction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        $pageTitle                   = 'Dashboard';
        $user                        = auth()->user();
        $widget['balance']           = $user->balance;
        $widget['total_spent']       = Order::where('status', '!=', Status::ORDER_REFUNDED)->where('user_id', $user->id)->sum('price');
        $widget['total_transaction'] = Transaction::where('user_id', $user->id)->count();
        $widget['total_order']       = Order::where('user_id', $user->id)->count();
        $widget['pending_order']     = Order::where('user_id', $user->id)->pending()->count();
        $widget['processing_order']  = Order::where('user_id', $user->id)->processing()->count();
        $widget['completed_order']   = Order::where('user_id', $user->id)->completed()->count();
        $widget['cancelled_order']   = Order::where('user_id', $user->id)->cancelled()->count();
        $widget['refunded_order']    = Order::where('user_id', $user->id)->refunded()->count();
        $widget['deposit']           = Deposit::successful()->where('user_id', $user->id)->sum('amount');
        $widget['total_service']     = Service::active()->count();
        $widget['total_ticket']      = SupportTicket::where('user_id', $user->id)->count();
        return view($this->activeTemplate . 'user.dashboard', compact('pageTitle', 'widget'));
    }

    public function depositHistory(Request $request)
    {
        $pageTitle       = 'Deposit History';
        $deposits = auth()->user()->deposits()->searchable(['trx'])->with(['gateway'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.deposit_history', compact('pageTitle', 'deposits'));
    }

    public function show2faForm()
    {
        $general   = gs();
        $ga        = new GoogleAuthenticator();
        $user      = auth()->user();
        $secret    = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->site_name, $secret);
        $pageTitle = '2FA Setting';
        return view($this->activeTemplate . 'user.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key'  => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user, $request->code, $request->key);

        if ($response) {
            $user->tsc = $request->key;
            $user->ts  = Status::ENABLE;
            $user->save();
            $notify[] = ['success', 'Google authenticator activated successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }

    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user     = auth()->user();
        $response = verifyG2fa($user, $request->code);

        if ($response) {
            $user->tsc = null;
            $user->ts  = Status::DISABLE;
            $user->save();
            $notify[] = ['success', 'Two factor authenticator deactivated successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }

        return back()->withNotify($notify);
    }

    public function transactions(Request $request)
    {
        $pageTitle    = 'Transactions';
        $remarks      = Transaction::distinct('remark')->orderBy('remark')->get('remark');
        $transactions = Transaction::where('user_id', auth()->id())->searchable(['trx'])->filter(['trx_type', 'remark'])->orderBy('id', 'desc')->paginate(getPaginate());

        return view($this->activeTemplate . 'user.transactions', compact('pageTitle', 'transactions', 'remarks'));
    }

    public function attachmentDownload($fileHash)
    {
        $filePath  = decrypt($fileHash);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $general   = gs();
        $title     = slug($general->site_name) . '- attachments.' . $extension;
        $mimetype  = mime_content_type($filePath);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($filePath);
    }

    public function userData()
    {
        $user = auth()->user();

        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }

        $pageTitle = 'User Data';
        return view($this->activeTemplate . 'user.user_data', compact('pageTitle', 'user'));
    }

    public function userDataSubmit(Request $request)
    {
        $user = auth()->user();

        if ($user->profile_complete == 1) {
            return to_route('user.home');
        }

        $request->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
        ]);
        $user->firstname = $request->firstname;
        $user->lastname  = $request->lastname;
        $user->address   = [
            'country' => @$user->address->country,
            'address' => $request->address,
            'state'   => $request->state,
            'zip'     => $request->zip,
            'city'    => $request->city,
        ];
        $user->profile_complete = 1;
        $user->save();

        $notify[] = ['success', 'Registration process completed successfully'];
        return to_route('user.home')->withNotify($notify);
    }

    public function services()
    {
        $pageTitle  = 'Services';
        $categories = Category::active()->whereHas('services', function ($services) {
            return $services->active();
        })->orderBy('name')->get();
        return view($this->activeTemplate . 'user.services.services', compact('pageTitle', 'categories'));
    }

    public function serviceCategory($id)
    {
        $category  = Category::active()->findOrFail($id);
        $pageTitle = $category->name;
        $services  = Service::active()->where('category_id', $id)->paginate(getPaginate());
        return view($this->activeTemplate . 'user.services.category', compact('pageTitle', 'services'));
    }
}
