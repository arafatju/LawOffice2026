<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class test extends Controller
{
    public function registration()
    {

        return view('auth.registration');
    }

     
     public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            //'g-recaptcha-response' => 'required|captcha'

        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->role=='userdr')  { return redirect("dashboard");}
        
            else if(Auth::user()->role=='usersr'){  return redirect("section7");}  
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',

         ]);
           
        $data = $request->all();
        $check = $this->create($data);
        Auth::login($check);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      $ip = \Request::getClientIp(true);
 
       $currentUserInfo = "dff";
      // $device = Agent::device();
      // $browser = Agent::browser();
      // $version = Agent::version($browser);
     //  $platform = Agent::platform();
      // $version2 = Agent::version($platform);
     $platform="ff";
      
        return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'District' =>$data['district'],
        'Designation'=>$data['designation'],
        'Location'=>$currentUserInfo,
        'Device'=>$platform,
        'mobile'=>$data['mobile'],
        'role'=>'usersr',
        'email_verified_at'=>now(),

      ]);
    }    
   
}
