<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
             
        $user=User::get()->where('is_admin', '!=',1);

        return view('home',compact('user'));
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
