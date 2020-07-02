<?php
Route::group(['middleware' => ['web'], 'module' => 'Asp', 'prefix' => 'asp', 'namespace' => 'App\Modules\Asp\Controllers'], function() {
    Route::get('/login','LoginController@showLoginForm')->name('asp_login');
    Route::post('/login','LoginController@login');
    Route::get('/logout','LoginController@logout')->name('asp_logout');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('asp_password_email');
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('asp_password_reset');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('asp_password_update');
});
Route::group(['middleware' => ['web','asp_user'], 'module' => 'Asp', 'prefix' => 'asp', 'namespace' => 'App\Modules\Asp\Controllers'], function() {    
    //new-layout
    Route::get('/', 'AspController@index')->name('asp_home_page');
    Route::get('/home-general', 'AspController@indexGeneral')->name('asp_home_page_general');
    Route::get('resource/address','AspController@address');
    Route::get('/ajaxGetCity/{name}', 'AspController@ajaxGetCity')->name('asp_ajaxcities'); 
    Route::get('task-client','AspController@taskClient')->name('asp_task_client');
    Route::get('new-subsidy','AspController@newSubsidyAsp')->name('asp_new_subsidy');
    Route::get('new-client','AspController@newClient')->name('asp_new_client');
    Route::get('expire-subsidy','AspController@expireSubsidy')->name('asp_expire_subsidy');
    //profile
    Route::get('/profile', 'MemberController@profile')->name('asp_profile');
    Route::post('/profile', 'MemberController@update_profile')->name('asp_update_profile');  
    Route::get('/signature', 'MemberController@signature')->name('asp_signature');
    Route::post('/signature', 'MemberController@updateSignature')->name('asp_update_signature');  

    //manager-account
    Route::group(['middleware'=>['asp_mod']],function(){
        Route::get('/manager-account','ManagerAccountController@myAccount')->name('asp_manager_account');
        Route::get('/manager-account/create','ManagerAccountController@create')->name('asp_manager_account_create');
        Route::post('/manager-account/store','ManagerAccountController@store')->name('asp_manager_account_store');
        Route::get('/manager-account/edit/{id}','ManagerAccountController@edit')->name('asp_manager_account_edit');
        Route::post('/manager-account/update/{id}','ManagerAccountController@update')->name('asp_manager_account_update');
        Route::delete('/manager-account/destroy/{id}','ManagerAccountController@destroy')->name('asp_manager_account_destroy');
        //-group-
        Route::get('/manager-account/group/{id}','ManagerAccountController@editGroup')->name('asp_manager_account_group_edit');
        Route::post('mamnager-account/group/{id}/update','ManagerAccountController@updateGroup')->name('asp_manager_account_group_update');
        Route::post('mamnager-account/group/store','ManagerAccountController@storeGroup')->name('asp_manager_account_group_store');
        Route::delete('mamnager-account/group/destroy/{id}','ManagerAccountController@destroyGroup')->name('asp_manager_account_group_destroy');
    });
    //user-group 
    Route::group(['middleware'=>['asp_admin']],function(){
        //Route::resource('/admin/groups','AspGroupController',['as'=>'asp']);
        //Route::post('ajax/group-edit','AspGroupController@ajaxEdit')->name('asp_group_ajax_edit');
        //Route::post('ajax/group-add','AspGroupController@ajaxAdd')->name('asp_group_ajax_add'); 
        Route::resource('/admin/users','AspUserController',['as'=>'asp']);

    });
    Route::post('/ajax/upload-image','UploadMediaController@storePath');              
    //client
    Route::post('client/favorite','AspClientController@favorite')->name('asp_client_favorite');
    ///Route::get('client/recruitment/{hire_id}','AspClientController@client_recruitment')->name('asp_client_recruitment');              
    Route::get('client/{id}/policy/{policy_id}','AspClientController@policyPreview')->name('asp_client_policy_preview');              
    Route::get('client/{id}/download-preview','AspClientController@downloadPreview')->name('asp_client_recruitment_download_preview');              
    //policy
    Route::get('policy/{id}/detail','AspPolicyController@show')->name('asp_policy_show');
    Route::get('policy/{id}/clients','AspPolicyController@showClient')->name('asp_policy_clients'); 
    Route::post('policy/favorite','AspPolicyController@favorite')->name('asp_policy_favorite');       
    //manager-client   
    Route::get('manage-clients','AspManageClientController@index')->name('asp_manage_clients');
    Route::get('manage-clients/favorite','AspManageClientController@favorite')->name('asp_manage_clients_favorite');
    Route::get('manage-clients/csv','AspManageClientController@csv')->name('asp_manage_clients_csv');
    Route::post('manage-clients/csv-import','AspManageClientController@csvImport')->name('asp_manage_clients_csv_import');
    Route::post('manage-clients/csv-register','AspManageClientController@csvRegister')->name('asp_manage_clients_csv_register');
    Route::get('manage-clients/csv-download','AspManageClientController@download')->name('asp_manage_clients_download'); 
    Route::get('manage-clients/invation','AspManageClientController@invation')->name('asp_manage_clients_invation');  
    Route::get('manage-clients/invation-group','AspManageClientController@invationGroup')->name('asp_manage_clients_invation_group');  
    Route::post('manage-clients/invation','AspManageClientController@storeInvation')->name('asp_manage_clients_store_invation');  
    Route::post('manage-clients/store-favorite','AspManageClientController@storeFavorite')->name('asp_manage_clients_store_favorite'); 
    Route::get('manage-clients/download-history','AspManageClientController@downloadHistory')->name('asp_manage_clients_hire_history');
    //
    Route::get('manage-clients/register-custom','AspManageClientController@register')->name('asp_manage_clients_register_custom');    
    Route::post('manage-clients/store','AspManageClientController@registerStore')->name('asp_manage_clients_register_store');     
    //    
    Route::get('manage-clients/register/{client_id}','AspManageClientController@create')->name('asp_manage_clients_register');    
    Route::get('manage-clients/client-preview/{client_id}','AspManageClientController@clientPreview')->name('asp_manage_clients_preview');    
    Route::post('manage-clients/register-store/{client_id}','AspManageClientController@store')->name('asp_manage_clients_store');
    Route::get('manage-clients/register-preview/{id}','AspManageClientController@registerPreview')->name('asp_manage_clients_register_preview');   
    Route::get('manage-clients/register-edit/{id}','AspManageClientController@registerEdit')->name('asp_manage_clients_register_edit');   
    Route::post('manage-clients/register-update/{id}','AspManageClientController@registerUpdate')->name('asp_manage_clients_register_update'); 
    Route::get('manage-clients/register-destroy/{id}','AspManageClientController@registerDestroy')->name('asp_manage_clients_register_destroy');       
    //search
    Route::get('search-subsidy','AspSearchController@subsidy')->name('asp_search_subsidy');
    Route::get('search-clients','AspSearchController@clients')->name('asp_search_clients');  
    //register-samurai 
    Route::post('register-samurai/send-mail','AspRegisterController@sendMail')->name('asp_register_send_mail');    
    Route::post('register-samurai/send-mail-policy','AspRegisterController@sendMailPolicy')->name('asp_register_mail_policy');    
    //client-status
    Route::get('status-client','StatusClientController@index')->name('asp_status_client_index');
    Route::get('status-client/{id}/recruitment','StatusClientController@recruitment')->name('asp_status_client_recruitment');
    Route::get('status-client/{id}/request','StatusClientController@requestSubsidy')->name('asp_status_client_request');
    Route::get('status-client/{id}/request-job','StatusClientController@requestJob')->name('asp_status_client_request_job');
    Route::get('status-client/{id}/finish','StatusClientController@finish')->name('asp_status_client_finish');
    Route::get('status-client/{id}/visit','StatusClientController@visit')->name('asp_status_client_visit');
    Route::get('status-client/{id}/favorite','StatusClientController@favorite')->name('asp_status_client_favorite');
    Route::get('status-client/{id}/document','StatusClientController@document')->name('asp_status_client_document');
    //Route::get('status-client/{id}/subsidy','StatusClientController@subsidy')->name('asp_status_client_subsidy');
    Route::get('status-client/hire/{id}','StatusClientController@subsidyDetail')->name('asp_status_client_subsidy_detail');    
    Route::post('status-client/hire/favorite','StatusClientController@favoriteHire');    
    // generate-table-hire_client_log
    Route::get('tables/hire-client-log','AspTableController@hireClientLog');
    Route::post('tables/hire-client-work','AspTableController@hireWork');
    Route::post('tables/hire-client-save','AspTableController@hireClientSave');
    Route::post('tables/hire-client-register','AspTableController@hireRegister');
    Route::post('tables/hire-policy','AspTableController@hirePolicy');
    Route::post('tables/hire-policy-update','AspTableController@hirePolicyUpdate');
    Route::post('tables/hire-client-statistic','AspTableController@hireStatistic');
    Route::post('tables/hire-client-statistic-update','AspTableController@hireStatisticUpdate');
    Route::post('tables/hire-event','AspTableController@hireEvent');
});