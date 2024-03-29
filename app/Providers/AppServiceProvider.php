<?php

namespace App\Providers;

use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\Language;
use App\Models\News;
use App\Models\Page;
use HammamZarefa\RapidRanker\Models\Level;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $activeTemplate = activeTemplate();
        $general = GeneralSetting::first();
        $viewShare['general'] = $general;
        $viewShare['activeTemplate'] = $activeTemplate;
        $viewShare['activeTemplateTrue'] = activeTemplate(true);
//        $viewShare['language'] = Language::all();
        $viewShare['news'] = News::all();
//        $viewShare['pages'] = Page::where('tempname', $activeTemplate)->where('slug', '!=', 'home')->get();
        $viewShare['levels'] = Level::all();
        view()->share($viewShare);


        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
//                'banned_users_count'           => User::banned()->count(),
//                'email_unverified_users_count' => User::emailUnverified()->count(),
//                'sms_unverified_users_count'   => User::smsUnverified()->count(),
//                'pending_ticket_count'         => SupportTicket::whereIN('status', [0,2])->count(),
//                'pending_deposits_count'    => Deposit::pending()->count(),
//
//                'pending_orders' => Order::pending()->count(),
//                'processing_orders' => Order::processing()->count(),
            ]);
        });

        view()->composer('admin.partials.topnav', function ($view) {
            $view->with([
                'adminNotifications' => AdminNotification::where('read_status', 0)->with('user')->orderBy('id', 'desc')->get(),
            ]);
        });

        view()->composer('partials.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });

        if ($general->force_ssl) {
            \URL::forceScheme('https');
        }

    }
}
