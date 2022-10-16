<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Http\Controllers\UserController;

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
// 0788842584
// Route::get('/', function () {
//     return view('pages.login');
// });
Route::get('/',[UserController::class,'index']);
Route::get('/register',[UserController::class,'signup'])->name('register');
Route::post('registering',[UserController::class, 'customRegistration'])->name('registering');
Route::post('activate_user',[UserController::class, 'activateUser'])->name('activate_user');
Route::post('signin',[UserController::class, 'signin'])->name('signin');
Route::get('dashboard', [UserController::class, 'dashboard']);
Route::get('signout', [UserController::class, 'signOut'])->name('signout');
Route::get('login', [UserController::class, 'index'])->name('login');
Route::get('getusers',[UserController::class, 'getUsersAll'])->name('getusers');
Route::get('gettrainersandsuperv',[UserController::class, 'trainerSandSuperv'])->name('gettrainersandsuperv');
Route::get('adduser',[UserController::class, 'addNewUser']);
Route::post('create_user',[UserController::class, 'createUser'])->name('create_user');
Route::get('create_report',[UserController::class, 'addReport']);
Route::post('add_report',[UserController::class, 'saveReport'])->name('add_report');
Route::post('edit_report',[UserController::class, 'updateReport'])->name('edit_report');
Route::post('update_profile',[UserController::class, 'updateProfile'])->name('update_profile');
Route::post('register_user',[UserController::class, 'registerUSer'])->name('register_user');
Route::get('training_report',[UserController::class, 'trainingReport'])->name('training_report');

Route::get('training_report_filter',[UserController::class, 'trainingReportFilter'])->name('training_report_filter');

Route::get('my_reports',[UserController::class, 'myReports'])->name('my_reports');
Route::get('my_trainers',[UserController::class, 'myTrainers'])->name('my_trainers');
// Route::get('report_in_my_region',[UserController::class, 'reportInMyRegion']);

Route::post('get_sectors',[UserController::class, 'getSectors'])->name('get_sectors');

Route::get('get_last_user',[UserController::class, 'getLatestUsers'])->name('get_last_user');
Route::get('get_recent_report',[UserController::class, 'getRecentReport'])->name('get_recent_report');

Route::get('get_data_for_charts',[UserController::class,'getDataForCharts'])->name('get_data_for_charts');


Route::post('get_sites',[UserController::class, 'getSites']);

Route::get('my_profile',[UserController::class , 'myProfile'])->name('my_profile');
Route::get('all_sites',[UserController::class, 'allSites'])->name('all_sites');

Route::get('activate_email/{email}',[UserController::class, 'activateEmail']);
Route::get('showtrainee/{reportId}',[UserController::class,'showreport']);

Route::get('show_report_details/{reportId}',[UserController::class, 'showReportDetails']);
Route::get('change_status/{reportId}',[UserController::class, 'changeStatus']);
Route::get('put_comment/{reportId}',[UserController::class, 'putComment']);
Route::get('showAllocating/{userId}',[UserController::class, 'return_allocate']);
Route::post('allocate_user_in_place',[UserController::class , 'allocateUserInPlace'])->name('allocate_user_in_place');
Route::post('send_comment',[UserController::class, 'sendComment'])->name('send_comment');



