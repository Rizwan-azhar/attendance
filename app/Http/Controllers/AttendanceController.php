<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Symfony\Component\Console\Input\Input;
use DB;
use Carbon\Carbon;
use PDF;
use App\Exports\AttendanceExport;

use Maatwebsite\Excel\Facades\Excel;
class AttendanceController extends Controller
{

    public function export($id)
    {
    
        return Excel::download(new AttendanceExport($id), 'attendance.xlsx');
    }
    public function generatePDF($id)
    {
     
        $data = ['title' => 'Attendance Detail', 'id'=>$id];
        $pdf = PDF::loadView('attendancepdf', $data);
        
        

        return $pdf->download('attendance.pdf');
    }
    public function verify_qr(){
      $code = request()->query('code');

        $match =  DB::table('users')->where('qr_code' , $code)->first();

      if($match == null || !isset($match)){
         return 0;
      }
      else{

           return response()->json([
                        'order' => $match
                    ]);

        }
    }
    public function submitattendance(Request $request){

        $user_id=User::where('qr_code',$request->qr_code)->pluck('id')->first();
        $timenow = Carbon::now()->addHours(5)->toDateTimeString();
        $currentmonth = Carbon::now()->addHours(5)->format('F');
        $currentyear = Carbon::now()->addHours(5)->format('Y');
        $startTime = Carbon::createFromFormat('H:i a', '09:30 AM');
        $endTime = Carbon::createFromFormat('H:i a', '10:30 AM');

        $checkoutstartTime = Carbon::createFromFormat('H:i a', '06:30 PM');
        $checkoutendTime = Carbon::createFromFormat('H:i a', '07:30 PM');
        $currentTime = \Carbon\Carbon::now()->addHours(5);

        if($currentTime->between($startTime, $endTime, true)){
          $Attendance = new Attendance;
          $Attendance->user_id = $user_id;
          $Attendance->check_in = $timenow;
          $Attendance->check_out = null;
          $Attendance->qr_code = $request->qr_code;
          $Attendance->present = 1;
          $Attendance->month = $currentmonth;
          $Attendance->year = $currentyear;
          $Attendance->save();
        }
          elseif($currentTime->between($checkoutstartTime, $checkoutendTime, true)){
              $id = Attendance::where('qr_code',$request->qr_code)->pluck('id')->first();

              $Attendance = Attendance::where('id',$id)->update([
              'check_out'=>$timenow,

              ]);

            }
            else{
          $Attendance = new Attendance;
          $Attendance->user_id = $user_id;
          $Attendance->check_in = $timenow;
          $Attendance->check_out = null;
          $Attendance->qr_code = $request->qr_code;
          $Attendance->present = 1;
          $Attendance->month = $currentmonth;
          $Attendance->year = $currentyear;
          $Attendance->save();
        }




        return redirect()->back();
}

public function attendanceview($id)
{
  $attendance= Attendance::where('user_id', $id)->get();
  $getMonth = [];
  foreach (range(1, 12) as $m) {
      $getMonth[] = date('F', mktime(0, 0, 0, $m, 1));
  }

 $monthss =  Attendance::where('user_id', $id)->whereMonth('check_in', date('m'))->whereYear('check_in', date('Y'))->get();
 
            return view('attendance', compact('attendance','id', 'getMonth', 'monthss'));
}


public function manual()
{
  $users= DB::table('users')->where('is_admin', "!=", 1)->where('is_admin', "!=", 2)->get(); 
  return view('manual', compact('users'));
}

public function check_month()
{
    $month=request()->query('month');
    $id=request()->query('id');

    $get_month_record=Attendance::where('user_id',$id)->where('month',$month)->get();
    return $get_month_record;
}






}
