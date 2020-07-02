<?php

Route::group(['middleware' => ['web'], 'module' => 'Home', 'prefix' => '', 'namespace' => 'App\Modules\Home\Controllers'], function() {
    Route::group(['middleware' => 'App\Http\Middleware\CheckLogged'], function() {
        //router auth
        Route::get('/login', 'AuthController@getLogin')->name('login');
        Route::get('/logout', 'AuthController@doLogout');
        
        Route::get('/register', 'AuthController@getRegister');
        Route::get('/registersuccess', 'AuthController@getRegisterSuccess');
        Route::get('/registersuccess', 'AuthController@getRegisterSuccess');
        

        Route::get('/forgotpass', 'AuthController@getForGotPass');
        Route::get('/forgotpasssuccess', 'AuthController@getForgotPassSuccess');
        
        //login socialite
        //facebook
        Route::get('/register/facebook', 'AuthController@redirectToFacebookProvider');
        Route::get('/register/facebook/callback', 'AuthController@handleProviderFacebookCallback');
        //google
        Route::get('/register/google', 'AuthController@redirectToGoogleProvider');
        Route::get('/register/google/callback', 'AuthController@handleProviderGoogleCallback');
    });
    Route::post('/doLogin', 'AuthController@doLogin');
    Route::post('/doRegister', 'AuthController@doRegister');
    Route::post('/doForgotPass', 'AuthController@doForgotPass');
    Route::get('/verify/{api_token}', 'AuthController@verify');
    
    //router in menu
    Route::get('/', 'A_Controller@getHome');
    Route::get('/whatissamurai', 'A_Controller@getWhatissamurai');
    Route::get('/seminarinfo', 'A_Controller@getSeminarinfo');
    Route::get('/howtouse', 'A_Controller@getHowtouse');
    Route::get('/howtouse-2', 'A_Controller@getHowtouse2');
    Route::get('/howtouse-3', 'A_Controller@getHowtouse3');
    Route::get('/howtouse-4', 'A_Controller@getHowtouse4');
    Route::get('/howtouse-5', 'A_Controller@getHowtouse5');
    Route::get('/howtouse-6', 'A_Controller@getHowtouse6');
    //router in page
    Route::get('/uservoicelist', 'A_Controller@getUservoicelist')->name('uservoicelist');
    Route::get('/uservoicelist/{id}', 'A_Controller@getUservoicelistdetail')->name('uservoicelistdetail');
    Route::get('/subsidylist/{id}', 'A_Controller@getSubsidylist');
    Route::get('/subsidylist/{id}/subsidydetail', 'A_Controller@getSubsidydetail')->name('subsidydetail');
    Route::get('/bloglist', 'A_Controller@getBloglist');
    Route::get('/howtomatching', 'A_Controller@getHowtomatching');
    Route::get('/termservice', 'A_Controller@getTermservice');
    Route::get('/transactionraw', 'A_Controller@getTransactionraw');
    Route::get('/guide-line', 'A_Controller@getGuideLine');
    Route::get('/privacy-policy', 'A_Controller@getPrivacyPolicy');
    Route::get('/companyabout', 'A_Controller@getCompanyAbout');
    Route::get('/subsidydetail/{id}/home', 'B_Controller@getBSubsidyDetail')->name('b.subsidydetail');
    Route::get('/subsidydetail/{id}/agencyprofile', 'A_Controller@getSubsidydetail')->name('agency.subsidydetail');
    Route::get('/404-page-not-found', 'A_Controller@pageNotFound');

    Route::get('/api/download-file/{file_path}/{file_name}', '\App\Modules\Agency\Controllers\MypageController@downloadFileFunc')->name('agency.jobs.matching.download-file');

    Route::get('/email_verify/{code}/{new_email}/', '\App\Modules\Agency\Controllers\MypageController@verifyMailChange');

    // ôn thắng
    //Route::get('/pay', 'A_Controller@getPay');
    Route::get('/pay-success', 'A_Controller@pay_success');
    //Route::post('/pay', 'A_Controller@getPay');
    Route::post('/pay-develop', 'A_Controller@payDevelop');
    Route::get('/pay/{hire_id}', 'A_Controller@getPayNew');
    Route::post('/pay/{hire_id}', 'A_Controller@postPayNew');
    Route::get('/pay-success/{hire_id}', 'A_Controller@getPaySuccess');
    Route::get('/pay-fail/{hire_id}', 'A_Controller@getPayFail');
    Route::post('/pay_with_card', 'A_Controller@pay_with_card');
    Route::post('/bank_transfer', 'A_Controller@bank_transfer');
    Route::post('/billing_bulk_upsert', 'A_Controller@billing_bulk_upsert');
    Route::get('/inquiry', 'A_Controller@getInquiry');
    Route::post('/inquiry', 'A_Controller@getInquiry');
    Route::get('/inquiry_completed', 'A_Controller@getInquiry_completed')->name('inquiry_completed');

    Route::get('/initdb', 'B_Controller@initdb');


    
    


});

