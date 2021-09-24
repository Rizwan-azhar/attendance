<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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



Route::get('/', function () {

    return redirect('login');
});

Route::get('confirmemail/{id}','App\Http\Controllers\HomeController@verification')->name('confirmemail');


Auth::routes(); 


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('varify_qr_code',[App\Http\Controllers\AttendanceController::class, 'verify_qr'])->name('varify_qr_code');
Route::post('submitattendance',[App\Http\Controllers\AttendanceController::class, 'submitattendance'])->name('submitattendance');

Route::middleware('auth')->group(function (){
    Route::get('export/{id}', [App\Http\Controllers\AttendanceController::class, 'export']);
    Route::post('/add_employee', '\App\Http\Controllers\HomeController@add_employee');
    Route::get('/manual-attendance', '\App\Http\Controllers\AttendanceController@manual');

    Route::get('generate-pdf/{id}', [App\Http\Controllers\AttendanceController::class, 'generatePDF']);
    Route::get('attendancedetail/{id}',[App\Http\Controllers\AttendanceController::class, 'attendanceview'])->name('attendancedetail');
    Route::get('mark-attendance/{id}',function($id){
      $timenow = Carbon::now()->addHours(5)->toDateTimeString();
      $currentmonth = Carbon::now()->addHours(5)->format('F');
      $currentyear = Carbon::now()->addHours(5)->format('Y');
       
      
      DB::table('attendances')->where('id',$id)->insert([
        'user_id' =>$id,
        'present' => 1,
        'check_in'=>$timenow,
        'month' =>$currentmonth,
        'year'=>$currentyear,
       
        
      ]);
      return redirect()->back()->with('success','Successfully Marked');
  });

  Route::get('mark-attendance2/{id}',function($id){

      
   DB::table('attendances')->where('id',$id)->insert([
      'user_id' =>$id,
      'present' => 0,
      
    ]);
    return redirect()->back()->with('success','Successfully Marked');
});

    Route::get('delete_user/{id}',function($id){

      DB::Table('users')->where('id',$id)->delete();
      return redirect()->back()->with('success','Successfully Deleted');
  });

});

Route::get('progress','App\Http\Controllers\HomeController@progress');
Route::post('progress','App\Http\Controllers\HomeController@post_progress');
Route::get('view-progress/{id}','App\Http\Controllers\HomeController@view_progress');
Route::get('salary','App\Http\Controllers\HomeController@view_salary');
Route::post('edit_salary','App\Http\Controllers\HomeController@update_salary');
Route::get('update_salary/{id}','App\Http\Controllers\HomeController@edit_salary');
Route::get('check_month',[App\Http\Controllers\AttendanceController::class, 'check_month'])->name('check_month');


