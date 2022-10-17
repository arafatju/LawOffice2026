<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginfo;
use DB;

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
            $ip=$request->ip();
            session(['ip' =>$ip]);

            // $device = Agent::device();
            $browser = \Agent::browser();
            // $version = \Agent::version($browser);
                 $platform = \Agent::platform();
            // $version2 = Agent::version($platform);
            $data = \Location::get(session('ip')); 
                   
                  //countryName  regionName  cityName
      
                     // Mail::to(Auth::user()->email)->send(new loginfo());
                     //Device Location ip Browser 
                     DB::table('loginfo')->insert([
                      'district' => Auth::user()->District,
                      'mobile' => Auth::user()->mobile,
                      'mail'=>Auth::user()->email,
                       'time'=>date("Y-m-d H:i:s", strtotime('now')),
                      'Device'=>$platform,
                      'Browser'=>$browser,
                      'ip'=>session('ip'),
                      'Location'=>"jjj" ,
                      
                       
                  ]);
                     



            if(Auth::user()->role=='userdr')  { return redirect("dashboard");}
        
            else if(Auth::user()->role=='usersr'){  return redirect("section7");}  
        }
        else if(Auth::user()->role=='useradmin') { return redirec("admindash") ; }

        else if(Auth::user()->role=='user') { return redirec("Newuser") ; }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',

        ]);
        
        
        
        
        // $ip=$request->ip();
 
         
         //$browser = \Agent::browser();
          
        
        
        // $dataloc = \Location::get($ip); 

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
      $platform = \Agent::platform();
      
        return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'District' =>$data['district'],
        'Designation'=>$data['designation'],
        'Location'=>$currentUserInfo,
        'Device'=>$platform,
        'mobile'=>$data['mobile'],
        'role'=>'user',
        'email_verified_at'=>now(),
        'avatar'=>'kk',
        'id'=>'nnn',
  
      ]);
    }    
   
}
