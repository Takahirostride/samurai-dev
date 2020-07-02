<?php
/* BEGIN LUU */
Route::group(['middleware' => ['web'], 'module' => 'Admin', 'prefix' => 'admin', 'namespace' => 'App\Modules\Admin\Controllers'], function() {
    Route::group(['middleware' => 'App\Http\Middleware\CheckAdminLogged'], function() {
        Route::get('/', 'AdminController@getIndex');
        Route::get('/logout', 'AuthController@doLogout');
        Route::post('/doLogin', 'AuthController@doLogin');
    });
});   
Route::group(['middleware' => ['web', 'authAdmin', ], 'module' => 'Admin', 'prefix' => 'admin', 'namespace' => 'App\Modules\Admin\Controllers'], function() {
    Route::group(['middleware' => 'App\Http\Middleware\MasterAdmin'], function() {
        Route::get('/master', 'MasterController@getIndex')->name('master.top');
        Route::get('/master/balancedata', 'StatsController@getBalancedata')->name('master.balance.balancedata');
        Route::get('/master/ajaxbalancedata', 'StatsController@ajaxBalancedata')->name('master.balance.ajaxbalancedata');
        Route::get('/master/balancedepwith', 'PaymentController@getBalancedepwith')->name('master.balance.balancedepwith');
        Route::get('/master/balancepayplan', 'PaymentController@getBalancepayplan')->name('master.balance.balancepayplan');
        // Route::get('/master/balancesale', 'PaymentController@getBalancesale')->name('master.balance.balancesale');

        Route::get('/master/csv/down_balance_sale', 'PaymentController@downloadCsvBalancesale')->name('master.top.csv.down_balance_sale');
        Route::get('/master/csv/down_balance_depwith', 'PaymentController@downloadCsvBalancedepwith')->name('master.top.csv.down_balance_depwith');
        Route::get('/master/csvmanagement', 'CSVController@getCsvmanagement')->name('master.top.csvmanagement');
        Route::post('/master/import_user/{manage_flag}', 'CSVController@importUser')->name('master.top.postimport_user');
        Route::post('/master/import_affiliate', 'CSVController@importAffiliate')->name('master.top.postimport_affiliate');
        Route::post('/master/import_matching', 'CSVController@importMatching')->name('master.top.postimport_matching');
        Route::post('/master/import_policy', 'CSVController@importPolicy')->name('master.top.postimport_policy');
        Route::post('/master/import_agency_policy', 'CSVController@importAgencyPolicy')->name('master.top.import_agency_policy');
        Route::get('/master/down_user/{manage_flag}', 'CSVController@downUser')->name('master.top.down_user');
        Route::get('/master/down_affiliate', 'CSVController@downAffiliate')->name('master.top.down_affiliate');
        Route::get('/master/down_matching', 'CSVController@downMatching')->name('master.top.down_matching');
        Route::get('/master/down_policy', 'CSVController@downPolicy')->name('master.top.down_policy');
        Route::get('/master/down_agency_policy', 'CSVController@downAgencyPolicy')->name('master.top.down_agency_policy');
        Route::get('/master/edithistory', 'MasterController@getEdithistory')->name('master.profile.edithistory');
        Route::get('/master/employeeedit', 'MasterController@getEmployeeedit')->name('master.profile.employeeedit');
        Route::post('/master/employeeedit', 'MasterController@staffEdit')->name('master.profile.postemployeeedit');
        Route::get('/master/employeeedit/{id}', 'MasterController@getEmployeeedit')->name('master.profile.employeeeditid');
        Route::post('/master/employeeeadd', 'MasterController@staffRegister')->name('master.profile.postemployeeeadd');
        Route::get('/master/loginhistory', 'MasterController@getLoginhistory')->name('master.profile.loginhistory');
        Route::get('/master/profile', 'MasterController@getProfile')->name('master.profile.profile');
        Route::post('/master/profile', 'MasterController@master')->name('master.profile.postprofile');
        Route::get('/master/scrape', 'ScrapeController@getScrape')->name('master.top.scrape');
        Route::post('/master/scrape', 'ScrapeController@postScrape')->name('master.top.postscrape');
        Route::get('/master/scrapedata', 'ScrapeController@getScrapeData')->name('master.top.scrapedata');
        Route::get('/master/uploaded', 'UploadFileController@getUploaded')->name('master.top.uploaded');
    });
    Route::group(['middleware' => 'App\Http\Middleware\EmployeeAdmin'], function() {
        Route::get('/employee', 'EmployeeController@getIndex')->name('employee.top');
        // Route::get('/employee/csv', 'CSVController@getCsv')->name('employee.top.csv');
        // Route::get('/employee/uploadfile', 'UploadFileController@getUploadfile')->name('employee.top.uploadfile');
        // Route::get('/employee/email', 'EmailController@getEmail')->name('employee.top.email');
        // Route::get('/employee/balance/depwith', 'PaymentController@getDepwith')->name('employee.balance.depwith');
        Route::get('/employee/balance/payplan', 'PaymentController@getPayplan')->name('employee.balance.payplan');
        Route::post('/employee/balance/status', 'PaymentController@chang_status')->name('employee.balance.chang_status');
        Route::get('/employee/balance/sale', 'PaymentController@getSale')->name('employee.balance.sale');
    });

    Route::get('/employee/customerinfo/new-user', 'StaffPolicyController@getNewUser')->name('admin.StaffPolicyController.getNewUser');
    Route::post('/employee/customerinfo/person-confirm', 'StaffPolicyController@personConfirm')->name('admin.StaffPolicyController.person_confirm');
    Route::get('/employee/customerinfo/violate-user', 'StaffPolicyController@getViolateUser')->name('admin.StaffPolicyController.getViolateUser');
    Route::get('/employee/customerinfo/agencylist', 'StaffPolicyController@getAgencylist')->name('admin.StaffPolicyController.getAgencylist');
    Route::get('/employee/customerinfo/clientlist', 'StaffPolicyController@getClientlist')->name('admin.StaffPolicyController.getClientlist');
    Route::get('/employee/customerinfo/matchinglist', 'StaffPolicyController@getMatchinglist')->name('admin.StaffPolicyController.getMatchinglist');
    // Route::get('/employee/customersupport/inquiry', 'EmployeeController@getInquiry')->name('employee.customersupport.inquiry');
    // Route::get('/employee/customersupport/contact', 'EmployeeController@getContact')->name('employee.customersupport.contact');
    // Route::get('/employee/customersupport/identifydoc', 'EmployeeController@getIdentifydoc')->name('employee.customersupport.identifydoc');
    // Route::get('/employee/customersupport/identifyphrase', 'EmployeeController@getIdentifyphrase')->name('employee.customersupport.identifyphrase');
    // Route::get('/employee/customersupport/violator', 'EmployeeController@getViolator')->name('employee.customersupport.violator');
    // Route::get('/employee/customersupport/violatorphrase', 'EmployeeController@getViolatorphrase')->name('employee.customersupport.violatorphrase');
    // Route::get('/employee/customersupport/manageadvertise', 'EmployeeController@getManageadvertise')->name('employee.customersupport.manageadvertise');
    Route::get('/employee/data/subsidylist/{type?}', 'EmployeeDataController@getSubsidylist')->name('admin.employee.data.subsidylist');
    Route::get('/employee/data/subsidyedit/{id}', 'EmployeeDataController@edit')->name('admin.employee.data.subsidy_edit');
    Route::post('/employee/data/subsidyedit/{id}', 'EmployeeDataController@update')->name('admin.employee.data.subsidy_update');
    // Route::get('/employee/data/subsidyagency', 'EmployeeDataController@getSubsidyagency')->name('admin.employee.data.subsidyagency');//del
    Route::get('/employee/data/subsidyadd', 'EmployeeDataController@getsubSidyadd')->name('admin.employee.data.subsidyadd');
    Route::get('/employee/data/document', 'EmployeeDataController@getDocument')->name('admin.employee.data.document');
    Route::get('/employee/data/registration', 'EmployeeDataController@getRegistration')->name('admin.employee.data.registration');
    Route::get('/employee/other/affiliate', 'EmployeeController@getAffiliate')->name('admin.employee.other.affiliate');
    Route::get('/employee/other/payment', 'EmployeeController@getPayment')->name('admin.employee.other.payment');
    Route::get('/employee/other/paydata', 'EmployeeController@getPaydata')->name('admin.employee.other.paydata');
    Route::get('/employee/other/companies', 'EmployeeController@getCompanies')->name('admin.employee.other.companies');
    Route::get('/employee/other/data', 'EmployeeController@getData')->name('admin.employee.other.data');
    Route::get('/employee/other/seminardata', 'EmployeeController@getSeminardata')->name('admin.employee.other.seminardata');
    Route::post('/employee/other/seminardata', 'EmployeeController@postSeminardata')->name('admin.employee.other.postseminardata');
    Route::get('/employee/other/seminaradd', 'EmployeeController@getSeminaradd')->name('admin.employee.other.seminaradd');
    Route::post('/employee/other/seminaradd', 'EmployeeController@postSeminaradd')->name('admin.employee.other.postseminaradd');
    Route::get('/employee/other/seminaredit/{id}', 'EmployeeController@getSeminaredit')->name('admin.employee.other.seminareditid');
    Route::post('/employee/other/seminaredit', 'EmployeeController@postSeminaredit')->name('admin.employee.other.postseminareditid');
    Route::get('/employee/other/seminarapplicant/{id}', 'EmployeeController@getSeminarapplicant')->name('admin.employee.other.seminarapplicantid');
    Route::post('/employee/other/seminarapplicant/{id}', 'EmployeeController@postSeminarapplicant')->name('admin.employee.other.postseminarapplicantid');
    Route::get('/employee/other/seminarapplicant', 'EmployeeController@getSeminarapplicant')->name('admin.employee.other.seminarapplicant');
    Route::post('/employee/other/seminarapplicant', 'EmployeeController@postSeminarapplicant')->name('admin.employee.other.postseminarapplicant');
    Route::get('/employee/other/applicantdetail/{id}', 'EmployeeController@getApplicantdetail')->name('admin.employee.other.applicantdetailid');
    Route::post('/employee/other/applicantdetail', 'EmployeeController@postApplicantdetail')->name('admin.employee.other.postapplicantdetail');
    Route::get('/employee/system/advertisement', 'EmployeeController@getAdvertisement')->name('admin.employee.system.advertisement');
    Route::post('/employee/system/advertisement', 'EmployeeController@postAdvertisement')->name('admin.employee.system.postadvertisement');
    Route::get('/employee/system/uservoice', 'EmployeeController@getUservoice')->name('admin.employee.system.uservoice');
    Route::post('/employee/system/uservoice', 'EmployeeController@postUservoice')->name('admin.employee.system.postuservoice');
    Route::get('/employee/system/uservoiceadd', 'EmployeeController@getUservoiceadd')->name('admin.employee.system.uservoiceadd');
    Route::post('/employee/system/uservoiceadd', 'EmployeeController@postUservoiceadd')->name('admin.employee.system.postuservoiceadd');
    Route::get('/employee/system/uservoiceedit/{id}', 'EmployeeController@getUservoiceedit')->name('admin.employee.system.uservoiceeditid');
    Route::post('/employee/system/uservoiceedit', 'EmployeeController@postUservoiceedit')->name('admin.employee.system.postuservoiceedit');
    Route::get('/employee/system/uservoicedelete/{id}', 'EmployeeController@getUservoicedelete')->name('admin.employee.system.uservoicedelete');
    Route::get('/employee/system/alim', 'EmployeeController@getAlim')->name('admin.employee.system.alim');
    Route::post('/employee/system/alim', 'EmployeeController@postAlim')->name('admin.employee.system.postalim');
    Route::get('/employee/system/alimadd', 'EmployeeController@getAlimadd')->name('admin.employee.system.alimadd');
    Route::post('/employee/system/alimadd', 'EmployeeController@postAlimadd')->name('admin.employee.system.postalimadd');
    Route::get('/employee/system/alimedit/{id}', 'EmployeeController@getAlimedit')->name('admin.employee.system.alimeditid');
    Route::post('/employee/system/alimedit', 'EmployeeController@postAlimedit')->name('admin.employee.system.alimedit');
    Route::get('/employee/system/alimdelete/{id}', 'EmployeeController@getAlimdelete')->name('admin.employee.system.alimdelete');

    Route::get('/employee/system/industry', 'EmployeeController@getIndustry')->name('admin.employee.system.industry');
    Route::post('/employee/system/industry', 'EmployeeController@postIndustry')->name('admin.employee.system.postindustry');
    Route::post('/employee/system/industrystatus', 'EmployeeController@postIndustrystatus')->name('admin.employee.system.postindustrystatus');
    
    Route::get('/employee/system/tag', 'EmployeeController@getTag')->name('admin.employee.system.tag');
    Route::post('/employee/system/tag', 'EmployeeController@postTag')->name('admin.employee.system.posttag');
    Route::post('/employee/system/tagstatus', 'EmployeeController@postTagstatus')->name('admin.employee.system.posttagstatus');

    Route::get('/employee/system/category', 'EmployeeController@getCategory')->name('admin.employee.system.category');
    Route::post('/employee/system/category', 'EmployeeController@postCategory')->name('admin.employee.system.postcategory');
    Route::get('/employee/system/category/{subid}', 'EmployeeController@getCategory')->name('admin.employee.system.categoryid');
    Route::post('/employee/system/category/{subid}', 'EmployeeController@postCategory')->name('admin.employee.system.postcategoryid');
    Route::post('/employee/system/categorystatus', 'EmployeeController@postCategorystatus')->name('admin.employee.system.postcategorystatus');
    Route::post('/employee/system/subcategorystatus', 'EmployeeController@postSubCategorystatus')->name('admin.employee.system.postsubcategorystatus');
    Route::post('/employee/system/subcategory', 'EmployeeController@postSubCategory')->name('admin.employee.system.postsubcategory');
    
    Route::get('/employee/system/question', 'EmployeeController@getQuestion')->name('admin.employee.system.question');
    Route::post('/employee/system/question', 'EmployeeController@postQuestion')->name('admin.employee.system.postquestion');
    Route::get('/employee/system/question/{id}', 'EmployeeController@getQuestion')->name('admin.employee.system.questionid');
    Route::post('/employee/system/questionstatus', 'EmployeeController@postQuestionstatus')->name('admin.employee.system.postquestionstatus');
    


    Route::get('/employee/system/ajax_get_sub_category/{category_id}', 'EmployeeController@ajax_get_sub_category')->name('admin.employee.system.ajax_get_sub_category');

    Route::get('/employee/system/suggest', 'EmployeeController@getSuggest')->name('admin.employee.system.suggest');
    Route::get('/employee/system/payinfo', 'EmployeeController@getPayinfo')->name('admin.employee.system.payinfo');
    Route::get('/employee/system/notification', 'EmployeeController@getNotification')->name('admin.employee.system.notification');
    Route::get('/employee/system/blog', 'EmployeeController@getBlog')->name('admin.employee.system.blog');
    /* END LUU */

    /* BEGIN THANG */
    Route::get('/employee/customersupport/getInquirybyid/{id}', 'EmployeeController@getInquirybyid')->name('admin.employee.customersupport.getInquirybyid');
    // Route::get('/employee/customersupport/inquiry/{id}', 'EmployeeController@getInquiry');
    Route::post('/employee/customersupport/addfaq_answers', 'EmployeeController@insertFaq_answers');
    Route::post('/employee/customersupport/updateStatefaq', 'EmployeeController@updateStatefaq');

    Route::post('/employee/customersupport/updateContact', 'EmployeeController@updateContact');
    Route::get('/employee/customersupport/getContactbyid/{id}', 'EmployeeController@getContactbyid');
    Route::post('/employee/customersupport/delContact', 'EmployeeController@delContact');

    Route::get('/employee/customersupport/identifydoc/{id}', 'EmployeeController@getIdentifydoc');
    Route::get('/employee/customersupport/getidentifybyid/{id}', 'EmployeeController@getidentifybyid');
    Route::get('/employee/customersupport/personconfirmtemplatebyid/{id}', 'EmployeeController@getPersonconfirmtemplatebyid');
    Route::get('/employee/customersupport/downloadfile/{link}/{name}', 'EmployeeController@downloadurl');
    Route::post('/employee/customersupport/addPersonconfirmanswers', 'EmployeeController@addPersonconfirmanswers');
    Route::post('/employee/customersupport/addPersonconfirmanswers2', 'EmployeeController@addPersonconfirmanswers2');

    Route::post('/employee/customersupport/updateIdentifyphrase', 'EmployeeController@updateIdentifyphrase');
    Route::get('/employee/customersupport/getIdentifyphrasebyid/{id}', 'EmployeeController@getIdentifyphrasebyid');
    Route::post('/employee/customersupport/delIdentifyphrase', 'EmployeeController@delIdentifyphrase');

    Route::get('/employee/customersupport/violator/{id}', 'EmployeeController@getViolator');
    Route::get('/employee/customersupport/getViolatorbyid/{id}', 'EmployeeController@getViolatorbyid');
    Route::get('/employee/customersupport/getViolatortemplatebyid/{id}', 'EmployeeController@getViolatortemplatebyid');
    Route::post('/employee/customersupport/updateViolation', 'EmployeeController@updateViolation');
    Route::post('/employee/customersupport/updateViolation2', 'EmployeeController@updateViolation2');

    Route::post('/employee/customersupport/updateViolatorphrase', 'EmployeeController@updateViolatorphrase');
    Route::get('/employee/customersupport/getViolatorphrasebyid/{id}', 'EmployeeController@getViolatorphrasebyid');
    Route::post('/employee/customersupport/delViolatorphrase', 'EmployeeController@delViolatorphrase');

    Route::get('/employee/customersupport/changestatusitem', 'EmployeeController@changeStatusitem');
    Route::post('/employee/customersupport/changeStatusitemall', 'EmployeeController@changeStatusitemall');

    // Route::get('/employee/customersupport/advertiseedit/{id}', 'EmployeeController@advertiseEdit');
    
    Route::get('/employee/customersupport/advertisemessage/{id}', 'EmployeeController@advertiseMessage');
    Route::post('/employee/customersupport/send_message', 'EmployeeController@sendMessage');

    Route::post('/employee/system/payinfo', 'EmployeeController@getPayinfo');

    Route::get('/employee/system/notification/{id}', 'EmployeeController@getNotification');
    Route::get('/employee/system/notificationbyid/{id}', 'EmployeeController@getNotificationbyid');
    Route::post('/employee/system/updatenotification', 'EmployeeController@updateNotification');
    Route::post('/employee/system/changeoptionblog', 'EmployeeController@changeOptionblog');


    

    /* END THANG */

    /* BEGIN DUY */
    Route::get('/resource/address', 'AdminController@getProvince')->name('admin.resource.address');
    Route::get('/resource/minitry', 'AdminController@getMinitry')->name('admin.resource.minitry');   
    Route::get('/resource/minitry-povince', 'AdminController@getProvinceMinitry')->name('admin.resource.minitry_province');    
     //client
    Route::get('/employee/customerinfo/clientdetail/{id}', 'StaffPolicyController@edit')->name('admin.StaffPolicyController.edit');
    Route::get('/employee/customerinfo/clientdetail/{id}/availabletask', 'StaffPolicyController@availabletask')->name('admin.StaffPolicyController.availabletask');
    Route::get('/employee/customerinfo/clientdetail/{id}/rating', 'StaffPolicyController@ratingUser')->name('admin.StaffPolicyController.ratingUser');
    Route::post('/employee/customerinfo/clientdetail/{id}', 'StaffPolicyController@update')->name('admin.StaffPolicyController.update');
    Route::get('/employee/customerinfo/clientdetail/{id}/payement','StaffPolicyController@paymentClient')->name('admin.clientdetail.payment');    
    Route::get('/employee/customerinfo/clientdetail/{id}/violation','StaffPolicyController@violationClient')->name('admin.clientdetail.violation');    
    //agency
    Route::get('/employee/customerinfo/agencydetail/{id}', 'StaffPolicyController@edit_agency')->name('admin.StaffPolicyController.edit_agency');
    Route::get('/employee/customerinfo/agencydetail/{id}/availabletask', 'StaffPolicyController@availabletaskAgency')->name('admin.agencydetail.availabletask');
    Route::get('/employee/customerinfo/agencydetail/{id}/rating', 'StaffPolicyController@ratingAgency')->name('admin.agencydetail.ratingUser');
    Route::get('/employee/customerinfo/agencydetail/{id}/payement','StaffPolicyController@paymentAgency')->name('admin.agencydetail.payment');    
    Route::get('/employee/customerinfo/agencydetail/{id}/violation','StaffPolicyController@violationAgency')->name('admin.agencydetail.violation');    
    Route::post('/employee/customerinfo/user/{id}/store-violation','StaffPolicyController@storeViolation')->name('admin.customerinfo.storeviolation');    
    Route::post('/employee/customerinfo/user/{id}/change-permission','StaffPolicyController@changePermission')->name('admin.customerinfo.changepermission');    
    //feedback
    Route::get('/employee/customerinfo/feedback/{id}', 'StaffPolicyController@getFeedback');    
    Route::post('/employee/customerinfo/feedback', 'StaffPolicyController@updateFeedback');    
    //upload
    Route::post('/ajax/upload-image','UploadMediaController@storePath')->name('admin.upload_image');
    Route::post('/ajax/upload-pdf','UploadMediaController@storePdf')->name('admin.upload_pdf');
    //subsidy
    Route::post('/employee/data/subsidyadd', 'EmployeeDataController@store')->name('admin.employee.data.subsidy_store');
    Route::get('/employee/data/document/{id}/destroy', 'EmployeeDataController@destroy')->name('admin.employee.data.destroy');
    Route::get('/employee/data/registration/{id}/edit', 'EmployeeDataController@editRegistration')->name('admin.employee.data.edit_registration');
    Route::post('/employee/data/registration/{id}/edit', 'EmployeeDataController@updateRegistration')->name('admin.employee.data.updateRegistration');
    //replace-route
    Route::get('/employee/system/suggest', 'EmployeeSystemController@getSuggest')->name('admin.employee.system.suggest');
    /* END DUY */
    
});