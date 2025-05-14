<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\childinfo;
use App\Models\personalinfo;
use App\Models\wifeinfo;
use App\Models\preferred111;
use App\Models\workingdetails;
use App\Models\release111;
use App\Models\info11;
use App\Models\workingnow;
use App\Models\workingbefore;
use App\Models\devicedetails;
use App\Http\Controllers\ConverterController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginfo;
use App\Mail\recovery11;

use DB;
Use Alert;
use App\Rules\ReCaptcha;
use Carbon\Carbon;


class test extends Controller
{
    
    public function forget11(){
        return view('auth.forget11');
    }
    public function forget22(Request $request){
        $validated=$request->validate([
             
            'email' => 'required|email|exists:users,email',
 
        ]);
                   
        session(['email11'=>$validated['email']]);
        $randomNumber = rand(100000, 999999);
        session(['number' => $randomNumber ]);
            // Attempt to send the mail
            Mail::to($validated['email'])->send(new recovery11($randomNumber));
            if (!empty(Mail::failures())) {
                return view('auth.forget11');
            } else {
                $startTime = Carbon::now();
            session(['start_time' => $startTime ]);
            // Show success toastr notification
             toastr()->success('Successfully sent mail');
           $endTime =  Carbon::now()->addMinutes(5); // Add 5 minutes to start time
          
           // $diffInMinutes = $startTime->diffInMinutes($endTime, false);

           
        return view('auth.forget22', [
            'endTime' => $endTime->toISOString() // Pass ISO timestamp to view
        ]);}
        
        

    }
    
    public function forget33(Request $request){
        $startTime = session('start_time');

        $EndTime = Carbon::now();
        $diffInMinutes = $startTime->diffInSeconds($EndTime);
      
        if($diffInMinutes<5){
              if($request->otp==session('number')){
            return view('auth.forget33');
                                }
      }
      else if ($diffInMinutes>=60) {
       // toastr->warning("Error");
        return view('auth.forget11');
      }
      else {
        return view('auth.forget11');
      }

    }
    public function registration()
    {
       
      //  $draft1 = DB::table('codetable')
      //  ->select('*')->where('status','designation')
      //  ->get(); 
      //  $draft2 = DB::table('codetable')
      //  ->select('*')->where('status','district')
      //  ->get();       
               
      //  $draft3 = DB::table('codetable')
      //  ->select('*')->where('status','office')
      //  ->get(); 
  //  return view('auth.registration', compact('draft1','draft2','draft3'));
  return view('auth.registration');            
   
}
public function forget44(Request $request){
          
           $validated=$request->validate([
            'password' => 'required|string|min:12|max:128|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',

           ]);
    
         $pwd11=Hash::make($validated['password']);
          DB::table('users')
        ->where('email','=',session('email11'))
        
        ->update(['password' => $pwd11]);
        info11::create([
            'name'=>Auth::user()->name,
            'email'=>Auth::user()->email,
            'userid'=>Auth::user()->userid,
            'type'=>'User',
            'action'=>'Password Change',
            'status'=>'ok'
        ]);
     return view('auth.login');
          
}
     
     public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
           // 'g-recaptcha-response' => 'required'

        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) { 
             

            // $device = Agent::device();
            $browser = \Agent::browser();
            $browser_version =\Agent::version($browser);
            //$browser=$browser."(".$version.")";
            // $version = \Agent::version($browser);
                 $platform = \Agent::platform();
             $platform_version = \Agent::version($platform);
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
                  try {
                    // Attempt to send the mail
                   $fft= now()->format('Y-m-d H:i:s');
                    Mail::to(Auth::user()->email)->send(new loginfo($fft));
                    
                    // Show success toastr notification
                   // toastr()->success('Successfully sent mail');
               } catch (\Exception $e) {
                    // Handle failure and show error toastr notification
                   // toastr()->error('Mail Sent Error: ' . $e->getMessage());
                }
                
                     //Device Location ip Browser 
                     DB::table('loginfo')->insert([
                      'name'=>Auth::user()->name,
                      'mobile' => Auth::user()->mobile,
                      'mail'=>Auth::user()->email,
                        
                      'Device'=>$platform,
                      'Browser'=>$browser,
                      'ip'=>$ip,
                      'Location'=>session('user_data_city'),
                      
                       
                  ]);
                     



            if(Auth::user()->role=='userdr')  {toastr('Successfully Logged in'); return redirect("newdash");}
        
            else if(Auth::user()->role=='usersr'){ 
                
               // $details=devicedetails:
                toastr('Successfully Logged in'); return redirect("section7"); 
                                                                     }
        else if(Auth::user()->role=='useradmin') { return redirect("admindash") ; }

        else if(Auth::user()->role=='user') { toastr('Successfully Logged in');return redirect("Newuser") ; }
        else if(Auth::user()->role=='userone') { toastr('Successfully Logged in');return redirect("NotaryDashboard") ; }
                                                                    }
  
          return redirect("login")->withError('Login details are not valid');
    }

    public function customRegistration(Request $request)
    {    
        $converter = new ConverterController();
 $request->merge([
        'mobile' => $converter->bn2en($request->mobile),
    ]);
       $validated=$request->validate([
            'name' => 'required|string|max:35',
           // 'district' => 'required|string|max:30',
          //  'designation' => 'required|string|max:100',
           // 'office' => 'required|string|max:100',

            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:12|max:128|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            //'serviceid'=>['required','string','size:10','regex:/^(199[0-9]|20[0-2][0-9]|2030)[0-9]{6}$/'],
            'mobile'=>'required|string|max:15'
        ]);
        
        
        
        
        // $ip=$request->ip();
 
         
         //$browser = \Agent::browser();
          
        
        
        // $dataloc = \Location::get($ip); 

        $data = $validated;
         

       

        $check = $this->create($data);
        Auth::login($check);
        $userid = session('userid');
        $browser = \Agent::browser();
        $browser_version =\Agent::version($browser);
         
             $platform = \Agent::platform();
         $platform_version = \Agent::version($platform);
        $ip = $request->ip();
        $data = Location::get($ip);

        if ($data) {
             
            
            $region11 = $data->regionName;
            
        } else {
            // Handle failure to retrieve location
            $region11 = 'Unknown Region';
        }
        devicedetails::create([
            'userid'=>$userid, 
        'ip'=>$ip, 
        'region'=>$region11, 
        'browser'=>$browser, 
        'browser_version'=>$browser_version, 
        'device'=>$platform,
        'device_version'=>$platform_version
        ]);
      
       
        $lastId = applicationinfo::max('id');
        $appid='App'.$lastId+100;             
         applicationinfo::create([
             'userid'=>Auth::user()->userid,
             'status'=>'Draft',
             'applicationid'=>$appid,

         ]);
     

        return redirect("jobinfo")->with('You have signed-in');
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
      $lastId = User::max('id');
      $userid='User'.$lastId+10000+2;
      session(['userid' => $userid]);
        return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
      //  'district' =>trim($data['district']),
       // 'designation'=>trim($data['designation']),
        'location'=>$currentUserInfo,
        'device'=>$platform,
        'mobile'=>$data['mobile'],
        'role'=>'userone',
        
        'avatar'=>'j1.png',
        // 'serviceid'=>$data['serviceid'],
        // 'doptor'=>trim($data['office']),
         'userid'=>$userid,
      ]);
    }    
   
}
