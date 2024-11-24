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
Use Alert;

class test extends Controller
{
    public function registration()
    {
       
        $draft1 = DB::table('codetable')
        ->select('*')->where('status','designation')
        ->get(); 
        $draft2 = DB::table('codetable')
        ->select('*')->where('status','district')
        ->get();       
               
      
    return view('auth.registration', compact('draft1','draft2'));
                
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
             

            // $device = Agent::device();
            $browser = \Agent::browser();
            $version =\Agent::version($browser);
            $browser=$browser."(".$version.")";
            // $version = \Agent::version($browser);
                 $platform = \Agent::platform();
            // $version2 = Agent::version($platform);
            $ip = $request->ip();
$data = Location::get($ip);

            if ($data) {
                // Successfully retrieved location details
                session(['user_data_city' => $data->cityName]);
                session(['user_data_region' => $data->regionName]);
                session(['user_data_country' => $data->countryName]);
            } else {
                // Handle failure to retrieve location
                session(['user_data_city' => 'Unknown Region']);
            }
                  //countryName  regionName  cityName
                  //try {
                    // Attempt to send the mail
                    Mail::to(Auth::user()->email)->send(new loginfo());
                    
                    // Show success toastr notification
                   // toastr()->success('Successfully sent mail');
               // } catch (\Exception $e) {
                    // Handle failure and show error toastr notification
                   // toastr()->error('Mail Sent Error: ' . $e->getMessage());
               // }
                
                     //Device Location ip Browser 
                     DB::table('loginfo')->insert([
                      'district' => Auth::user()->District,
                      'mobile' => Auth::user()->mobile,
                      'mail'=>Auth::user()->email,
                       'time'=>date("Y-m-d H:i:s", strtotime('now')),
                      'Device'=>$platform,
                      'Browser'=>$browser,
                      'ip'=>$ip,
                      'Location'=>"jjj" ,
                      
                       
                  ]);
                     



            if(Auth::user()->role=='userdr')  {toastr('Successfully Logged in'); return redirect("dash2");}
        
            else if(Auth::user()->role=='usersr'){ toastr('Successfully Logged in'); return redirect("section7"); 
                                                                     }
        else if(Auth::user()->role=='useradmin') { return redirect("admindash") ; }

        else if(Auth::user()->role=='user') { toastr('Successfully Logged in');return redirect("Newuser") ; }
        else if(Auth::user()->role=='userone') { toastr('Successfully Logged in');return redirect("userone11") ; }
                                                                    }
  
          return redirect("login")->withError('Login details are not valid');
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

        return redirect("Newuser")->with('You have signed-in');
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
         
  
      ]);
    }    
   
}
