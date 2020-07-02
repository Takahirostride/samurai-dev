<?php
// router for client
Route::group(['middleware' => ['web'], 'module' => 'Client', 'prefix' => 'client', 'namespace' => 'App\Modules\Client\Controllers'], function() {
    Route::get('/F0_lock', 'ClientController@getIndex')->name('client.F0_lock');
});
Route::group(['middleware' => ['web', 'auth', 'client'], 'module' => 'Client', 'prefix' => 'client', 'namespace' => 'App\Modules\Client\Controllers'], function() {
    Route::get('/F0', 'ClientController@getIndex')->name('client.index');
    Route::get('/Fsubsidylist', 'F_Controller@getSubsidylist')->name('client.Fsubsidylist');
    Route::get('/Fsearch', 'F_Controller@getSearch')->name('client.fsearch');
    Route::get('/Fselect/{id}', 'F_Controller@getSelect')->name('client.fselect');
    Route::get('subsidylist/2','SubsidyController@visit')->name('client.visit');
    Route::get('subsidylist/1','SubsidyController@bookmark')->name('client.bookmark');
    Route::get('subsidylist/0','SubsidyController@doing')->name('client.doing');
    Route::get('subsidy-detail/{id}','SubsidyController@detail')->name('client.subsidy.detail');
    Route::post('/add-post', 'F_Controller@storePost')->name('client.add_post');

    Route::get('/Hselect', 'H_Controller@getSelect');
    Route::get('/Hselect/follow-list', 'H_Controller@followList');
    Route::get('/Hselect/matching-policy-lists/{id}', 'H_Controller@matchingPolicyLists');

    Route::get('/Isubsidylist', 'I_Controller@getSubsidylist');
    Route::get('/Ghome', 'G_Controller@getHome');
    Route::get('/Glist', 'G_Controller@getList');

    Route::get('/notify/{no_id}', 'ClientController@getNotifyById')->name('client.notify');
    Route::get('/notifylist', 'ClientController@getNotifyList')->name('client.notifylist');

    Route::get('/profile/{agency_id}', 'ProfileController@getProfile')->name('client.profile.view');
    Route::get('/profile/available-task/{agency_id}', 'ProfileController@getAvailableTask')->name('client.profile.view.availabletask');
    Route::get('/profile/rating/{agency_id}', 'ProfileController@getRating')->name('client.profile.view.rating');


    //router mypage
    Route::get('/mypage/home', 'MypageController@getIndex')->name('client.home');
    Route::get('/mypage/memberinfo', 'MypageController@getMemberInfo')->name('client.memberinfo');
    Route::get('/mypage/jobs', 'MypageController@getMemberJobs')->name('client.jobs');
    Route::get('/mypage/followlist', 'MypageController@getFollowList')->name('client.followlist');
    Route::get('/mypage/authentication', 'MypageController@getAuthentication')->name('client.authentication');
    Route::get('/mypage/payment', 'MypageController@getPayment')->name('client.payment');
    Route::get('/mypage/affiliate', 'MypageController@getAffiliate')->name('client.affiliate');
    Route::get('/mypage/sale', 'MypageController@getSale')->name('client.sale');

    Route::post('/mypage/homeAjax', 'MypageController@indexAjax');
    Route::post('/mypage/uploadAvatar', 'MypageController@doAvatarUpload');
    Route::get('/mypage/profile', 'MypageController@getProfile')->name('client.profile');
    Route::post('/mypage/profile', 'MypageController@postProfile');
    Route::post('/mypage/profile/loadCityByProvince', 'MypageController@loadCityByProvince');
    Route::post('/mypage/profile-ajax', 'MypageController@profileAjax');

    Route::get('/mypage/profile/available-task', 'MypageController@getAvailableTask')->name('client.profile.availabletask_edit');
    Route::get('/mypage/profile/available-task-show', 'MypageController@getAvailableTaskShow')->name('client.profile.availabletask');
    Route::post('/mypage/profile/available-task', 'MypageController@postAvailableTask');

    Route::get('/mypage/profile/available-subsidy', 'MypageController@getAvailableSubsidy')->name('client.profile.resubsidy');
    Route::get('/mypage/profile/rating', 'MypageController@getRating')->name('client.profile.rating');
    Route::post('/mypage/profile/rating-ajax', 'MypageController@ratingAjax');
    Route::post('/mypage/memberinfo-ajax', 'MypageController@memberInfoAjax');
    Route::get('/mypage/memberinfo/mail', 'MypageController@getMemberInfoMail')->name('client.memberinfo.mail');
    Route::post('/mypage/memberinfo/mail', 'MypageController@postMemberInfoMail');
    Route::get('/mypage/memberinfo/block', 'MypageController@getMemberInfoBlock')->name('client.memberinfo.block');
    Route::post('/mypage/memberinfo/add-block', 'MypageController@postMemberInfoAddBlock');
    Route::post('/mypage/memberinfo/remove-block', 'MypageController@postMemberInfoRemoveBlock');
    Route::post('/mypage/memberinfo/block-ajax', 'MypageController@memberInfoBlockAjax');
    Route::get('/mypage/memberinfo/register-member', 'MypageController@getMemberInfoRegister')->name('client.memberinfo.regmem');
    Route::post('/mypage/memberinfo/register-member-ajax', 'MypageController@registerMemberAjax');


    Route::get('/mypage/profile/cost', 'MypageController@getCost')->name('client.profile.cost');
    Route::get('/mypage/profile/edit-cost', 'MypageController@getEditCost')->name('client.profile.editCost');
    Route::post('/mypage/profile/edit-cost-ajax', 'MypageController@EditCostAjax');

    Route::get('/mypage/recruitment/{hire_id?}', 'RecruitController@getIndex')->name('client.recruitment')->where('hire_id', '[0-9]+');
    Route::post('/mypage/recruitment-ajax', 'RecruitController@postIndex');
    Route::post('/mypage/jobs/matching-case/task-setting-ajax', 'MypageController@ajaxtableTaskSetting');
    Route::post('/mypage/recruitment-workset-ajax', 'RecruitController@postIndexWorkset');
    Route::get('/mypage/recruitment/received/{hire_id?}', 'RecruitController@getReceived')->name('client.recruitment.received')->where('hire_id', '[0-9]+');
    Route::get('/mypage/recruitment/requested/{hire_id?}', 'RecruitController@getRequested')->name('client.recruitment.requested')->where('hire_id', '[0-9]+');
    Route::post('/mypage/recruitment/requested-ajax', 'RecruitController@postRequested');
    Route::get('/mypage/recruitment/finished/{hire_id?}', 'RecruitController@getFinished')->name('client.recruitment.finished')->where('hire_id', '[0-9]+');
    Route::get('/mypage/recruitment/job-request/{hire_id?}', 'RecruitController@getJobRq')->name('client.recruitment.jobrq')->where('hire_id', '[0-9]+');
    Route::get('/mypage/recruitment/submit-request', 'RecruitController@submitRequest')->name('client.recruitment.submitrq');
    Route::post('/mypage/recruitment/submit-request', 'RecruitController@postSubmitRequest');

    Route::post('/mypage/recruitment/matching-ajax', 'RecruitController@matchingRequested');
    Route::post('/mypage/recruitment/cancelmatching-ajax', 'RecruitController@cancelRequested');
    Route::post('/mypage/recruitment/finished/reopen', 'RecruitController@reOpenHire');

    Route::post('/recruitment/cancel-matching', 'RecruitController@postCancelMatching');


    Route::post('/mypage/jobs/matching-case/message-ajax', 'MypageController@ajaxMessageView');
    Route::post('/mypage/jobs/matching-case/task-view-ajax', 'MypageController@ajaxTaskView');
    Route::post('/mypage/jobs/matching-case/set_task-ajax', 'MypageController@ajaxSetTask');

    Route::get('/mypage/message', 'MypageController@getMessage')->name('client.message');
    Route::get('/mypage/check-list', 'MypageController@getCheckList')->name('client.checklist');
    Route::get('/mypage/message/readMessage', 'RecruitController@postReadMessage');

    /**
     * ONCUTHEN
     */
    Route::get('/mypage/message', 'MypageController@getMessage')->name('client.message');
    Route::get('/mypage/message_per_case', 'MypageController@messagePer_case')->name('client.message_per_case');
    Route::get('/mypage/message_every_massey', 'MypageController@messageEvery_massey')->name('client.message_every_massey');
    Route::get('/mypage/message_display_unread_only', 'MypageController@messageDisplay_unread_only')->name('client.message_display_unread_only');
    Route::get('/mypage/getmessagebyid', 'MypageController@getMessagebyid');
    Route::get('/mypage/searchmessage', 'MypageController@searchMessage');
    Route::post('/mypage/send_message', 'MypageController@sendMessage');

    Route::get('/mypage/downloadfile/{link}/{name}', 'MypageController@downloadurl');
    Route::get('/mypage/searchmessagepercase', 'MypageController@searchMessagePer_case');
    Route::get('/mypage/searchmessage_every_massey', 'MypageController@searchmessageEvery_massey');
    Route::get('/mypage/searchmessage_display_unread_only', 'MypageController@searchMessage_display_unread_only');
    Route::get('/mypage/getmessage_display_unread_only_byid', 'MypageController@getMessage_display_unread_only_byid');


    Route::get('/mypage/followlist/interest', 'MypageController@getInterest')
                ->name('client.followlist.interest');
    Route::get('/mypage/followlist/hide', 'MypageController@getNonrepresentation')
                ->name('client.followlist.hide');
    Route::get('/mypage/followlist/follow', 'MypageController@getFollow')
                ->name('client.followlist.follow');
    Route::get('/mypage/followlist/followers', 'MypageController@getFollowers')
                ->name('client.followlist.followers');

    Route::get('/mypage/followlist/choose_the_measures', 'MypageController@getChoose_the_measures')
                ->name('client.followlist.choose_the_measures');

    //Route::get('/fselect/{id}', 'MypageController@getFselect')
                //->name('client.fselect');    

    Route::get('/mypage/authentication/confidentiality_confirmation', 'MypageController@getConfidentiality_confirmation')
                ->name('client.authentication.confidentiality_confirmation');
    Route::get('/mypage/authentication/secretariat_confirmation', 'MypageController@getSecretariat_confirmation')
                ->name('client.authentication.secretariat_confirmation');
    Route::get('/mypage/authentication/call_confirmation', 'MypageController@getCall_confirmation')
                ->name('client.authentication.call_confirmation');

    Route::post('/mypage/authentication', 'MypageController@getAuthentication')->name('client.authentication');

    Route::post('/mypage/authentication/confidentiality_confirmation', 'MypageController@getConfidentiality_confirmation')
                ->name('client.authentication.confidentiality_confirmation');
    Route::post('/mypage/authentication/secretariat_confirmation', 'MypageController@getSecretariat_confirmation')
                ->name('client.authentication.secretariat_confirmation');
    Route::post('/mypage/authentication/call_confirmation', 'MypageController@getCall_confirmation')
                ->name('client.authentication.call_confirmation');
                
    Route::get('/mypage/payment/support_management', 'MypageController@getSupport_management')->name('client.payment.support_management');
    Route::get('/mypage/payment/invoice', 'MypageController@getInvoice')->name('client.payment.invoice');
    Route::get('/mypage/payment/withdrawal', 'MypageController@getWithdrawal')->name('client.payment.withdrawal');
    Route::post('/mypage/pay', 'MypageController@Pay')->name('client.pay');
    Route::post('/mypage/payment/withdrawal', 'MypageController@getWithdrawal')->name('client.payment.withdrawal');

    Route::get('/mypage/affiliate/result', 'MypageController@getResult')->name('client.affiliate.result');
    Route::get('/mypage/affiliate/register', 'MypageController@getRegister')->name('client.affiliate.register');
    Route::post('/mypage/affiliate/register', 'MypageController@getRegister')->name('client.affiliate.register');
    Route::get('/mypage/get_sub_local_ajax', 'MypageController@get_sub_local_ajax');
    /**
     * END ONCUTHEN
     */
});