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
          $Attendance->present = 0;
          $Attendance->save();
        }




        return redirect()->back();
}

public function attendanceview($id)
{
  $attendance= Attendance::where('user_id', $id)->get();

  return view('attendance', compact('attendance','id'));
}

public function manual()
{
  $users= DB::table('users')->where('is_admin', "!=", 1)->get(); 
  return view('manual', compact('users'));
}






}
