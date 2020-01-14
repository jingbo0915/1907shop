<?php

namespace App\Http\Controllers\login;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
        public function dologin(Request $request){
            $post = $request->except('_token');
           // dd($post);
            $user = DB::table('admin')->where($post)->first();
           // dd($user);
            if($user){
                session(['admin'=>$user]);
                request()->session()->save();
                return redirect('/goods');
            }
            return redirect('login')->with('msg','没有此用户，请联系管理员');

        }


        public function logout(){
            session(['admin'=>null]);
            request()->session()->save();
            return redirect('/login');

        }

}
