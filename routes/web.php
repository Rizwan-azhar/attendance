<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
      DB::table('attendances')->where('id',$id)->insert([
        'user_id' =>$id,
        'present' => 1,
        'qr_code' => "as",
      ]);
      return redirect()->back()->with('success','Successfully Deleted');
  });

    Route::get('delete_user/{id}',function($id){

      DB::Table('users')->where('id',$id)->delete();
      return redirect()->back()->with('success','Successfully Deleted');
  });

});
