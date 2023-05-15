<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Auth')->name('user.')->group(function () {

    Route::controller('LoginController')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::controller('RegisterController')->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register')->middleware('registration.status');
        Route::post('check-mail', 'checkUser')->name('checkUser');
    });

    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'showLinkRequestForm')->name('request');
        Route::post('email', 'sendResetCodeEmail')->name('email');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });
    Route::controller('ResetPasswordController')->group(function () {
        Route::post('password/reset', 'reset')->name('password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    });
});

Route::middleware('auth')->name('user.')->group(function () {
    //authorization
    Route::namespace('User')->controller('AuthorizationController')->group(function () {
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'emailVerification')->name('verify.email');
        Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
        Route::post('verify-g2fa', 'g2faVerification')->name('go2fa.verify');
    });

    Route::middleware(['check.status'])->namespace('User')->group(function () {
        Route::get('user-data', 'UserController@userData')->name('data');
        Route::post('user-data-submit', 'UserController@userDataSubmit')->name('data.submit');

        Route::middleware('registration.complete')->group(function () {

            Route::controller('UserController')->group(function () {
                Route::get('dashboard', 'home')->name('home');

                //2FA
                Route::get('twofactor', 'show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

                Route::any('deposit/history', 'depositHistory')->name('deposit.history');
                Route::get('transactions', 'transactions')->name('transactions');

                Route::get('attachment-download/{fil_hash}', 'attachmentDownload')->name('attachment.download');
                //Service
                Route::get('service', 'services')->name('services');
                Route::get('order', 'order')->name('order');
                Route::get('service/category/{id}', 'serviceCategory')->name('service.category');
            });

            //order Controller
            Route::controller('OrderController')->name('order.')->prefix('order')->group(function () {
                Route::post('/{serviceId}', 'order')->name('create');
                Route::get('history', 'history')->name('history');
                Route::get('pending', 'pending')->name('pending');
                Route::get('processing', 'processing')->name('processing');
                Route::get('completed', 'completed')->name('completed');
                Route::get('cancelled', 'cancelled')->name('cancelled');
                Route::get('refunded', 'refunded')->name('refunded');

                Route::get('/mass', 'massOrder')->name('mass');
                Route::post('/store-mass', 'massOrderStore')->name('mass.store');
            });

            //Api
            Route::controller('ApiController')->name('api.')->prefix('api')->group(function () {
                Route::get('index', 'api')->name('index');
                Route::post('generate-new-key', 'generateApiKey')->name('generateKey');
            });

            //Profile setting
            Route::controller('ProfileController')->group(function () {
                Route::get('profile-setting', 'profile')->name('profile.setting');
                Route::post('profile-setting', 'submitProfile');
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('change-password', 'submitPassword');
            });
        });
    });
    // Payment
    Route::controller('Gateway\PaymentController')->prefix('deposit')->name('deposit.')->group(function () {
        Route::any('/', 'deposit')->name('index');
        Route::post('insert', 'depositInsert')->name('insert');
        Route::get('confirm', 'depositConfirm')->name('confirm');
        Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
        Route::post('manual', 'manualDepositUpdate')->name('manual.update');
    });
});
