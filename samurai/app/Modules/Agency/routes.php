<?php
Route::group(['middleware' => ['web'], 'module' => 'Agency', 'prefix' => 'agency', 'namespace' => 'App\Modules\Agency\Controllers'], function() {
    Route::get('/home_lock', 'AgencyController@getIndex')->name('agency.home_lock');
});

Route::group(['middleware' => ['web', 'auth', 'agency'], 'module' => 'Agency', 'prefix' => 'agency', 'namespace' => 'App\Modules\Agency\Controllers'], function() {
    Route::get('/', function() {
        return redirect('/agency/home');
    });

    // begin luu
    Route::get('/home', 'AgencyController@getIndex')->name('agency.index');
    Route::get('/likepolicy', 'B_Controller@likepolicy')->name('likepolicy');

    Route::get('/Bsubsidylist', 'B_Controller@getBsubsidylist')->name('agency.bsubsidylist');
    Route::get('/Bsubsidylist/{action}', 'B_Controller@getBsubsidylistAction')->name('agency.bsubsidylistaction');

    Route::get('/Bsearch', 'B_Controller@getBsearch')->name('agency.bsearch');
    Route::get('/ajaxGetCity/{name}', 'B_Controller@ajaxGetCity')->name('ajaxcities');
    Route::get('/ajaxGetRegion', 'B_Controller@ajaxGetRegion')->name('ajaxregion');
    Route::get('/Bselect/{policy_id}', 'B_Controller@getBselect')->name('agency.bselect');
    Route::get('/subsidydetail/{$post_id}/agencyprofile', 'B_Controller@getSubsidydetail')->name('agency.subsidydetail');

    Route::get('/Bask', 'B_Controller@getBask')->name('agency.getbask');
    // Route::get('/Bask', 'B_Controller@postBask')->name('agency.bask');

    Route::get('/ajaxGetToName/{user_ids}/{searchtype}', 'B_Controller@ajaxGetToName')->name('ajaxGetToName');
    Route::get('/ajaxGetToName/', 'B_Controller@ajaxGetToName')->name('ajaxGetToName');
    Route::post('/Bask/mess', 'B_Controller@postBaskMess')->name('agency.bask.mess');
    Route::post('/Bask/messbutton', 'B_Controller@postBaskbutton')->name('agency.bask.messbutton');
    Route::get('/Breport/{policy_id}/{report_id}', 'B_Controller@getBreport')->name('agency.breport');
    Route::post('/Breport', 'B_Controller@postBreport')->name('agency.postbreport');
    Route::get('/Breportcompletion/{policy_id}/{report_id}', 'B_Controller@getBreportcompletion')->name('agency.breportcompletion');



    Route::get('/Cpart', 'C_Controller@getCpart')->name('agency.cpart');
    Route::get('/Csubsidylist', 'C_Controller@getCsubsidylist')->name('agency.csubsidylist');
    Route::get('/Csetbalance', 'C_Controller@getCsetbalance')->name('agency.csetbalance');
    Route::post('/SaveMatching', 'C_Controller@postSaveMatching')->name('agency.savematching');
    Route::get('/ApplicableMeasuresList', 'C_Controller@getApplicableMeasuresList')->name('agency.ApplicableMeasuresList');
    Route::post('/EditMatching', 'C_Controller@postEditMatching')->name('agency.editmatching');
    Route::get('/DeleteMatching', 'C_Controller@getDeleteMatching')->name('agency.deletematching');
    Route::get('/DeleteMatching/{policy_id}', 'C_Controller@getDeleteMatching')->name('agency.deletematchingid');

    Route::get('/Dsubsidylist', 'D_Controller@getDsubsidylist')->name('agency.dsubsidylist');

    Route::post('/Dmatching', 'D_Controller@postDmatching')->name('agency.dmatching');

    
    Route::get('/Cselect/{policy_id}', 'C_Controller@getCselect')->name('agency.cselect');

    Route::get('/Cadd', 'C_Controller@getCadd')->name('agency.cadd');

    Route::get('/Dselect', 'D_Controller@getDselect')->name('agency.dselect');
    Route::get('/Dsearch', 'D_Controller@getDsearch')->name('agency.dsearch');
    Route::get('/Dfollowlist', 'D_Controller@getDfollowList')->name('agency.dfollowlist');
    Route::get('/Dmatchingpolicy', 'D_Controller@getDmatchingpolicy')->name('agency.dmatchingpolicy');

    Route::get('/DclientRequest', 'D_Controller@getDclientRequest')->name('agency.DclientRequest');
    Route::get('/Dinformation/{id}', 'D_Controller@getDinformation')->name('agency.dinformation');
    Route::post('/Dask', 'D_Controller@postDask')->name('agency.dask');


    Route::get('/profile/{client_id}', 'ProfileController@getProfile')->name('agency.profile.view');
    Route::get('/profile/available-task-show/{client_id}', 'ProfileController@getAvailableTaskShow')->name('agency.profile.view.availabletask');
    Route::get('/profile/rating/{client_id}', 'ProfileController@getRating')->name('agency.profile.view.rating');

    Route::get('/RequestDetails/{policy_id}/{client_id}', 'ProfileController@getRequestDetails')->name('agency.RequestDetails');
    Route::get('/EvaluationAchievements/{policy_id}/{client_id}', 'ProfileController@getEvaluationAchievements')->name('agency.EvaluationAchievements');
    Route::get('/Availablebusiness/{policy_id}/{client_id}', 'ProfileController@getAvailablebusiness')->name('agency.Availablebusiness');
    // Route::get('/ApplicableMeasures/{policy_id}/{client_id}', 'ProfileController@getApplicableMeasures')->name('agency.ApplicableMeasures');

    // end luu
    // 
    // 
    Route::get('/notify/{no_id}', 'AgencyController@getNotifyById')->name('agency.notify');
    Route::get('/notifylist', 'AgencyController@getNotifyList')->name('agency.notifylist');


    Route::get('/mypage/home', 'MypageController@getIndex')->name('agency.home');
    Route::post('/mypage/homeAjax', 'MypageController@indexAjax');

    Route::post('/mypage/uploadAvatar', 'MypageController@doAvatarUpload');
    Route::get('/mypage/profile', 'MypageController@getProfile')->name('agency.profile');
    Route::post('/mypage/profile', 'MypageController@postProfile');
    Route::post('/mypage/profile/loadCityByProvince', 'MypageController@loadCityByProvince');
    Route::post('/mypage/profile-ajax', 'MypageController@profileAjax');

    Route::get('/mypage/profile/available-task', 'MypageController@getAvailableTask')->name('agency.profile.availabletask');
    Route::post('/mypage/profile/available-task', 'MypageController@postAvailableTask');

    Route::get('/mypage/profile/available-subsidy', 'MypageController@getAvailableSubsidy')->name('agency.profile.availablesubsidy');
    Route::get('/mypage/profile/rating', 'MypageController@getRating')->name('agency.profile.rating');
    Route::post('/mypage/profile/rating-ajax', 'MypageController@ratingAjax');

    Route::get('/mypage/profile/cost', 'MypageController@getCost')->name('agency.profile.cost');
    Route::get('/mypage/profile/edit-cost', 'MypageController@getEditCost')->name('agency.profile.editCost');
    Route::post('/mypage/profile/edit-cost-ajax', 'MypageController@EditCostAjax');

    Route::get('/mypage/memberinfo', 'MypageController@getMemberInfo')->name('agency.memberinfo');
    Route::post('/mypage/memberinfo-ajax', 'MypageController@memberInfoAjax');
    Route::get('/mypage/memberinfo/mail', 'MypageController@getMemberInfoMail')->name('agency.memberinfo.mail');
    Route::post('/mypage/memberinfo/mail', 'MypageController@postMemberInfoMail');
    Route::get('/mypage/memberinfo/block', 'MypageController@getMemberInfoBlock')->name('agency.memberinfo.block');
    Route::post('/mypage/memberinfo/add-block', 'MypageController@postMemberInfoAddBlock');
    Route::post('/mypage/memberinfo/remove-block', 'MypageController@postMemberInfoRemoveBlock');
    Route::post('/mypage/memberinfo/block-ajax', 'MypageController@memberInfoBlockAjax');
    Route::post('/mypage/memberinfo/register-member-ajax', 'MypageController@registerMemberAjax');
    Route::get('/mypage/memberinfo/register-member', 'MypageController@getMemberInfoRegister')->name('agency.memberinfo.regmem');
    
    Route::get('/mypage/check-list', 'MypageController@getCheckList')->name('agency.checklist');
    
    Route::post('/mypage/memberinfo/register-member', 'MypageController@postMemberInfoRegister');

    Route::post('/recruitment/cancel-matching', 'RecruitController@postCancelMatching');


    Route::get('/mypage/jobs', 'MypageController@getMemberJobs')->name('agency.jobs');
    Route::get('/mypage/jobs-requests-received', 'MypageController@getJobRequests')->name('agency.jobs.requests');
    Route::get('/mypage/jobs/detail/{policy_id}', 'MypageController@getJobDetail')->name('agency.jobs.detail');
    Route::get('/mypage/jobs/company-detail/{policy_id}', 'MypageController@getCompanyDetail')->name('agency.jobs.com_detail');
    Route::get('/mypage/jobs/contact/{policy_id}', 'MypageController@getJobContact')->name('agency.jobs.bid_job');
    Route::get('/mypage/jobs/rq-detail/{policy_id}', 'MypageController@getJobRQDetail')->name('agency.jobs.rq_detail');
    Route::get('/mypage/jobs/rq-company-detail/{policy_id}', 'MypageController@getCompanyRQDetail')->name('agency.jobs.rq_com_detail');
    Route::get('/mypage/jobs/rq-contact/{policy_id}', 'MypageController@getJobRQContact')->name('agency.jobs.rq_bid_job');
    Route::post('/mypage/jobs/submit-hire', 'MypageController@postHireSubmit');
    Route::get('/mypage/jobs/matching-case', 'MypageController@getMatchingCase')->name('agency.jobs.matchingcase');
    Route::get('/mypage/jobs/finished-work', 'MypageController@getFinishedWork')->name('agency.jobs.finishedwork');
    Route::get('/mypage/jobs/finished-work/view-task/{id}', 'MypageController@getViewFinishWork')->name('agency.jobs.finished.rq_view_task');
    Route::get('/mypage/jobs/finished-work/message-task/{id}', 'MypageController@getMsgFinishWork')->name('agency.jobs.finished.rq_msg_task');
    Route::post('/mypage/jobs/finished-work-ajax', 'MypageController@ajaxFinishedWork');
    Route::get('/mypage/jobs/matching-case/book', 'MypageController@getMatchingBook')->name('agency.jobs.matching.book');
    Route::get('/mypage/jobs/matching-case/task-setting/{id}', 'MypageController@getTaskSetting')->name('agency.jobs.matching.setting_task');
    Route::post('/mypage/jobs/matching-case/task-setting/{id}', 'MypageController@postTaskSetting');
    Route::post('/mypage/jobs/matching-case/task-setting-action', 'MypageController@postDeleteTask');
    Route::post('/mypage/jobs/matching-case/task-setting-ajax', 'MypageController@ajaxtableTaskSetting');
    Route::get('/mypage/jobs/matching-case/task-setting/{id}/{work_set_id}', 'MypageController@getTaskEdit')->name('agency.jobs.matching.edit_task');
    Route::get('/mypage/jobs/matching-case/task-view/{id}', 'MypageController@getTaskView')->name('agency.jobs.matching.view_task');
    Route::post('/mypage/jobs/matching-case/task-view-ajax', 'MypageController@ajaxTaskView');
    Route::post('/mypage/jobs/matching-case/set_task-ajax', 'MypageController@ajaxSetTask');
    
    Route::get('/mypage/jobs/matching-case/message-view/{id}', 'MypageController@getMessageView')->name('agency.jobs.matching.view_message');
    Route::post('/mypage/jobs/matching-case/message-ajax', 'MypageController@ajaxMessageView');
    Route::get('/mypage/jobs/matching-case/report/{id}', 'MypageController@getMatchingReport')->name('agency.jobs.matching.report');
    Route::post('/mypage/jobs/matching-case/report/{id}', 'MypageController@postMatchingReport');
    Route::post('/mypage/jobs/matching-case/report-ajax', 'MypageController@ajaxGetHire');
    Route::get('/mypage/jobs/matching-case/complete/{id}', 'MypageController@getCompleteMatching')->name('agency.jobs.matching.complete');
    Route::post('/mypage/jobs/matching-case/complete/{id}', 'MypageController@postCompleteMatching');


    Route::get('/mypage/recruitment/{hire_id?}', 'RecruitController@getIndex')->name('agency.recruitment')->where('hire_id', '[0-9]+');
    Route::post('/mypage/recruitment-ajax', 'RecruitController@postIndex');
    Route::post('/mypage/recruitment-workset-ajax', 'RecruitController@postIndexWorkset');
    Route::get('/mypage/recruitment/received/{hire_id?}', 'RecruitController@getReceived')->name('agency.recruitment.received')->where('hire_id', '[0-9]+');
    Route::get('/mypage/recruitment/requested/{hire_id?}', 'RecruitController@getRequested')->name('agency.recruitment.requested')->where('hire_id', '[0-9]+');
    Route::post('/mypage/recruitment/requested-ajax', 'RecruitController@postRequested');
    Route::get('/mypage/recruitment/finished/{hire_id?}', 'RecruitController@getFinished')->name('agency.recruitment.finished')->where('hire_id', '[0-9]+');

    Route::get('/mypage/message', 'MypageController@getMessage')->name('agency.message');
    Route::get('/mypage/message/readMessage', 'RecruitController@postReadMessage');

    Route::post('/mypage/recruitment/requested/cancel-ajax', 'RecruitController@postCancelMatching');
    Route::post('/mypage/recruitment/requested/matching-submit', 'RecruitController@postRequestedMatching');



    /** ONCUTHEN */
    Route::get('/mypage/followlist', 'MypageController@getFollowList')->name('agency.followlist');
    Route::get('/mypage/authentication', 'MypageController@getAuthentication')->name('agency.authentication');
    Route::get('/mypage/payment', 'MypageController@getPayment')->name('agency.payment');
    Route::get('/mypage/affiliate', 'MypageController@getAffiliate')->name('agency.affiliate');
    Route::get('/mypage/sale', 'MypageController@getSale')->name('agency.sale');

    Route::get('/mypage/message_per_case', 'MypageController@messagePer_case')->name('agency.message_per_case');
    Route::get('/mypage/message_every_massey', 'MypageController@messageEvery_massey')->name('agency.message_every_massey');
    Route::get('/mypage/message_display_unread_only', 'MypageController@messageDisplay_unread_only')->name('agency.message_display_unread_only');
    Route::get('/mypage/getmessagebyid', 'MypageController@getMessagebyid');
    Route::get('/mypage/searchmessage', 'MypageController@searchMessage');
    Route::post('/mypage/send_message', 'MypageController@sendMessage');

    Route::get('/mypage/downloadfile/{link}/{name}', 'MypageController@downloadurl');
    Route::get('/mypage/searchmessagepercase', 'MypageController@searchMessagePer_case');
    Route::get('/mypage/searchmessage_every_massey', 'MypageController@searchmessageEvery_massey');
    Route::get('/mypage/searchmessage_display_unread_only', 'MypageController@searchMessage_display_unread_only');
    Route::get('/mypage/getmessage_display_unread_only_byid', 'MypageController@getMessage_display_unread_only_byid');

    Route::get('/mypage/followlist/interest', 'MypageController@getInterest')
                ->name('agency.followlist.interest');
    Route::get('/mypage/followlist/hide', 'MypageController@getNonrepresentation')
                ->name('agency.followlist.hide');
    Route::get('/mypage/followlist/follow', 'MypageController@getFollow')
                ->name('agency.followlist.follow');
    Route::get('/mypage/followlist/followers', 'MypageController@getFollowers')
                ->name('agency.followlist.followers');

    Route::get('/mypage/followlist/choose_the_measures', 'MypageController@getChoose_the_measures')
                ->name('agency.followlist.choose_the_measures');

    Route::get('/mypage/authentication/confidentiality_confirmation', 'MypageController@getConfidentiality_confirmation')
                ->name('agency.authentication.confidentiality_confirmation');
    Route::get('/mypage/authentication/secretariat_confirmation', 'MypageController@getSecretariat_confirmation')
                ->name('agency.authentication.secretariat_confirmation');
    Route::get('/mypage/authentication/call_confirmation', 'MypageController@getCall_confirmation')
                ->name('agency.authentication.call_confirmation');

    Route::post('/mypage/authentication', 'MypageController@getAuthentication')->name('agency.authentication');

    Route::post('/mypage/authentication/confidentiality_confirmation', 'MypageController@getConfidentiality_confirmation')
                ->name('agency.authentication.confidentiality_confirmation');
    Route::post('/mypage/authentication/secretariat_confirmation', 'MypageController@getSecretariat_confirmation')
                ->name('agency.authentication.secretariat_confirmation');
    Route::post('/mypage/authentication/call_confirmation', 'MypageController@getCall_confirmation')
                ->name('agency.authentication.call_confirmation');

    Route::get('/mypage/payment/support_management', 'MypageController@getSupport_management')->name('agency.payment.support_management');
    Route::get('/mypage/payment/withdrawal', 'MypageController@getWithdrawal')->name('agency.payment.withdrawal');
    Route::post('/mypage/pay', 'MypageController@Pay')->name('agency.pay');
    Route::post('/mypage/payment/withdrawal', 'MypageController@getWithdrawal')->name('agency.payment.withdrawal');

    Route::get('/mypage/affiliate/result', 'MypageController@getResult')->name('agency.affiliate.result');
    Route::get('/mypage/affiliate/register', 'MypageController@getRegister')->name('agency.affiliate.register');
    Route::post('/mypage/affiliate/register', 'MypageController@getRegister')->name('agency.affiliate.register');
    Route::get('/mypage/get_sub_local_ajax', 'MypageController@get_sub_local_ajax');


    

    //Beign-Duy
    Route::get('/Cadd', 'C_AddController@getCadd')->name('agency.cadd');            
    Route::post('/Cadd', 'C_AddController@storeCadd')->name('agency.cadd.store');            
    Route::get('/resource/provinces', 'C_AddController@getMinitry')->name('agency.resource.provinces');            










});
