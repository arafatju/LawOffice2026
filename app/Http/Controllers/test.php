<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PersonalInfo;
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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class test extends Controller
{
    public function forget11()
    {
        return view('auth.forget11');
    }

    public function forget22(Request $request)
    {
        // ✅ Rate limiting - 1 request per minute per IP
        $key = 'forget-password:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 1)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors(['email' => "Too many attempts. Please try again in {$seconds} seconds."]);
        }
        
        RateLimiter::hit($key, 60);
        
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
                   
        session(['email11' => $validated['email']]);
        $randomNumber = rand(100000, 999999);
        session(['number' => $randomNumber]);
        session(['otp_attempts' => 0]); // ✅ Track OTP attempts
        
        try {
            // ✅ Queue email instead of sending immediately
            Mail::to($validated['email'])->queue(new recovery11($randomNumber));

            $startTime = Carbon::now();
            session(['start_time' => $startTime]);
            
            toastr()->success('Recovery email has been sent');
            $endTime = Carbon::now()->addMinutes(5);
          
            return view('auth.forget22', [
                'endTime' => $endTime->toISOString()
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Failed to queue recovery email: ' . $e->getMessage());
            toastr()->error('Failed to send recovery email. Please try again later.');
            return back();
        }
    }
    
    public function forget33(Request $request)
    {
        // ✅ Rate limiting on OTP verification
        $otpKey = 'otp-verify:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($otpKey, 5)) {
            $seconds = RateLimiter::availableIn($otpKey);
            session()->forget(['number', 'email11', 'start_time', 'otp_attempts']);
            return redirect()->route('forget11')
                ->withErrors(['otp' => "Too many failed attempts. Please request a new OTP."]);
        }

        $startTime = session('start_time');
        
        if (!$startTime) {
            return redirect()->route('forget11')
                ->withErrors(['error' => 'Session expired. Please start again.']);
        }

        $endTime = Carbon::now();
        $diffInSeconds = $startTime->diffInSeconds($endTime);
      
        // ✅ Check if OTP is expired (5 minutes = 300 seconds)
        if ($diffInSeconds >= 300) {
            session()->forget(['number', 'email11', 'start_time', 'otp_attempts']);
            toastr()->warning('OTP expired. Please request a new one.');
            return redirect()->route('forget11');
        }

        // ✅ Validate OTP input
        $request->validate([
            'otp' => 'required|numeric|digits:6'
        ]);

        // ✅ Check OTP match
        if ($request->otp == session('number')) {
            RateLimiter::clear($otpKey);
            return view('auth.forget33');
        }

        // ✅ Increment failed attempts
        RateLimiter::hit($otpKey, 300); // 5 minutes lockout
        $attempts = session('otp_attempts', 0) + 1;
        session(['otp_attempts' => $attempts]);

        if ($attempts >= 5) {
            session()->forget(['number', 'email11', 'start_time', 'otp_attempts']);
            return redirect()->route('forget11')
                ->withErrors(['otp' => 'Too many failed attempts. Please request a new OTP.']);
        }

        return back()->withErrors(['otp' => 'Invalid OTP. Attempts remaining: ' . (5 - $attempts)]);
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function forget44(Request $request)
    {
        // ✅ Verify session data exists
        if (!session()->has('email11')) {
            return redirect()->route('forget11')
                ->withErrors(['error' => 'Session expired. Please start password reset again.']);
        }

        $validated = $request->validate([
            'password' => 'required|string|min:12|max:128|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);
    
        $pwd11 = Hash::make($validated['password']);
        $email = session('email11');
        
        // ✅ Update password
        DB::table('users')
            ->where('email', '=', $email)
            ->update(['password' => $pwd11]);

        // ✅ FIXED: Log password change WITHOUT Auth::user() (user is not logged in!)
        try {
            DB::table('loginfo')->insert([
                'name' => 'Password Reset',
                'mobile' => null,
                'mail' => $email,
                'Device' => 'Web',
                'Browser' => 'Unknown',
                'ip' => $request->ip(),
                'Location' => 'Password Reset',
                'created_at' => now(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to log password reset: ' . $e->getMessage());
        }

        // ✅ Clear all password reset sessions
        session()->forget(['email11', 'number', 'start_time', 'otp_attempts']);
        
        toastr()->success('Password changed successfully. Please login with your new password.');
        return redirect()->route('login');
    }
/*

     public function customLogin(Request $request)
    {
      
      
       if (Auth::check()) {
        // Redirect to appropriate dashboard based on user role
        $user = Auth::user();
         

            if($user->role=='usermonitor')  {
                               // $this->sendLoginEmail(); // Send email after reaching dashboard
                toastr('Successfully Logged in'); return redirect("dash11");}

            else if($user->role=='userdataentry'){ 
               // $this->sendLoginEmail(); // Send email after reaching dashboard
                toastr('Successfully Logged in'); return redirect("datadash"); 
                                                                     }
        else if($user->role=='useradmin') {
            // $this->sendLoginEmail(); // Send email after reaching dashboard
            toastr('Successfully Logged in');
            return redirect("StoreDashboard") ; }
            else if($user->role=='usersectionadmin') {
            // $this->sendLoginEmail(); // Send email after reaching dashboard
            toastr('Successfully Logged in');
            return redirect("section5") ; }

        else if($user->role=='user') { 
            // $this->sendLoginEmail(); // Send email after reaching dashboard
            toastr('Successfully Logged in');return redirect("Newuser") ; }
        else if($user->role=='userone') { 
                // $this->sendLoginEmail(); // Send email after reaching dashboard
            toastr('Successfully Logged in');return redirect("userdash") ; }
    }

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
                //  try {
                    // Attempt to send the mail
                 //  $fft= now()->format('Y-m-d H:i:s');
                  //  Mail::to(Auth::user()->email)->send(new loginfo($fft));
                    
                    // Show success toastr notification
                   // toastr()->success('Successfully sent mail');
              // } catch (\Exception $e) {
                    // Handle failure and show error toastr notification
                   // toastr()->error('Mail Sent Error: ' . $e->getMessage());
               // }
                
                     //Device Location ip Browser 
                     DB::table('loginfo')->insert([
                      'name'=>Auth::user()->name,
                      'mobile' => Auth::user()->mobile,
                      'mail'=>Auth::user()->email,
                        
                      'Device'=>$platform,
                      'Browser'=>$browser,
                      'ip'=>$ip,
                      'Location'=>session('user_data_city'),
                        'created_at' => now(),
                       
                  ]);
                     

            if(Auth::user()->role=='usermonitor')  {
                               // $this->sendLoginEmail(); // Send email after reaching dashboard
                toastr('Successfully Logged in'); return redirect("dash11");}
        
            else if(Auth::user()->role=='userdataentry'){ 
               // $this->sendLoginEmail(); // Send email after reaching dashboard
                toastr('Successfully Logged in'); return redirect("datadash"); 
                                                                     }
        else if(Auth::user()->role=='useradmin') {
            // $this->sendLoginEmail(); // Send email after reaching dashboard
            toastr('Successfully Logged in');
            return redirect("StoreDashboard") ; }

        else if(Auth::user()->role=='user') { 
            // $this->sendLoginEmail(); // Send email after reaching dashboard
            toastr('Successfully Logged in');return redirect("Newuser") ; }
               else if(Auth::user()->role=='usersectionadmin') { 
            // $this->sendLoginEmail(); // Send email after reaching dashboard
            toastr('Successfully Logged in');return redirect("section5") ; }
        else if(Auth::user()->role=='userone') { 
                // $this->sendLoginEmail(); // Send email after reaching dashboard
            toastr('Successfully Logged in');return redirect("userdash") ; }
                                                                    }
              $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $ip = $request->ip();
        $data = Location::get($ip);

        DB::table('loginfo')->insert([
            'name'       => 'Failed Login Attempt',
            'mobile'     => null,
            'mail'       => $request->input('email'),
            'Device'     => $platform ?? 'Unknown',
            'Browser'    => $browser ?? 'Unknown',
            'ip'         => $ip,
            'Location'   => $data->cityName ?? 'Unknown',
            'created_at' => now(),
        ]);
          return redirect("login")->withError('Login details are not valid');
    }

     
*/
    public function customLogin(Request $request)
    {
        // ✅ If already logged in, redirect to dashboard
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        $this->validateLogin($request);

        // ✅ Check rate limiting
        if ($this->hasTooManyLoginAttempts($request)) {
            $seconds = RateLimiter::availableIn($this->throttleKey($request));
            
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds."
            ]);
        }

        // ✅ Attempt authentication
        if (Auth::attempt($request->only('email', 'password'))) {
            // ✅ CRITICAL: Regenerate session to prevent session fixation
            $request->session()->regenerate();
            
            $this->clearLoginAttempts($request);

            // ✅ Log successful login
            $this->storeLoginInfo($request);

            toastr('Successfully Logged in');
            return $this->redirectByRole(Auth::user());
        }

        // ❌ Login failed
        $this->incrementLoginAttempts($request);
        $this->logFailedAttempt($request);
        
        return back()->withErrors(['email' => 'Login details are not valid.']);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            // 'g-recaptcha-response' => 'required'
        ]);
    }

    protected function logFailedAttempt(Request $request)
    {
        try {
            $agent = new Agent();
            $browser = $agent->browser();
            $platform = $agent->platform();
            $ip = $request->ip();
            $data = Location::get($ip);

            DB::table('loginfo')->insert([
                'name'       => 'Failed Login Attempt',
                'mobile'     => null, // ✅ FIXED: Should be null, not 'new user'
                'mail'       => $request->input('email'),
                'Device'     => $platform ?? 'Unknown',
                'Browser'    => $browser ?? 'Unknown',
                'ip'         => $ip,
                'Location'   => $data->cityName ?? 'Unknown',
                'created_at' => now(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to log failed login attempt: ' . $e->getMessage());
        }
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return RateLimiter::tooManyAttempts($this->throttleKey($request), 5);
    }

    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit($this->throttleKey($request), 60);
    }

    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    protected function storeLoginInfo(Request $request)
    {
        try {
            $user = Auth::user();
            $agent = new Agent();
            $browser = $agent->browser();
            $platform = $agent->platform();
            $ip = $request->ip();
            $data = Location::get($ip);

            DB::table('loginfo')->insert([
                'name'       => $user->name ?? 'Unknown',
                'mobile'     => $user->mobile ?? null,
                'mail'       => $user->email ?? 'Unknown',
                'Device'     => $platform ?? 'Unknown',
                'Browser'    => $browser ?? 'Unknown',
                'ip'         => $ip,
                'Location'   => $data->cityName ?? 'Unknown',
                'created_at' => now(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to store login info: ' . $e->getMessage());
        }
    }

    private function redirectByRole($user)
    {
        switch ($user->role) {
            case 'usermonitor': 
                return redirect('dash11');
            case 'userdataentry': 
                return redirect('datadash');
            case 'useradmin': 
                return redirect('StoreDashboard');
            case 'usersectionadmin': 
                return redirect('section5');
            case 'user': 
                return redirect('Newuser');
            case 'userone': 
               Mail::to($user->email)->queue(new loginfo($user));
               return redirect('userdash');
            default:
                Auth::logout();
                return redirect('login')->withErrors(['role' => 'Invalid user role']);
        }
    }

    public function customRegistration(Request $request)
    {    
        $converter = new ConverterController();
        $request->merge([
            'mobile' => $converter->bn2en($request->mobile),
        ]);
        
        $validated = $request->validate([
            'name' => 'required|string|max:35',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:12|max:128|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'mobile' => 'required|string|max:15',
            'office' => 'required|string|max:60',
            'designation' => 'required|string|max:60',
            'designation2' => 'required|string|max:60',
        ]);

        $data = $validated;
        $check = $this->create($data);
        
        // ✅ Login and regenerate session
        Auth::login($check);
        $request->session()->regenerate();
        
        $userid = session('userid');
        $agent = new Agent();
        $browser = $agent->browser();
        $browser_version = $agent->version($browser);
        $platform = $agent->platform();
        $platform_version = $agent->version($platform);
        $ip = $request->ip();
        $data = Location::get($ip);

        $region11 = $data->regionName ?? 'Unknown Region';
        
        devicedetails::create([
            'userid' => $userid, 
            'ip' => $ip, 
            'region' => $region11, 
            'browser' => $browser, 
            'browser_version' => $browser_version, 
            'device' => $platform,
            'device_version' => $platform_version
        ]);

        PersonalInfo::create([
            'userid' => Auth::user()->userid,
            'name' => $validated['name'],
            'mobile' => $validated['mobile'],
            'designation' => $validated['designation'],
            'designation2' => $validated['designation2'],
            'office' => $validated['office'],
            'email' => $validated['email'],
        ]);

        toastr()->success('Registration successful!');
        return redirect("userdash");
    }

    public function create(array $data)
    {
        $platform = \Agent::platform();
        $lastId = User::max('id');
        $userid = 'User' . ($lastId + 10002);
        session(['userid' => $userid]);
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'location' => 'Bangladesh',
            'device' => $platform,
            'mobile' => $data['mobile'],
            'role' => 'userone',
            'avatar' => 'j1.png',
            'userid' => $userid,
        ]);
    }
}