<?php
Route::group(['middleware' => 'web'], function () {

    Route::get('/', 'Auth\AuthController@showLogin');
    Route::get('home', array('as'=>'home','uses'=>'Core\DashboardController@dashboard'));
    Route::get('login', array('as'=>'login','uses'=>'Auth\AuthController@showLogin'));
    Route::post('login', array('as'=>'login','uses'=>'Auth\AuthController@doLogin'));
    Route::get('logout', array('as'=>'logout','uses'=>'Auth\AuthController@doLogout'));
    Route::get('dashboard', array('as'=>'dashboard','uses'=>'Core\DashboardController@dashboard'));
    Route::get('patient/dashboard', array('as'=>'patient/dashboard','uses'=>'Patient\PatientDashboardController@dashboard'));
    Route::get('/errors/{errorId}', array('as'=>'/errors/{errorId}','uses'=>'Core\ErrorController@index'));
    Route::get('/error/{errorId}/{module}', array('as'=>'/error/{errorId}','uses'=>'Core\ErrorController@error'));
    Route::get('/unauthorize', array('as'=>'/unauthorize','uses'=>'Core\ErrorController@unauthorize'));
    Route::get('/unauthorize_patient', array('as'=>'/unauthorize_patient','uses'=>'Core\ErrorController@unauthorizePatient'));

    // Password Reset Routes...
    Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@showResetForm']);
    Route::post('password/email', ['as' => 'auth.password.email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
    Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@reset']);


    Route::group(['middleware' => 'right'], function () {

        // Site Configuration
        Route::get('config', array('as'=>'config','uses'=>'Core\ConfigController@edit'));
        Route::post('config', array('as'=>'config','uses'=>'Core\ConfigController@update'));

        //User
        Route::get('user', array('as'=>'user','uses'=>'Core\UserController@index'));
        Route::get('user/create', array('as'=>'user/create','uses'=>'Core\UserController@create'));
        Route::post('user/store', array('as'=>'user/store','uses'=>'Core\UserController@store'));
        Route::get('user/edit/{id}',  array('as'=>'user/edit','uses'=>'Core\UserController@edit'));
        Route::post('user/update', array('as'=>'user/update','uses'=>'Core\UserController@update'));
        Route::post('user/destroy', array('as'=>'user/destroy','uses'=>'Core\UserController@destroy'));
        Route::get('user/profile/{id}', array('as'=>'user/profile','uses'=>'Core\UserController@profile'));
        Route::get('userAuth', array('as'=>'userAuth','uses'=>'Core\UserController@getAuthUser'));
        Route::post('user/disable', array('as'=>'user/disable','uses'=>'Core\UserController@disable'));
        Route::post('user/enable', array('as'=>'user/enable','uses'=>'Core\UserController@enable'));

        //Role
        Route::get('role', array('as'=>'role','uses'=>'Core\RoleController@index'));
        Route::get('role/create',  array('as'=>'role/create','uses'=>'Core\RoleController@create'));
        Route::post('role/store',  array('as'=>'role/store','uses'=>'Core\RoleController@store'));
        Route::get('role/edit/{id}',  array('as'=>'role/edit','uses'=>'Core\RoleController@edit'));
        Route::post('role/update',  array('as'=>'role/update','uses'=>'Core\RoleController@update'));
        Route::post('role/destroy',  array('as'=>'role/destroy','uses'=>'Core\RoleController@destroy'));
        Route::get('rolePermission/{roleId}', array('as'=>'rolePermission','uses'=>'Core\RoleController@rolePermission'));
        Route::post('rolePermissionAssign/{id}',   array('as'=>'rolePermissionAssign','uses'=>'Core\RoleController@rolePermissionAssign'));

        //Permission
        Route::get('permission', array('as'=>'permission','uses'=>'Core\PermissionController@index'));
        Route::get('permission/create', array('as'=>'permission/create','uses'=>'Core\PermissionController@create'));
        Route::post('permission/store', array('as'=>'permission/store','uses'=>'Core\PermissionController@store'));
        Route::get('permission/edit/{id}', array('as'=>'permission/edit','uses'=>'Core\PermissionController@edit'));
        Route::post('permission/update', array('as'=>'permission/update','uses'=>'Core\PermissionController@update'));
        Route::post('permission/destroy', array('as'=>'permission/destroy','uses'=>'Core\PermissionController@destroy'));

        //City
        Route::get('city', array('as'=>'city','uses'=>'Backend\CityController@index'));
        Route::get('city/create', array('as'=>'city/create','uses'=>'Backend\CityController@create'));
        Route::post('city/store', array('as'=>'city/store','uses'=>'Backend\CityController@store'));
        Route::get('city/edit/{id}', array('as'=>'city/edit','uses'=>'Backend\CityController@edit'));
        Route::post('city/update', array('as'=>'city/update','uses'=>'Backend\CityController@update'));
        Route::post('city/destroy', array('as'=>'city/destroy','uses'=>'Backend\CityController@destroy'));

        //Township
        Route::get('township', array('as'=>'township','uses'=>'Backend\TownshipController@index'));
        Route::get('township/create', array('as'=>'township/create','uses'=>'Backend\TownshipController@create'));
        Route::post('township/store', array('as'=>'township/store','uses'=>'Backend\TownshipController@store'));
        Route::get('township/edit/{id}', array('as'=>'township/edit','uses'=>'Backend\TownshipController@edit'));
        Route::post('township/update', array('as'=>'township/update','uses'=>'Backend\TownshipController@update'));
        Route::post('township/destroy', array('as'=>'township/destroy','uses'=>'Backend\TownshipController@destroy'));

        //Cartype
        Route::get('cartype', array('as'=>'cartype','uses'=>'Backend\CartypeController@index'));
        Route::get('cartype/create', array('as'=>'cartype/create','uses'=>'Backend\CartypeController@create'));
        Route::post('cartype/store', array('as'=>'cartype/store','uses'=>'Backend\CartypeController@store'));
        Route::get('cartype/edit/{id}', array('as'=>'cartype/edit','uses'=>'Backend\CartypeController@edit'));
        Route::post('cartype/update', array('as'=>'cartype/update','uses'=>'Backend\CartypeController@update'));
        Route::post('cartype/destroy', array('as'=>'cartype/destroy','uses'=>'Backend\CartypeController@destroy'));

        //Zone
        Route::get('zone', array('as'=>'zone','uses'=>'Backend\ZoneController@index'));
        Route::get('zone/create', array('as'=>'zone/create','uses'=>'Backend\ZoneController@create'));
        Route::post('zone/store', array('as'=>'zone/store','uses'=>'Backend\ZoneController@store'));
        Route::get('zone/edit/{id}', array('as'=>'zone/edit','uses'=>'Backend\ZoneController@edit'));
        Route::post('zone/update', array('as'=>'zone/update','uses'=>'Backend\ZoneController@update'));
        Route::post('zone/destroy', array('as'=>'zone/destroy','uses'=>'Backend\ZoneController@destroy'));

        //Cartypesetup
        Route::get('cartypesetup', array('as'=>'cartypesetup','uses'=>'Backend\CartypesetupController@index'));
        Route::get('cartypesetup/create', array('as'=>'cartypesetup/create','uses'=>'Backend\CartypesetupController@create'));
        Route::post('cartypesetup/store', array('as'=>'cartypesetup/store','uses'=>'Backend\CartypesetupController@store'));
        Route::get('cartypesetup/edit/{id}', array('as'=>'cartypesetup/edit','uses'=>'Backend\CartypesetupController@edit'));
        Route::post('cartypesetup/update', array('as'=>'cartypesetup/update','uses'=>'Backend\CartypesetupController@update'));
        Route::post('cartypesetup/destroy', array('as'=>'cartypesetup/destroy','uses'=>'Backend\CartypesetupController@destroy'));


        //Enquiry
        Route::get('enquiry', array('as'=>'enquiry','uses'=>'Backend\EnquiryController@index'));
        Route::get('enquiry/create', array('as'=>'enquiry/create','uses'=>'Backend\EnquiryController@create'));
        Route::post('enquiry/store', array('as'=>'enquiry/store','uses'=>'Backend\EnquiryController@store'));
        Route::get('enquiry/edit/{id}', array('as'=>'enquiry/edit','uses'=>'Backend\EnquiryController@edit'));
        Route::post('enquiry/update', array('as'=>'enquiry/update','uses'=>'Backend\EnquiryController@update'));
        Route::post('enquiry/destroy', array('as'=>'enquiry/destroy','uses'=>'Backend\EnquiryController@destroy'));
        Route::post('enquiry/confirm', array('as'=>'enquiry/confirm','uses'=>'Backend\EnquiryController@confirm'));
        Route::post('enquiry/cancel', array('as'=>'enquiry/cancel','uses'=>'Backend\EnquiryController@cancel'));
        Route::get('enquiry/search/{enquiry_status?}/{enquiry_case_type?}/{from_date?}/{to_date?}', array('as'=>'enquiry/search/{enquiry_status?}/{enquiry_case_type?}/{from_date?}/{to_date?}','uses'=>'Backend\EnquiryController@search'));

        //Allergy
        Route::get('allergy', array('as'=>'allergy','uses'=>'Backend\AllergyController@index'));
        Route::get('allergy/create', array('as'=>'allergy/create','uses'=>'Backend\AllergyController@create'));
        Route::post('allergy/store', array('as'=>'allergy/store','uses'=>'Backend\AllergyController@store'));
        Route::get('allergy/edit/{id}', array('as'=>'allergy/edit','uses'=>'Backend\AllergyController@edit'));
        Route::post('allergy/update', array('as'=>'allergy/update','uses'=>'Backend\AllergyController@update'));
        Route::post('allergy/destroy', array('as'=>'allergy/destroy','uses'=>'Backend\AllergyController@destroy'));

        //Productcategory
        Route::get('productcategory', array('as'=>'productcategory','uses'=>'Backend\ProductcategoryController@index'));
        Route::get('productcategory/create', array('as'=>'productcategory/create','uses'=>'Backend\ProductcategoryController@create'));
        Route::post('productcategory/store', array('as'=>'productcategory/store','uses'=>'Backend\ProductcategoryController@store'));
        Route::get('productcategory/edit/{id}', array('as'=>'productcategory/edit','uses'=>'Backend\ProductcategoryController@edit'));
        Route::post('productcategory/update', array('as'=>'productcategory/update','uses'=>'Backend\ProductcategoryController@update'));
        Route::post('productcategory/destroy', array('as'=>'productcategory/destroy','uses'=>'Backend\ProductcategoryController@destroy'));

        //Product
        Route::get('product', array('as'=>'product','uses'=>'Backend\ProductController@index'));
        Route::get('product/create', array('as'=>'product/create','uses'=>'Backend\ProductController@create'));
        Route::post('product/store', array('as'=>'product/store','uses'=>'Backend\ProductController@store'));
        Route::get('product/edit/{id}', array('as'=>'product/edit','uses'=>'Backend\ProductController@edit'));
        Route::post('product/update', array('as'=>'product/update','uses'=>'Backend\ProductController@update'));
        Route::post('product/destroy', array('as'=>'product/destroy','uses'=>'Backend\ProductController@destroy'));

        //Package
        Route::get('package', array('as'=>'package','uses'=>'Backend\PackageController@index'));
        Route::get('package/create', array('as'=>'package/create','uses'=>'Backend\PackageController@create'));
        Route::post('package/store', array('as'=>'package/store','uses'=>'Backend\PackageController@store'));
        Route::get('package/edit/{id}', array('as'=>'package/edit','uses'=>'Backend\PackageController@edit'));
        Route::post('package/update', array('as'=>'package/update','uses'=>'Backend\PackageController@update'));
        Route::post('package/destroy', array('as'=>'package/destroy','uses'=>'Backend\PackageController@destroy'));
        Route::get('package/promotion/{id}', array('as'=>'package/promotion','uses'=>'Backend\PackageController@editPromotion'));
        Route::post('package/createPromotion', array('as'=>'package/createPromotion','uses'=>'Backend\PackageController@createPromotion'));
        Route::post('package/updatePromotion', array('as'=>'package/updatePromotion','uses'=>'Backend\PackageController@updatePromotion'));

        //Service
        Route::get('service', array('as'=>'service','uses'=>'Backend\ServiceController@index'));
        Route::get('service/create', array('as'=>'service/create','uses'=>'Backend\ServiceController@create'));
        Route::post('service/store', array('as'=>'service/store','uses'=>'Backend\ServiceController@store'));
        Route::get('service/edit/{id}', array('as'=>'service/edit','uses'=>'Backend\ServiceController@edit'));
        Route::post('service/update', array('as'=>'service/update','uses'=>'Backend\ServiceController@update'));
        Route::post('service/destroy', array('as'=>'service/destroy','uses'=>'Backend\ServiceController@destroy'));


        //Investigation
        Route::get('investigation', array('as'=>'investigation','uses'=>'Backend\InvestigationController@index'));
        Route::get('investigation/create', array('as'=>'investigation/create','uses'=>'Backend\InvestigationController@create'));
        Route::post('investigation/store', array('as'=>'investigation/store','uses'=>'Backend\InvestigationController@store'));
        Route::get('investigation/edit/{id}', array('as'=>'investigation/edit','uses'=>'Backend\InvestigationController@edit'));
        Route::post('investigation/update', array('as'=>'investigation/update','uses'=>'Backend\InvestigationController@update'));
        Route::post('investigation/destroy', array('as'=>'investigation/destroy','uses'=>'Backend\InvestigationController@destroy'));

        //Physical Exam
        Route::get('physicalexam', array('as'=>'physicalexam','uses'=>'Backend\PhysicalexamController@index'));
        Route::get('physicalexam/create', array('as'=>'physicalexam/create','uses'=>'Backend\PhysicalexamController@create'));
        Route::post('physicalexam/store', array('as'=>'physicalexam/store','uses'=>'Backend\PhysicalexamController@store'));
        Route::get('physicalexam/edit/{id}', array('as'=>'physicalexam/edit','uses'=>'Backend\PhysicalexamController@edit'));
        Route::post('physicalexam/update', array('as'=>'physicalexam/update','uses'=>'Backend\PhysicalexamController@update'));
        Route::post('physicalexam/destroy', array('as'=>'physicalexam/destroy','uses'=>'Backend\PhysicalexamController@destroy'));

        //Patient
        Route::get('patient', array('as'=>'patient','uses'=>'Backend\PatientController@index'));
        Route::get('patient/create', array('as'=>'patient/create','uses'=>'Backend\PatientController@create'));
        Route::post('patient/store', array('as'=>'patient/store','uses'=>'Backend\PatientController@store'));
        Route::get('patient/edit/{id}', array('as'=>'patient/edit','uses'=>'Backend\PatientController@edit'));
        Route::post('patient/update', array('as'=>'patient/update','uses'=>'Backend\PatientController@update'));
        Route::post('patient/destroy', array('as'=>'patient/destroy','uses'=>'Backend\PatientController@destroy'));
        Route::get('patient/checkzone/{id}', array('as'=>'patient/checkzone','uses'=>'Backend\PatientController@checkZone'));
        Route::get('patient/detail/{id}', array('as'=>'patient/detail','uses'=>'Backend\PatientController@detail'));
        Route::get('patient/patientSchedule/{id}', array('as'=>'patient/detail','uses'=>'Backend\PatientController@patientSchedules'));
        Route::get('patient/detailvisit/{id}', array('as'=>'patient/detail','uses'=>'Backend\PatientController@detailvisit'));
        //newly added patient detail design
        Route::get('patient/patient_detail/{id}', array('as'=>'patient/patient_detail','uses'=>'Backend\PatientController@patientDetail'));
        Route::get('patient/invoice/{id}', array('as'=>'salesummaryreport/invoicedetail/{id}','uses'=>'Report\SaleSummaryReportController@invoicedetail'));

        //Addendum
        Route::post('addendum/store', array('as'=>'addendum/store','uses'=>'Backend\PatientController@addAddendum'));

        //Patient Profile
        Route::get('patient/profile', array('as'=>'patient/profile','uses'=>'Patient\PatientProfileController@edit'));
        Route::post('patient/profile', array('as'=>'patient/profile','uses'=>'Patient\PatientProfileController@update'));

        //Patient Case Summary
        Route::get('patient/case', array('as'=>'patient/case','uses'=>'Patient\PatientCaseController@index'));
        Route::get('patient/export', array('as'=>'patient/export','uses'=>'Patient\PatientCaseController@export'));

        //Log Patient Case Summary
        Route::get('patient/log',array('as'=>'patient/log','uses'=>'Patient\PatientLogController@index'));
        Route::post('patient/log/search',array('as'=>'patient/log/search','uses'=>'Patient\PatientLogController@search'));
        //Schedule
        Route::get('schedule', array('as'=>'schedule','uses'=>'Backend\ScheduleController@index'));
        Route::get('schedule/create', array('as'=>'schedule/create','uses'=>'Backend\ScheduleController@create'));
        Route::post('schedule/store', array('as'=>'schedule/store','uses'=>'Backend\ScheduleController@store'));
        Route::get('schedule/edit/{id}', array('as'=>'schedule/edit','uses'=>'Backend\ScheduleController@edit'));
        Route::post('schedule/update', array('as'=>'schedule/update','uses'=>'Backend\ScheduleController@update'));
        Route::post('schedule/destroy', array('as'=>'schedule/destroy','uses'=>'Backend\ScheduleController@destroy'));
        Route::post('schedule/cancel', array('as'=>'schedule/cancel','uses'=>'Backend\ScheduleController@cancel'));
        Route::post('schedule/create', array('as'=>'schedule/create','uses'=>'Backend\ScheduleController@create'));
        Route::get('schedule/search/{schedule_status?}/{from_date?}/{to_date?}', array('as'=>'schedule/search/{schedule_status?}/{from_date?}/{to_date?}','uses'=>'Backend\ScheduleController@search'));

        //Package Sale
        Route::get('packagesale', array('as'=>'packagesale','uses'=>'Backend\PackageSaleController@index'));
        Route::get('packagesale/create', array('as'=>'packagesale/create','uses'=>'Backend\PackageSaleController@create'));
        Route::post('packagesale/store', array('as'=>'packagesale/store','uses'=>'Backend\PackageSaleController@store'));
        Route::get('packagesale/invoice/{id}/{couponcode}', array('as'=>'packagesale/invoice','uses'=>'Backend\PackageSaleController@invoice'));
        Route::get('packagesale/export/{id}/{couponcode}', array('as'=>'packagesale/export','uses'=>'Backend\PackageSaleController@export'));
        Route::get('packagesale/schedule/{id}', array('as'=>'packagesale/schedule','uses'=>'Backend\PackageSaleController@schedule'));

        //Family History
        Route::get('familyhistory', array('as'=>'familyhistory','uses'=>'Backend\FamilyhistoryController@index'));
        Route::get('familyhistory/create', array('as'=>'familyhistory/create','uses'=>'Backend\FamilyhistoryController@create'));
        Route::post('familyhistory/store', array('as'=>'familyhistory/store','uses'=>'Backend\FamilyhistoryController@store'));
        Route::get('familyhistory/edit/{id}', array('as'=>'familyhistory/edit','uses'=>'Backend\FamilyhistoryController@edit'));
        Route::post('familyhistory/update', array('as'=>'familyhistory/update','uses'=>'Backend\FamilyhistoryController@update'));
        Route::post('familyhistory/destroy', array('as'=>'familyhistory/destroy','uses'=>'Backend\FamilyhistoryController@destroy'));

        //Family Member
        Route::get('familymember', array('as'=>'familymember','uses'=>'Backend\FamilymemberController@index'));
        Route::get('familymember/create', array('as'=>'familymember/create','uses'=>'Backend\FamilymemberController@create'));
        Route::post('familymember/store', array('as'=>'familymember/store','uses'=>'Backend\FamilymemberController@store'));
        Route::get('familymember/edit/{id}', array('as'=>'familymember/edit','uses'=>'Backend\FamilymemberController@edit'));
        Route::post('familymember/update', array('as'=>'familymember/update','uses'=>'Backend\FamilymemberController@update'));
        Route::post('familymember/destroy', array('as'=>'familymember/destroy','uses'=>'Backend\FamilymemberController@destroy'));

        //Patient Family History
//        Route::get('patientfamilyhistory', array('as'=>'patientfamilyhistory','uses'=>'Backend\PatientfamilyhistoryController@index'));
        Route::get('patientfamilyhistory/{patient_id}', array('as'=>'patientfamilyhistory','uses'=>'Backend\PatientfamilyhistoryController@index'));
        Route::get('patientfamilyhistory/create/{patient_id}', array('as'=>'patientfamilyhistory/create','uses'=>'Backend\PatientfamilyhistoryController@create'));
        Route::post('patientfamilyhistory/store', array('as'=>'patientfamilyhistory/store','uses'=>'Backend\PatientfamilyhistoryController@store'));
        Route::get('patientfamilyhistory/edit/{id}', array('as'=>'patientfamilyhistory/edit','uses'=>'Backend\PatientfamilyhistoryController@edit'));
        Route::post('patientfamilyhistory/update', array('as'=>'patientfamilyhistory/update','uses'=>'Backend\PatientfamilyhistoryController@update'));
        Route::post('patientfamilyhistory/destroy', array('as'=>'patientfamilyhistory/destroy','uses'=>'Backend\PatientfamilyhistoryController@destroy'));

        //Medical History
        Route::get('medicalhistory', array('as'=>'medicalhistory','uses'=>'Backend\MedicalhistoryController@index'));
        Route::get('medicalhistory/create', array('as'=>'medicalhistory/create','uses'=>'Backend\MedicalhistoryController@create'));
        Route::post('medicalhistory/store', array('as'=>'medicalhistory/store','uses'=>'Backend\MedicalhistoryController@store'));
        Route::get('medicalhistory/edit/{id}', array('as'=>'medicalhistory/edit','uses'=>'Backend\MedicalhistoryController@edit'));
        Route::post('medicalhistory/update', array('as'=>'medicalhistory/update','uses'=>'Backend\MedicalhistoryController@update'));
        Route::post('medicalhistory/destroy', array('as'=>'medicalhistory/destroy','uses'=>'Backend\MedicalhistoryController@destroy'));

        //Patient Medical History
//        Route::get('patientmedicalhistory', array('as'=>'patientmedicalhistory','uses'=>'Backend\PatientmedicalhistoryController@index'));
        Route::get('patientmedicalhistory/{patient_id}', array('as'=>'patientmedicalhistory','uses'=>'Backend\PatientmedicalhistoryController@index'));
        Route::get('patientmedicalhistory/create/{patient_id}', array('as'=>'patientmedicalhistory/create','uses'=>'Backend\PatientmedicalhistoryController@create'));
        Route::post('patientmedicalhistory/store', array('as'=>'patientmedicalhistory/store','uses'=>'Backend\PatientmedicalhistoryController@store'));
        Route::get('patientmedicalhistory/edit/{id}', array('as'=>'patientmedicalhistory/edit','uses'=>'Backend\PatientmedicalhistoryController@edit'));
        Route::post('patientmedicalhistory/update', array('as'=>'patientmedicalhistory/update','uses'=>'Backend\PatientmedicalhistoryController@update'));
        Route::post('patientmedicalhistory/destroy', array('as'=>'patientmedicalhistory/destroy','uses'=>'Backend\PatientmedicalhistoryController@destroy'));

        //Patient Surgery History
//        Route::get('patientsurgeryhistory', array('as'=>'patientsurgeryhistory','uses'=>'Backend\PatientsurgeryhistoryController@index'));
        Route::get('patientsurgeryhistory/{patient_id}', array('as'=>'patientsurgeryhistory','uses'=>'Backend\PatientsurgeryhistoryController@index'));
        Route::get('patientsurgeryhistory/create/{patient_id}', array('as'=>'patientsurgeryhistory/create','uses'=>'Backend\PatientsurgeryhistoryController@create'));
        Route::post('patientsurgeryhistory/store', array('as'=>'patientsurgeryhistory/store','uses'=>'Backend\PatientsurgeryhistoryController@store'));
        Route::get('patientsurgeryhistory/edit/{id}', array('as'=>'patientsurgeryhistory/edit','uses'=>'Backend\PatientsurgeryhistoryController@edit'));
        Route::post('patientsurgeryhistory/update', array('as'=>'patientsurgeryhistory/update','uses'=>'Backend\PatientsurgeryhistoryController@update'));
        Route::post('patientsurgeryhistory/destroy', array('as'=>'patientsurgeryhistory/destroy','uses'=>'Backend\PatientsurgeryhistoryController@destroy'));

        //Provisional Diagnosis
        Route::get('provisionaldiagnosis', array('as'=>'provisionaldiagnosis','uses'=>'Backend\ProvisionaldiagnosisController@index'));
        Route::get('provisionaldiagnosis/create', array('as'=>'provisionaldiagnosis/create','uses'=>'Backend\ProvisionaldiagnosisController@create'));
        Route::post('provisionaldiagnosis/store', array('as'=>'provisionaldiagnosis/store','uses'=>'Backend\ProvisionaldiagnosisController@store'));
        Route::get('provisionaldiagnosis/edit/{id}', array('as'=>'provisionaldiagnosis/edit','uses'=>'Backend\ProvisionaldiagnosisController@edit'));
        Route::post('provisionaldiagnosis/update', array('as'=>'provisionaldiagnosis/update','uses'=>'Backend\ProvisionaldiagnosisController@update'));
        Route::post('provisionaldiagnosis/destroy', array('as'=>'provisionaldiagnosis/destroy','uses'=>'Backend\ProvisionaldiagnosisController@destroy'));

        //Route
        Route::get('route', array('as'=>'route','uses'=>'Backend\RouteController@index'));
        Route::get('route/create', array('as'=>'route/create','uses'=>'Backend\RouteController@create'));
        Route::post('route/store', array('as'=>'route/store','uses'=>'Backend\RouteController@store'));
        Route::get('route/edit/{id}', array('as'=>'route/edit','uses'=>'Backend\RouteController@edit'));
        Route::post('route/update', array('as'=>'route/update','uses'=>'Backend\RouteController@update'));
        Route::post('route/destroy', array('as'=>'route/destroy','uses'=>'Backend\RouteController@destroy'));

        //Patient Schedule History
        Route::get('patient/schedule', array('as'=>'patient/schedule','uses'=>'Patient\ScheduleHistoryController@index'));

        //Patient Service History
        Route::get('patient/service', array('as'=>'patient/service','uses'=>'Patient\ServiceHistoryController@index'));

        //Patient Package History
        Route::get('patient/package', array('as'=>'patient/package','uses'=>'Patient\PackageHistoryController@index'));

        //Booking Request
        Route::get('patient/bookingrequest', array('as'=>'patient/bookingrequest','uses'=>'Patient\BookingRequestController@create'));
        Route::post('patient/bookingrequest/store', array('as'=>'patient/bookingrequest/store','uses'=>'Patient\BookingRequestController@store'));

        //Invoice
        Route::get('patient/invoice', array('as'=>'patient/invoice','uses'=>'Patient\InvoiceController@index'));
        Route::get('patient/invoicedetail/{id}', array('as'=>'patient/invoicedetail','uses'=>'Patient\InvoiceController@detail'));
        Route::get('patient/invoice_export/{id}', array('as'=>'patient/invoice_export','uses'=>'Patient\InvoiceController@export'));

        //Present Medication
        Route::get('patient/medication', array('as'=>'patient/medication','uses'=>'Patient\PresentMedicationController@index'));

        //Test routes
        Route::get('test', array('as'=>'test','uses'=>'Backend\TestController@index'));
        Route::get('test_print', array('as'=>'test','uses'=>'Backend\TestController@testPrint'));

        //Reports
        //Car Usage Report
        Route::get('carusagereport', array('as'=>'carusagereport','uses'=>'Report\CarUsageReportController@index'));
        Route::get('carusagereport/search/{from_date?}/{to_date?}', array('as'=>'carusagereport/search/{from_date?}/{to_date?}','uses'=>'Report\CarUsageReportController@search'));
        Route::get('carusagereport/exportexcel/{from_date?}/{to_date?}', array('as'=>'carusagereport/exportexcel/{from_date?}/{to_date?}','uses'=>'Report\CarUsageReportController@excel'));
        Route::get('carusagereportbygraph', array('as'=>'carusagereportbygraph','uses'=>'Report\CarUsageReportController@graph'));
        Route::get('carusagereportbygraph/search/{from_date?}/{to_date?}', array('as'=>'carusagereportbygraph/search/{from_date?}/{to_date?}','uses'=>'Report\CarUsageReportController@graphsearch'));

        //Visit Report
        Route::get('visitreport', array('as'=>'visitreport','uses'=>'Report\VisitReportController@index'));
        Route::get('visitreport/search/{type?}/{from_date?}/{to_date?}', array('as'=>'visitreport/search/{type?}/{from_date?}/{to_date?}','uses'=>'Report\VisitReportController@search'));
        Route::get('visitreport/exportexcel/{type?}/{from_date?}/{to_date?}', array('as'=>'visitreport/exportexcel/{type?}/{from_date?}/{to_date?}','uses'=>'Report\VisitReportController@excel'));

        //Patient Visit Report
        Route::get('patientvisitreport', array('as'=>'patientvisitreport','uses'=>'Report\PatientVisitReportController@index'));
        Route::get('patientvisitreport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', array('as'=>'patientvisitreport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}','uses'=>'Report\PatientVisitReportController@search'));
        Route::get('patientvisitreport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', array('as'=>'patientvisitreport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}','uses'=>'Report\PatientVisitReportController@excel'));
        Route::get('patientvisitreportdetail/{type}/{date}', array('as'=>'patientvisitreportdetail','uses'=>'Report\PatientVisitReportController@patientVisitDetail'));

        //Patient Daily Visit Report
        Route::get('patientdailyvisitreport', array('as'=>'patientdailyvisitreport','uses'=>'Report\PatientDailyVisitReportController@index'));
        Route::get('patientdailyvisitreport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', array('as'=>'patientdailyvisitreport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}','uses'=>'Report\PatientDailyVisitReportController@search'));
        Route::get('patientdailyvisitreport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', array('as'=>'patientdailyvisitreport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}','uses'=>'Report\PatientDailyVisitReportController@excel'));

        //Schedule Status Report
        Route::get('schedulestatusreport', array('as'=>'schedulestatusreport','uses'=>'Report\ScheduleStatusReportController@index'));
        Route::get('schedulestatusreport/search/{from_date?}/{to_date?}', array('as'=>'schedulestatusreport/search/{from_date?}/{to_date?}','uses'=>'Report\ScheduleStatusReportController@search'));

        //Sale Summary Report
        Route::get('salesummaryreport', array('as'=>'salesummaryreport','uses'=>'Report\SaleSummaryReportController@index'));
        Route::get('salesummaryreport/search/{from_date?}/{to_date?}', array('as'=>'salesummaryreport/search/{from_date?}/{to_date?}','uses'=>'Report\SaleSummaryReportController@search'));
        Route::get('salesummaryreport/exportexcel/{from_date?}/{to_date?}', array('as'=>'salesummaryreport/exportexcel/{from_date?}/{to_date?}','uses'=>'Report\SaleSummaryReportController@excel'));
        Route::get('salesummaryreport/invoicedetail/{id}', array('as'=>'salesummaryreport/invoicedetail/{id}','uses'=>'Report\SaleSummaryReportController@invoicedetail'));
        Route::get('salesummaryreport/invoice_export/{id}', array('as'=>'salesummaryreport/invoice_export/{id}','uses'=>'Report\SaleSummaryReportController@export'));

        //Income Summary Report
        Route::get('incomesummaryreport', array('as'=>'incomesummaryreport','uses'=>'Report\IncomeSummaryReportController@index'));
        Route::get('incomesummaryreport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', array('as'=>'incomesummaryreport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}','uses'=>'Report\IncomeSummaryReportController@search'));
        Route::get('incomesummaryreport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', array('as'=>'incomesummaryreport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}','uses'=>'Report\IncomeSummaryReportController@excel'));
        Route::get('incomesummaryreportbygraph', array('as'=>'incomesummaryreportbygraph','uses'=>'Report\IncomeSummaryReportController@graph'));
        Route::get('incomesummaryreportbygraph/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', array('as'=>'incomesummaryreportbygraph/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}','uses'=>'Report\IncomeSummaryReportController@graphsearch'));

        //New Sale Income Report
        Route::get('saleincomereport', array('as'=>'saleincomereport','uses'=>'Report\SaleIncomeReportController@index'));
        Route::get('saleincomereport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', array('as'=>'saleincomereport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}','uses'=>'Report\SaleIncomeReportController@search'));
        Route::get('saleincomereport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', array('as'=>'saleincomereport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}','uses'=>'Report\SaleIncomeReportController@excel'));
        Route::get('saleincomereport/invoicelist/{date?}/{type?}', array('as'=>'saleincomereport/invoicelist/{date?}/{type?}','uses'=>'Report\SaleIncomeReportController@invoiceList'));
        Route::get('saleincomereport/invoice/{id}', array('as'=>'salesummaryreport/invoicedetail/{id}','uses'=>'Report\SaleSummaryReportController@invoicedetail'));
        // Route::get('saleincomereportbygraph', array('as'=>'saleincomereportbygraph','uses'=>'Report\SaleIncomeReportController@graph'));
        // Route::get('saleincomereportbygraph/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}', array('as'=>'saleincomereportbygraph/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}','uses'=>'Report\SaleIncomeReportController@graphsearch'));

        //Activities
        Route::get('activities', array('as'=>'activities','uses'=>'Backend\ActivitiesController@index'));

        //Patient Test Data
        Route::get('insert_patient/{count}', array('as'=>'activities','uses'=>'Backend\TestController@insert_patient_test_data'));
        Route::get('delete_patient', array('as'=>'activities','uses'=>'Backend\TestController@delete_patient_test_data'));

        //Import CSV
        Route::get('import', array('as'=>'import','uses'=>'CSVImport\CSVImportController@import'));
        Route::post('import/store', array('as'=>'import/store','uses'=>'CSVImport\CSVImportController@store'));

        //Api List
        Route::get('apilist/syncdownapi', array('as'=>'apilist/syncdownapi','uses'=>'Backend\ApiListController@syncdownapi'));
        Route::get('apilist/invoiceapi', array('as'=>'apilist/invoiceapi','uses'=>'Backend\ApiListController@invoiceapi'));
        Route::get('apilist/enquiryapi', array('as'=>'apilist/enquiryapi','uses'=>'Backend\ApiListController@enquiryapi'));
        Route::get('apilist/scheduleapi', array('as'=>'apilist/scheduleapi','uses'=>'Backend\ApiListController@scheduleapi'));
        Route::get('apilist/patientpackageapi', array('as'=>'apilist/patientpackageapi','uses'=>'Backend\ApiListController@patientpackageapi'));
        Route::get('apilist/waytrackingapi', array('as'=>'apilist/waytrackingapi','uses'=>'Backend\ApiListController@waytrackingapi'));
        Route::get('apilist/patientapi', array('as'=>'apilist/patientapi','uses'=>'Backend\ApiListController@patientapi'));
        Route::get('apilist/companyinformationapi', array('as'=>'apilist/companyinformationapi','uses'=>'Backend\ApiListController@companyinformationapi'));

        //Price history
        Route::get('pricehistory/{type?}/{id?}', array('as'=>'pricehistory/{type?}/{id?}','uses'=>'Log\PriceHistoryController@search'));
        Route::get('multiplepricehistory/{type?}/{id?}', array('as'=>'multiplepricehistory/{type?}/{id?}','uses'=>'Log\PriceHistoryController@multiplesearch'));

        //Tablet Issues
        Route::get('tabletissues/{type?}', array('as'=>'tabletissues/{type?}','uses'=>'Log\TabletIssuesController@search'));

        //Investigation Imaging
        Route::get('investigationimaging', array('as'=>'investigationimaging','uses'=>'Backend\InvestigationImagingController@index'));
        Route::get('investigationimaging/create', array('as'=>'investigationimaging/create','uses'=>'Backend\InvestigationImagingController@create'));
        Route::post('investigationimaging/store', array('as'=>'investigationimaging/store','uses'=>'Backend\InvestigationImagingController@store'));
        Route::get('investigationimaging/edit/{id}', array('as'=>'investigationimaging/edit','uses'=>'Backend\InvestigationImagingController@edit'));
        Route::post('investigationimaging/update', array('as'=>'investigationimaging/update','uses'=>'Backend\InvestigationImagingController@update'));
        Route::post('investigationimaging/destroy', array('as'=>'investigationimaging/destroy','uses'=>'Backend\InvestigationImagingController@destroy'));

    });

    Route::get('enquiry/autocompletepatient', array('as'=>'enquiry/autocompletepatient','uses'=>'Backend\SearchController@autoCompletePatient'));
    Route::get('schedule/autocompletepatient', array('as'=>'schedule/autocompletepatient','uses'=>'Backend\SearchController@autoCompletePatient'));

    // Ajax Routes
    Route::get('patient/profile/{id}', array('as'=>'patient/profile/{id}','uses'=>'Backend\PatientController@profile'));
    Route::get('packagesale/autofill/{id}', array('as'=>'packagesale/autofill','uses'=>'Backend\PackageSaleController@autofill'));
    Route::get('patient/checkzone/{id}', array('as'=>'patient/destroy','uses'=>'Backend\PatientController@checkZone'));
    Route::get('packagesale/checkcouponcode/{package}/{code}', array('as'=>'packagesale/checkcouponcode','uses'=>'Backend\PackageSaleController@checkCouponCode'));
    Route::get('packagesale/getoriginalprice/{package}', array('as'=>'packagesale/getoriginalprice','uses'=>'Backend\PackageSaleController@getOriginalPrice'));

});

Route::group(['prefix' => 'api'], function () {
    Route::post('syncs/down', array('as'=>'syncs/down','uses'=>'Api\SyncsController@down'));

    Route::post('patient/down',array('as'=>'patient/down','uses'=>'Api\PatientApiController@down'));
    Route::post('package_sale/down',array('as'=>'package/down', 'uses'=>'Api\PackageApiController@down'));

    Route::post('patient/upload',array('as'=>'patient/upload','uses'=>'Api\PatientApiController@upload'));
    Route::post('package_sale/upload',array('as'=>'package/upload','uses'=>'Api\PackageApiController@upload'));

    Route::post('enquiry/down', array('as'=>'enquiry/down','uses'=>'Api\EnquiryApiController@down'));
    Route::post('schedule/down', array('as'=>'schedule/down','uses'=>'Api\ScheduleApiController@down'));

    Route::post('enquiry/upload', array('as'=>'enquiry/upload','uses'=>'Api\EnquiryApiController@upload'));
    Route::post('product/upload', array('as'=>'product/upload','uses'=>'Api\ProductApiController@upload'));

    Route::post('schedule/upload', array('as'=>'schedule/upload','uses'=>'Api\ScheduleApiController@upload'));
    Route::post('schedule/upload/v2', array('as'=>'schedule/upload/v2','uses'=>'Api\ScheduleApiController@upload'));
    Route::post('familyhistory/upload', array('as'=>'familyhistory/upload','uses'=>'Api\FamilyhistoryApiController@upload'));
    Route::post('medicalhistory/upload', array('as'=>'medicalhistory/upload','uses'=>'Api\MedicalhistoryApiController@upload'));
    Route::post('invoice/upload', array('as'=>'invoice/upload','uses'=>'Api\InvoiceApiController@upload'));
    Route::post('familymember/upload', array('as'=>'familymember/upload','uses'=>'Api\FamilymemberApiController@upload'));

    //schedule_treatment_history upload api
    Route::post('scheduletreatmenthistory/upload', array('as'=>'scheduletreatmenthistory/upload','uses'=>'Api\ScheduletreatmenthistoryApiController@upload'));

    //schedule_tracking upload api
    Route::post('scheduletracking/upload', array('as'=>'scheduletracking/upload','uses'=>'Api\ScheduletrackingApiController@upload'));

    //way_tracking upload api
    Route::post('waytracking/upload', array('as'=>'waytracking/upload','uses'=>'Api\WaytrackingApiController@upload'));

    //invoice upload api V2
    Route::post('invoice/upload/v2', array('as'=>'invoice/upload/v2','uses'=>'Api\InvoiceApiV2Controller@upload'));
    //patient_medical_history api
    Route::post('patient_medical_history/upload', array('as'=>'patient_medical_history/upload','uses'=>'Api\PatientApiV2Controller@uploadPatientMedicalHistory'));
    //patient_surgery_history api
    Route::post('patient_surgery_history/upload', array('as'=>'patient_surgery_history/upload','uses'=>'Api\PatientApiV2Controller@uploadPatientSurgeryHistory'));
    //patient_family_history api
    Route::post('patient_family_history/upload', array('as'=>'patient_family_history/upload','uses'=>'Api\PatientApiV2Controller@uploadPatientFamilyHistory'));

    //medical_history api V2
    Route::post('medical_history/upload/v2', array('as'=>'medical_history/upload/v2','uses'=>'Api\MedicalhistoryApiV2Controller@uploadPatientMedicalHistory'));
    //family_histories api V2
    Route::post('family_histories/upload/v2', array('as'=>'family_histories/upload/v2','uses'=>'Api\FamilyhistoryApiV2Controller@uploadFamilyHistories'));

    //enquiry api version 2
    Route::post('enquiry/upload/v2', array('as'=>'enquiry/upload/v2','uses'=>'Api\EnquiryApiV2Controller@upload'));
    Route::post('enquiry/uploadEnquiry/v2', array('as'=>'enquiry/uploadEnquiry/v2','uses'=>'Api\EnquiryApiV2Controller@uploadEnquiry'));

    //schedule api version 2
    Route::post('schedule/upload/v2', array('as'=>'schedule/upload/v2','uses'=>'Api\ScheduleApiV2Controller@uploadSchedule'));
    Route::post('schedulepatientvital/upload/v2', array('as'=>'schedule/upload/v2','uses'=>'Api\ScheduleApiV2Controller@uploadSchedulePatientVitals'));
    Route::post('schedulepatientchiefcomplaint/upload/v2', array('as'=>'schedulepatientchiefcomplaint/upload/v2','uses'=>'Api\ScheduleApiV2Controller@uploadSchedulePatientChiefComplaint'));
    Route::post('scheduletreatmenthistory/upload/v2', array('as'=>'scheduletreatmenthistory/upload/v2','uses'=>'Api\ScheduleApiV2Controller@uploadScheduleTreatmentHistory'));
    Route::post('scheduleprovisionaldiagnosis/upload/v2', array('as'=>'scheduleprovisionaldiagnosis/upload/v2','uses'=>'Api\ScheduleApiV2Controller@uploadScheduleProvisionalDiagnosis'));
    Route::post('schedule_physiotherapy_musculo/upload/v2', array('as'=>'schedule_physiotherapy_musculo/upload/v2','uses'=>'Api\ScheduleApiV2Controller@uploadSchedulePhysiotherapyMusculo'));
    Route::post('schedule_trackings/upload/v2', array('as'=>'schedule_trackings/upload/v2','uses'=>'Api\ScheduleApiV2Controller@uploadScheduleTracking'));
    Route::post('schedulephysicalexamsgeneralpupilshead/upload/v2', array('as'=>'schedulephysicalexamsgeneralpupilshead/upload/v2','uses'=>'Api\ScheduleApiV2Controller@uploadschedulePhysicalExamsGeneralPupilsHead'));
    Route::post('schedulephysicalexamsheartlungs/upload/v2', array('as'=>'schedulephysicalexamsheartlungs/upload/v2','uses'=>'Api\ScheduleApiV2Controller@uploadSchedulePhysicalExamsHeartLungs'));
    Route::post('schedulephysicalexamsabdomenextreneuro/upload/v2', array('as'=>'schedulephysicalexamsabdomenextreneuro/upload/v2','uses'=>'Api\ScheduleApiV2Controller@uploadSchedulePhysicalExamsAbdomenExtreNeuro'));

    //schedule api version 3...//schedule api group
    Route::post('schedule/upload/v3', array('as'=>'schedule/upload/v3','uses'=>'Api\ScheduleApiV3Controller@uploadScheduleGroup'));

    //schedule status update api ...//only for schedule status
    Route::post('schedule/upload/status', array('as'=>'schedule/upload/status','uses'=>'Api\ScheduleApiV3Controller@uploadScheduleStatus'));

    //enquiry status update api ...//only for enquiry status
    Route::post('enquiry/upload/status', array('as'=>'enquiry/upload/status','uses'=>'Api\EnquiryApiV2Controller@uploadEnquiryStatus'));

    //patient_physiotherapy_musculo
    Route::post('patient_physiothreapy_musculo/upload', array('as'=>'patient_physiothreapy_musculo/upload','uses'=>'Api\PatientApiV2Controller@uploadPatientPhysiothreapyMusculo'));

    //patient api(patient and core_user come in the same level)//(for whole enquiry api case)
    Route::post('patient/uploadsinglepatient/',array('as'=>'patient/uploadsinglepatient','uses'=>'Api\PatientApiController@uploadSinglePatient'));

    //user api(patient and core_user come in the same level)//(for whole enquiry api case)
    Route::post('user/uploadsingleuser/',array('as'=>'patient/uploadsingleuser','uses'=>'Api\UserApiController@uploadSingleUser'));

    //Upload API for Physiotherapy_Musculo
    Route::post('service/physio_musculo/upload',array('as'=>'service/physio_musculo/upload','uses'=>'Api\ServiceApiController@uploadPhysiotherapyMusculo'));

    //patient_physiotherapy_neuro
    Route::post('patient_physiothreapy_neuro/upload', array('as'=>'patient_physiothreapy_neuro/upload','uses'=>'Api\PatientApiV2Controller@uploadPatientPhysiothreapyNeuro'));

    //products api v2
    Route::post('products/upload/v2', array('as'=>'products/upload/v2','uses'=>'Api\ProductApiV2Controller@uploadProducts'));

    //invoice upload api V3
    Route::post('invoice/upload/v3', array('as'=>'invoice/upload/v3','uses'=>'Api\InvoiceApiV3Controller@upload'));
    //patient_package upload api
    Route::post('patient_package/upload', array('as'=>'patient_package/upload','uses'=>'Api\PatientPackageApiController@upload'));

    //tablet_issues upload api
    Route::post('tablet_issues/upload', array('as'=>'tablet_issues/upload','uses'=>'Api\TabletIssuesApiController@upload'));

    //transaction_promotions upload api
    Route::post('transaction_promotions/upload', array('as'=>'transaction_promotions/upload','uses'=>'Api\TransactionpromotionApiController@upload'));

    //company information download api
    Route::post('download/company_information', array('as'=>'download/company_information','uses'=>'Api\CompanyInformationApiController@download'));
});
