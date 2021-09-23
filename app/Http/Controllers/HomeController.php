<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use auth;
use DB;
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
        $user->save();
        return redirect('/home')->with('message' ,'New employee added.');
    }


}
