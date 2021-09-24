<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use auth;
use DB;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

use Symfony\Component\Console\Input\Input;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function verification($id){
       
        
        $check = DB::table('users')->where('code',$id)->pluck('code')->first();
       
        if($check == null){
             return redirect('/')->with('message', 'Verification link is expired');
        }
       
        if($check == $id)
        {
           
            DB::table('users')->where('code', $id)->update([
                'status' => 1,
                'code' => null
                ]);
                return redirect('/home')->with('mailverified','Verification link verified');
        }
        else{
          return redirect('/')->with('message','Verification link not verified');
        }
         
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
   
        
             if(auth()->user()->status == 1){
        $user=User::get()->where('is_admin', '!=',1)->where('is_admin', '!=',2);

        return view('home',compact('user'));
             }
             else{
                 return view('checkmail');
             }
    }
  public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
    public function add_employee(Request $request)
    {
        $code= $this->quickRandom();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->number = $request->number;
        $user->qr_code = $code;
        $user->joining_date = $request->joining_date;
        $user->salary = $request->salary;
        $user->save();
        return redirect('/home')->with('message' ,'New employee added.');
    }

    public function progress()
    {
        
        $date=Carbon::now()->startOfMonth();

        $date=Carbon::parse($date)->format('Y-m-d');
        $now=Carbon::now();
        $now=Carbon::parse($now)->format('Y-m-d');
        $period = CarbonPeriod::create($date, $now);
       
       
        $dates = $period->toArray();
       
    return view('progress',compact('dates'));

}

public function post_progress(Request $request){

$date=Carbon::now()->parse()->format('Y-m-d');

$checkin = DB::table('attendances')->where('user_id', $request->user_id )->pluck('id')->last();



    DB::table('attendances')->where('user_id', $request->user_id)->where('id', $checkin )->update([
        'progress' =>$request->progress,
    ]);
    return redirect()->back();   
}

    public function view_progress($id)
    {
        $pro = DB::table('attendances')->where('user_id', $id)->get();
        

        return view('view_progress', compact('pro'));

    }

    public function view_salary()
    {
        
        $salary = DB::table('users')->get();

        return view('salary', compact('salary'));

    }

    public function update_salary(Request $request)
    {
        
        DB::table('users')->where('id', $request->id)->update([
            'salary'=>$request->salary,
        ]);
        return redirect()->back();
        
    }

    public function edit_salary($id){
        $sal = DB::table('users')->where('id' , $id)->first();
        return view('edit_salary' , compact('sal'));
    }

}
