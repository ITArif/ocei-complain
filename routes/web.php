<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
use App\Http\Controllers\Frontend\ComplainController;
use App\Http\Controllers\Backend\ComplainReportController;
// Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/complainer-login', 'Auth\AdminLoginController@showLoginForm')->name('complainer.login');
Route::post('/complainer_login_check', 'Auth\AdminLoginController@complainer_login_check')->name('complainer.login_check');
Route::post('/complainer_logout', 'Auth\AdminLoginController@logout')->name('complainer.logout');

Route::middleware('admin')->group(function(){
	Route::get('/dashboard', 'Backend\HomeController@dashboard')->name('dashboard');
	////*************all complainer************
    Route::get('/all-complain','Backend\ComplainController@allComplain')->name('all-complain');
    ///***********View complain (Admin)****************////
    Route::get('/view-complain/{id}','Backend\ComplainController@viewComplain')->name('view-complain');
    Route::post('/update-complain/{id}','Backend\ComplainController@updateComplain')->name('update-complain');
    ///**************Archieved complain*****************************************////
    Route::get('/all-archieved-complain','Backend\ComplainController@allArchievedComplain')->name('all-archieved');
    ///***********View complain (Employee)****************************************////
    Route::get('/all-forward-complain','Backend\EmployeeController@forwardingComplain')->name('forward-complain');
    Route::get('/employee-view-complain/{id}','Backend\EmployeeController@employeeViewComplain')->name('employee-view-complain');
    Route::post('/employee-update-complain/{id}','Backend\EmployeeController@employeeUpdateComplain')->name('employee-update-complain');
    ////*************Forward complain*****************////
    Route::post('/forward-complain/{id}','Backend\ComplainController@forwardComplain')->name('forwardComplain');

    /////*************Archieved complain///////////
    Route::post('/archieved/complain','Backend\ComplainController@archievedComplain')->name('archievedComplain');
    /////**************Report*************/////////
    Route::match(['get','post'],'/complain-report',[ComplainReportController::class, 'allReports'])->name('complain.report');
    Route::get('/generate-complain-pdf/{complain_id}', [ComplainReportController::class, 'generateComplainPdf'])->name('admin.generateComplainPdf');
});


///***************Complain*******************
Route::get('/', 'Frontend\ComplainController@showComplainForm')->name('complain-form');
Route::post('/complain-form','Frontend\ComplainController@storeComplain')->name('store.complain');
Route::get('/about-occi','Frontend\ComplainController@aboutOcci')->name('aboutOcci');

// send OTP to complainer
Route::get('/complain-otp-form', 'Frontend\ComplainController@showComplainOtpForm')->name('showComplainOtpForm');
Route::post('/otp-verifcation','Frontend\ComplainController@otpVerificationComplain')->name('otpVerificationComplain');


////***************Complain Tracking******************************/////
//Route::post('/track-complain','Frontend\ComplainController@trackComplain')->name('track.complain');
Route::match(['get','post'],'track-complain',[ComplainController::class,'trackComplain'])->name('track.complain');

