<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\childinfo;
use App\Models\personalinfo;
use App\Models\wifeinfo;
use App\Models\preferred111;
use App\Models\workingdetails;
use App\Models\release111;
use App\Models\workingnow;
use App\Models\workingbefore;
use App\Models\devicedetails;

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
       
        $draft1 = DB::table('codetable')
        ->select('*')->where('status','designation')
        ->get(); 
        $draft2 = DB::table('codetable')
        ->select('*')->where('status','district')
        ->get();       
               
        $draft3 = DB::table('codetable')
        ->select('*')->where('status','economy')
        ->get(); 
    return view('auth.registration', compact('draft1','draft2','draft3'));
                
    }
public function forget44(Request $request){
          
           $validated=$request->validate([
            'password' => 'required|string|min:12|max:128|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',

           ]);
    
         $pwd11=Hash::make($validated['password']);
          DB::table('users')
        ->where('email','=',session('email11'))
        
        ->update(['password' => $pwd11]);
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
                      'district' => Auth::user()->district,
                      'mobile' => Auth::user()->mobile,
                      'mail'=>Auth::user()->email,
                       'time'=>date("Y-m-d H:i:s", strtotime('now')),
                      'Device'=>$platform,
                      'Browser'=>$browser,
                      'ip'=>$ip,
                      'Location'=>session('user_data_city'),
                      
                       
                  ]);
                     



            if(Auth::user()->role=='userdr')  {toastr('Successfully Logged in'); return redirect("dash2");}
        
            else if(Auth::user()->role=='usersr'){ 
                
               // $details=devicedetails:
                toastr('Successfully Logged in'); return redirect("section7"); 
                                                                     }
        else if(Auth::user()->role=='useradmin') { return redirect("admindash") ; }

        else if(Auth::user()->role=='user') { toastr('Successfully Logged in');return redirect("Newuser") ; }
        else if(Auth::user()->role=='userone') { toastr('Successfully Logged in');return redirect("profile") ; }
                                                                    }
  
          return redirect("login")->withError('Login details are not valid');
    }

    public function customRegistration(Request $request)
    {  
       $validated=$request->validate([
            'name' => 'required|string|max:30',
            'district' => 'required|string|max:30',
            'designation' => 'required|string|max:100',
            'office' => 'required|string|max:100',

            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:12|max:128|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'serviceid'=>'required|string|max:20',
            'mobile'=>'required|string|max:20'
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
      
      childinfo::create([
       'userid' => $userid,
       'name'=>'gg', 
        'age'=>'gg', 
        'educationtype'=>'gg', 
        'educationlocation'=>'gg', 
        'educationname'=>'gg',
      ]);
      wifeinfo::create([
        'userid' => $userid,
        'wifename'=>'kk', 
        'profession'=>'kk', 
        'designation'=>'kk', 
        'wifeworkplace'=>'kk', 
        'wifehomedistrict'=>'kk', 
        'kids_number'=>'kk'
       ]);
       workingnow::create([
        'userid' => $userid,
        'district'=>Auth::user()->district,
        'designation'=>Auth::user()->designation,
        'mobile'=>Auth::user()->mobile,
        'status'=>'kk',
        'situation'=>'present',
        'start'=>'2022-02-02',
         
        'status2'=>'closed',
        'GO_Date'=>'2022-02-02',
        'sarok'=>'2022-02-02',
        'office'=>Auth::user()->doptor
       ]);
       personalinfo::create([
        'userid' => $userid,
         
        'mobile'=>Auth::user()->mobile,
        'name'=>Auth::user()->name ,
        'marital_status'=>'kk',
        'join'=>'2022-02-02',
        'retired'=>'2022-02-02',
        'email'=>Auth::user()->email,
        'serviceid'=>Auth::user()->serviceid,
        'gradation'=>22,
        'home_district'=>'kk',
        'dob'=>'1990-01-01'
       ]);

       preferred111::create([
        'userid' => $userid,
        'district'=>'kk', 
        'reason'=>'kk'
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
        'district' =>trim($data['district']),
        'designation'=>trim($data['designation']),
        'location'=>$currentUserInfo,
        'device'=>$platform,
        'mobile'=>$data['mobile'],
        'role'=>'userone',
        
        'avatar'=>'kk',
         'serviceid'=>$data['serviceid'],
         'doptor'=>trim($data['office']),
         'userid'=>$userid,
      ]);
    }    
   
}
