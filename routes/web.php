<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/', 'HomeController@index')->name('home');

// Routes for emails and testing purpose ..
Route::get('my-test-mail', 'admincontroller@myTestMail');

// Basic login authenticate and logout options .....
/*
Route::get('/login', 'admincontroller@index')->name('login');
Route::get('/', 'admincontroller@index')->name('login');
Route::get('/studentlogin', 'admincontroller@studentLogin')->name('studentlogin');
*/
Route::get('/login', 'admincontroller@index')->name('login');
Route::get('/admin', 'admincontroller@index')->name('login');
Route::get('/studentlogin', 'admincontroller@studentLogin')->name('studentlogin');
Route::get('/', 'admincontroller@studentLogin')->name('studentlogin');

Route::get('/studentregister', 'admincontroller@studentReg')->name('studentregister');
Route::post('/studentregister', 'admincontroller@studentReg')->name('studentregister');

Route::post('/resetpassword', 'admincontroller@resetPassword')->name('resetpassword');

Route::get('/logout', 'admincontroller@logout')->name('logout');
Route::post('/logout', 'admincontroller@logout')->name('logout');
Route::post('/authenticate', 'admincontroller@authenticate')->name('authenticate');
Route::get('/home', 'admincontroller@showDashboard')->name('home');

Route::get('/studentboard', 'admincontroller@showStudentDashboard')->name('studentboard');
Route::get('/studentprofile', 'admincontroller@showStudentProfile')->name('studentprofile');

Route::get('/studentcourse', 'admincontroller@studentCourse')->name('studentcourse');
Route::post('/studentcourse', 'admincontroller@studentCourse')->name('studentcourse');

Route::get('/studentorders', 'admincontroller@showStudentOrders')->name('studentorders');

Route::get('/settings', 'admincontroller@doSettings')->name('settings');
Route::post('/settings', 'admincontroller@doSettings')->name('settings');

// Rutes for user management ...
Route::get('/usermgt', 'admincontroller@userList')->name('usermgt');
Route::get('/usermgt/{search_string}', 'admincontroller@userList')->name('usermgt');
Route::get('/usermgtdel/{userid}', 'admincontroller@userDelete')->name('usermgtdel');
Route::get('/userstatchange/{userid}/{status}', 'admincontroller@userStatusChange')->name('userstatchange');

Route::post('/usermgtadd', 'admincontroller@userUpdate')->name('usermgtadd');
Route::post('/updateprofile', 'admincontroller@updateProfile')->name('updateprofile');
Route::get('/usermgtadd', 'admincontroller@userUpdate')->name('usermgtadd');
Route::get('/useredit/{userid}', 'admincontroller@userUpdate')->name('useredit');

// Rutes for order management ...
Route::get('/ordermgt', 'admincontroller@orderList')->name('ordermgt');
Route::get('/ordermgt/{search_string}', 'admincontroller@orderList')->name('ordermgt');
Route::get('/ordermgtdel/{order_id}', 'admincontroller@orderDelete')->name('ordermgtdel');
Route::get('/orderstatchange/{order_id}/{status}', 'admincontroller@orderStatusChange')->name('orderstatchange');

Route::post('/ordermgtadd', 'admincontroller@orderUpdate')->name('ordermgtadd');
Route::get('/ordermgtadd', 'admincontroller@orderUpdate')->name('ordermgtadd');
Route::get('/orderedit/{order_id}', 'admincontroller@orderUpdate')->name('orderedit');

// Rutes for package management ...
Route::get('/packagemgt', 'admincontroller@packageList')->name('packagemgt');
Route::get('/packagemgt/{search_string}', 'admincontroller@packageList')->name('packagemgt');
Route::get('/packagemgtdel/{package_id}', 'admincontroller@packageDelete')->name('packagemgtdel');
Route::get('/packagestatchange/{package_id}/{status}', 'admincontroller@packageStatusChange')->name('packagestatchange');

Route::post('/packagemgtadd', 'admincontroller@packageUpdate')->name('packagemgtadd');
Route::get('/packagemgtadd', 'admincontroller@packageUpdate')->name('packagemgtadd');
Route::get('/packageedit/{package_id}', 'admincontroller@packageUpdate')->name('packageedit');

// Routes for role management ...
Route::get('/rolemgt', 'admincontroller@roleList')->name('rolemgt');
Route::get('/rolemgt/{search_string}', 'admincontroller@roleList')->name('rolemgt');
Route::get('/rolemgtdel/{roleid}', 'admincontroller@roleDelete')->name('rolemgtdel');

Route::post('/rolemgtadd', 'admincontroller@roleUpdate')->name('rolemgtadd');
Route::get('/rolemgtadd', 'admincontroller@roleUpdate')->name('rolemgtadd');
Route::get('/roleedit/{roleid}', 'admincontroller@roleUpdate')->name('roleedit');

Route::get('/assignperm/{roleid}', 'admincontroller@assignPermission')->name('assignperm');
Route::post('/assignperm/{roleid}', 'admincontroller@assignPermission')->name('assignperm');

// Routes for department management ..
Route::get('/departmentmgt', 'admincontroller@departmentList')->name('departmentmgt');
Route::get('/departmentmgt/{search_string}', 'admincontroller@departmentList')->name('departmentmgt');
Route::get('/departmentmgtdel/{departmentid}', 'admincontroller@departmentDelete')->name('departmentmgtdel');

Route::post('/departmentmgtadd', 'admincontroller@departmentUpdate')->name('departmentmgtadd');
Route::get('/departmentmgtadd', 'admincontroller@departmentUpdate')->name('departmentmgtadd');
Route::get('/departmentedit/{departmentid}', 'admincontroller@departmentUpdate')->name('departmentedit');

// Routes for country management
Route::get('/countrymgt', 'admincontroller@countryList')->name('countrymgt');
Route::get('/countrymgt/{search_string}', 'admincontroller@countryList')->name('countrymgt');
Route::get('/countrydel/{country_id}', 'admincontroller@countryDelete')->name('countrydel');

Route::post('/countryadd', 'admincontroller@countryUpdate')->name('countryadd');
Route::get('/countryadd', 'admincontroller@countryUpdate')->name('countryadd');
Route::get('/countryedit/{country_id}', 'admincontroller@countryUpdate')->name('countryedit');

// Routes for class management
Route::get('/classmgt', 'admincontroller@classList')->name('classmgt');
Route::get('/classmgt/{search_string}', 'admincontroller@classList')->name('classmgt');
Route::get('/classdel/{class_id}', 'admincontroller@classDelete')->name('classdel');
Route::get('/classupdatestatus/{class_id}/{status}', 'admincontroller@classStatusChange')->name('classupdatestatus');

Route::post('/classadd', 'admincontroller@classUpdate')->name('classadd');
Route::get('/classadd', 'admincontroller@classUpdate')->name('classadd');
Route::get('/classedit/{class_id}', 'admincontroller@classUpdate')->name('classedit');

// Routes for city management
Route::get('/citymgt', 'admincontroller@cityList')->name('citymgt');
Route::get('/citymgt/{search_string}', 'admincontroller@cityList')->name('citymgt');
Route::get('/citydel/{city_id}', 'admincontroller@cityDelete')->name('citydel');

Route::get('/cityselect/{country_id}', 'admincontroller@citySelectList')->name('cityselect');

Route::post('/cityadd', 'admincontroller@cityUpdate')->name('cityadd');
Route::get('/cityadd', 'admincontroller@cityUpdate')->name('cityadd');
Route::get('/cityedit/{city_id}', 'admincontroller@cityUpdate')->name('cityedit');

// Routes for course category management
Route::get('/categorymgt', 'admincontroller@categoryList')->name('categorymgt');
Route::get('/categorymgt/{search_string}', 'admincontroller@categoryList')->name('categorymgt');
Route::get('/categorydel/{category_id}', 'admincontroller@categoryDelete')->name('categorydel');

Route::post('/categoryadd', 'admincontroller@categoryUpdate')->name('categoryadd');
Route::get('/categoryadd', 'admincontroller@categoryUpdate')->name('categoryadd');
Route::get('/categoryedit/{category_id}', 'admincontroller@categoryUpdate')->name('categoryedit');

// Routes for course management
Route::get('/coursemgt', 'admincontroller@courseList')->name('coursemgt');
Route::get('/coursemgt/{search_string}', 'admincontroller@courseList')->name('coursemgt');
Route::get('/coursedel/{course_id}', 'admincontroller@courseDelete')->name('coursedel');

Route::post('/courseadd', 'admincontroller@courseUpdate')->name('courseadd');
Route::get('/courseadd', 'admincontroller@courseUpdate')->name('courseadd');
Route::get('/courseedit/{course_id}', 'admincontroller@courseUpdate')->name('courseedit');

// Routes for material management
Route::get('/materialmgt', 'admincontroller@materialmgt')->name('materialmgt');
Route::get('/materialmgt/{search_string}', 'admincontroller@materialmgt')->name('materialmgt');
Route::get('/materialdel/{material_det_id}', 'admincontroller@materialdel')->name('materialdel');

Route::post('/materialadd', 'admincontroller@materialadd')->name('materialadd');
Route::get('/materialadd', 'admincontroller@materialadd')->name('materialadd');
Route::get('/materialedit/{material_det_id}', 'admincontroller@materialadd')->name('materialedit');

Route::get('/material', 'admincontroller@materialStudents')->name('material');

// Routes for notification management ..
Route::get('/notificationmgt', 'admincontroller@notificationList')->name('notificationmgt');
Route::get('/notificationmgt/{search_string}', 'admincontroller@notificationList')->name('notificationmgt');
Route::get('/notificationdel/{notificationid}', 'admincontroller@notificationDelete')->name('notificationdel');

Route::post('/notificationadd', 'admincontroller@notificationUpdate')->name('notificationadd');
Route::get('/notificationadd', 'admincontroller@notificationUpdate')->name('notificationadd');
Route::get('/notificationedit/{notificationid}', 'admincontroller@notificationUpdate')->name('notificationedit');

// Rutes for badgement and its related operations ...
Route::get('/badgemgt', 'admincontroller@badgemgt')->name('badgemgt');
Route::get('/badgemgt/{search_string}', 'admincontroller@badgemgt')->name('badgemgt');
Route::get('/badgemgtdel/{badgeid}', 'admincontroller@badgemgtdel')->name('badgemgtdel');

Route::post('/badgemgtadd', 'admincontroller@badgemgtadd')->name('badgemgtadd');
Route::get('/badgemgtadd', 'admincontroller@badgemgtadd')->name('badgemgtadd');
Route::get('/badgemgtedit/{badgeid}', 'admincontroller@badgemgtadd')->name('badgemgtedit');

// Routes for survey ...

/* Operations for survey types */
Route::get('/surveytypelist', 'admincontroller@surveyTypeList')->name('surveytypelist');
Route::get('/surveytypelist/{search_string}', 'admincontroller@surveyTypeList')->name('surveytypelist');
Route::get('/surveytypelistdel/{surveytypeid}/{mode}', 'admincontroller@surveyTypeListDelete')->name('surveytypelistdel');

Route::get('/surveytypeadd', 'admincontroller@surveyTypeDataUpdate')->name('surveytypeadd');
Route::post('/surveytypeadd', 'admincontroller@surveyTypeDataUpdate')->name('surveytypeadd');

Route::get('/surveytypeedit/{surveytypeid}', 'admincontroller@surveyTypeDataUpdate')->name('surveytypeedit');

/* Operations for survey questions types */
Route::get('/surveyqstypelist', 'admincontroller@surveyQsTypeList')->name('surveyqstypelist');
Route::get('/surveyqstypelist/{search_string}', 'admincontroller@surveyQsTypeList')->name('surveyqstypelist');
Route::get('/surveyqstypelistdel/{surveyqstypeid}', 'admincontroller@surveyQsTypeListDelete')->name('surveyqstypelistdel');

Route::get('/surveyqstypeadd', 'admincontroller@surveyQsTypeDataUpdate')->name('surveyqstypeadd');
Route::post('/surveyqstypeadd', 'admincontroller@surveyQsTypeDataUpdate')->name('surveyqstypeadd');

Route::get('/surveyqstypeedit/{surveyqstypeid}', 'admincontroller@surveyQsTypeDataUpdate')->name('surveyqstypeedit');

/* Operations for survey questions */
Route::get('/surveyqslist', 'admincontroller@surveyQsList')->name('surveyqslist');
Route::get('/surveyqslist/{search_string}', 'admincontroller@surveyQsList')->name('surveyqslist');
Route::get('/surveyqslistdel/{surveyqsid}', 'admincontroller@surveyQsListDelete')->name('surveyqslistdel');

Route::get('/surveyqsadd', 'admincontroller@surveyQsDataUpdate')->name('surveyqsadd');
Route::post('/surveyqsadd', 'admincontroller@surveyQsDataUpdate')->name('surveyqsadd');

Route::get('/surveyqsansadd/{surveyqsid}', 'admincontroller@surveyQsAnswerUpdate')->name('surveyqsansadd');
Route::post('/surveyqsansadd/{surveyqsid}', 'admincontroller@surveyQsAnswerUpdate')->name('surveyqsansadd');

Route::get('/surveyqsansdel/{surveyqsansid}/{surveyqsid}', 'admincontroller@surveyQsAnsListDelete')->name('surveyqsansdel');

Route::get('/surveyqsedit/{surveyqsid}', 'admincontroller@surveyQsDataUpdate')->name('surveyqsedit');

/* Operations for survey answers */
Route::get('/surveyanslist', 'admincontroller@surveyTypeList')->name('surveyanslist');
Route::get('/surveyanslist/{search_string}', 'admincontroller@surveyTypeList')->name('surveyanslist');
Route::get('/surveyanslistdel/{surveyqstypeid}/{mode}', 'admincontroller@surveyTypeListDelete')->name('surveyanslistdel');

Route::get('/surveyansadd', 'admincontroller@surveyQsTypeDataUpdate')->name('surveyansadd');
Route::get('/surveyansadd/{surveyqstypeid}/{mode}', 'admincontroller@surveyQsTypeDataUpdate')->name('surveyansadd');

/* Operations for survey answers */
Route::get('/teammgt', 'admincontroller@teamList')->name('teammgt');
Route::get('/teammgt/{search_string}', 'admincontroller@teamList')->name('teammgt');
Route::get('/teammgtdel/{teamid}', 'admincontroller@teamListDelete')->name('teammgtdel');

Route::get('/teammgtadd', 'admincontroller@teamDataUpdate')->name('teammgtadd');
Route::post('/teammgtadd', 'admincontroller@teamDataUpdate')->name('teammgtadd');

Route::get('/teamedit/{teamid}', 'admincontroller@teamDataUpdate')->name('teamedit');

/* Operations for Job types and Job */
Route::get('/jobtypelist', 'jobcontroller@jobTypeList')->name('jobtypelist');
Route::get('/jobtypelist/{search_string}', 'jobcontroller@jobTypeList')->name('jobtypelist');
Route::get('/jobtypelistdel/{jobtypeid}', 'jobcontroller@jobTypeListDelete')->name('jobtypelistdel');

Route::get('/jobtypeadd', 'jobcontroller@jobTypeDataUpdate')->name('jobtypeadd');
Route::post('/jobtypeadd', 'jobcontroller@jobTypeDataUpdate')->name('jobtypeadd');

Route::get('/jobtypeedit/{jobtypeid}', 'jobcontroller@jobTypeDataUpdate')->name('jobtypeedit');

Route::get('/joblist', 'jobcontroller@jobList')->name('joblist');
Route::get('/joblist/{search_string}', 'jobcontroller@jobList')->name('joblist');
Route::get('/joblistdel/{jobid}', 'jobcontroller@jobDelete')->name('joblistdel');
Route::get('/jobdetails/{jobid}', 'jobcontroller@jobDetails')->name('jobdetails');

Route::get('/jobadd', 'jobcontroller@jobDataUpdate')->name('jobadd');
Route::post('/jobadd', 'jobcontroller@jobDataUpdate')->name('jobadd');

Route::get('/jobedit/{jobid}', 'jobcontroller@jobDataUpdate')->name('jobedit');

/* Location routes */
Route::get('/locationlist', 'admincontroller@locationList')->name('locationlist');
Route::get('/locationlist/{search_string}', 'admincontroller@locationList')->name('locationlist');
Route::get('/locationlistdel/{locationid}', 'admincontroller@locationListDelete')->name('locationlistdel');

Route::get('/locationadd', 'admincontroller@locationDataUpdate')->name('locationadd');
Route::post('/locationadd', 'admincontroller@locationDataUpdate')->name('locationadd');

Route::get('/locationedit/{locationid}', 'admincontroller@locationDataUpdate')->name('locationedit');

/* Question Management */

/* Speaking */
Route::get('/questionmgt/speaking', 'questioncontroller@show')->name('questionmgt');
Route::get('/questionmgt/questiondata', 'questioncontroller@questionData')->name('questiondata');
// Ra
Route::get('/questionmgt/speaking/ra', 'questioncontroller@newRa')->name('newRa');
Route::post('/questionmgt/speaking/ra', 'questioncontroller@newRa')->name('newRaPost');
Route::get('/questionmgt/speaking/ra_update', 'questioncontroller@raUpdate')->name('raUpdateEnter');
Route::post('/questionmgt/speaking/ra_update', 'questioncontroller@raUpdate')->name('raUpdatePost');
// Rs
Route::get('/questionmgt/speaking/rs', 'questioncontroller@newRs')->name('newRs');
Route::post('/questionmgt/speaking/rs', 'questioncontroller@newRs')->name('newRsPost');
Route::get('/questionmgt/speaking/rs_update', 'questioncontroller@rsUpdate')->name('rsUpdateEnter');
Route::post('/questionmgt/speaking/rs_update', 'questioncontroller@rsUpdate')->name('rsUpdatePost');

/* For all question deletion */
Route::post('/questionmgt/question_deletion', 'questioncontroller@questionDeletion')->name('raDeletion');
// Route::get('/questionmgt/audio/{songPath}', [
//     'as' => 'audio',
//     'uses' => 'questioncontroller@getSong'
// ]);
// test page
Route::get('/questionmgt/test', 'questioncontroller@test');

/*
Route::get('/home', function () {
    return view('home');
});
*/
// test page
Route::get('/questionmgt/test', 'questioncontroller@test');

/*
Route::get('/home', function () {
    return view('home');
});
*/

/*Route::get('/usermgt', function () {
    return view('usermgt');
});*/

/* Homepage Routes */
Route::get('/bookshelf', 'homepagecontroller@bookshelf');

/* Student Practices Routes */
Route::get('/practise', [
    'middleware' => 'SetSideBar',
    'uses' => 'PractiseController@index'
]);

Route::get('/practise/{category}', [
    'middleware' => 'SetSideBar',
    'uses' => 'PractiseController@index'
]);

Route::get('/practise/{category}/{subclass}',[
    'middleware' => 'SetSideBar',
    'uses' => 'PractiseController@redirectToList'
]);

Route::get('/practise/{category}/{subclass}/{questionID}',[
    'middleware' => 'SetSideBar',
    'uses' => 'PractiseController@redirectToQuestion'
]);

Route::get('/adminsettings', function () {
    return view('admisettings');
});

Route::get('/surveymgt', function () {
    return view('surveymgt');
});

Route::get('/jobmgt', function () {
    return view('jobmgt');
});

Route::get('/paymentmgt', function () {
    return view('paymentmgt');
});

Route::get('/cmsmgt', function () {
    return view('cmsmgt');
});

/*Route::get('/badgemgt', function () {
    return view('badgemgt');
});*/
