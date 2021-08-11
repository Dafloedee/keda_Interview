<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Customers;
use Illuminate\Support\Facades\DB;
class UsersController extends Controller
{
    public function getUser(){
        return Users::all();
    }

    public function Login(Request $request){
        
        if ($request->session()->has('email')) {
           echo 'You already login';
        } else{
            $email    = $request->input('email');
            $password  = $request->input('password');
            //echo  $email;
    
            $chckemail = DB::table('users')->get();
            $result = json_decode($chckemail, true);
    
            foreach ($result as $mail) {
                //echo $mail['email'];
                if ($email== $mail['email']) {
                    if (Hash::check($password, $mail['password'])){
                        echo 'SUCCESS!';
                        $request->session()->put('email',$email);
                        $request->session()->put('pass',$mail['password']);
                    }
                }
            }
        }
    }

    public function Logout(Request $request){
        
        if ($request->session()->has('email')) {
                $request->session()->forget('email');
                echo "LogOut";
        } else{
            echo "you are not logged in";
        }
    }

    public function Sendmessages(Request $request){
        if ($request->session()->has('email')) {
            
            $recipent   = $request->input('recipent');    
            $message    = $request->input('message');

            $recipentid = DB::table('users')->select('id')->where('email','=',$recipent)->get();
            foreach($recipentid as $recipt)
            {
                DB::insert('insert into messages (sender, reciever, messages) values (?, ?, ?)', [$request->session()->get('email'), $recipent, $message]);
            }

        } else{
        echo "you are not logged in";
            }
        }

}
