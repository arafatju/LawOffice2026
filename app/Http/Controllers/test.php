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
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class test extends Controller
{
    public function forget11()
    {
        return view('auth.forget11');
    }

   public function forget22(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    // 1 OTP per minute per email+IP
    $key = 'forget-password:' . Str::lower($validated['email']) . '|' . $request->ip();
    if (RateLimiter::tooManyAttempts($key, 1)) {
        $seconds = RateLimiter::availableIn($key);
        return back()->withErrors(['email' => "Too many attempts. Please try again in {$seconds} seconds."]);
    }
    RateLimiter::hit($key, 60);

    $otp = random_int(100000, 999999);

    session([
        'email11'      => $validated['email'],
        'number'       => $otp,
        'otp_attempts' => 0,
        'otp_verified' => false,
        'start_time'   => Carbon::now(),
    ]);

    try {
        Mail::to($validated['email'])->queue(new recovery11($otp));
        toastr()->success('Recovery email has been sent');
        return redirect()->route('forget22.show');
    } catch (\Exception $e) {
        \Log::error('Failed to queue recovery email: ' . $e->getMessage());
        $this->clearResetSession();
        toastr()->error('Failed to send recovery email. Please try again later.');
        return back();
    }
}

public function showOtpForm()
{
    if (!session()->has('email11') || $this->otpExpired()) {
        $this->clearResetSession();
        return redirect()->route('forget11')
            ->withErrors(['error' => 'Session expired. Please start again.']);
    }

    $endTime = Carbon::parse(session('start_time'))->addMinutes(5);

    return view('auth.forget22', ['endTime' => $endTime->toISOString()]);
}

public function forget33(Request $request)
{
    if (!session()->has('email11') || $this->otpExpired()) {
        $this->clearResetSession();
        return redirect()->route('forget11')
            ->withErrors(['error' => 'OTP expired. Please start again.']);
    }

    $otpKey = 'otp-verify:' . Str::lower(session('email11')) . '|' . $request->ip();

    if (RateLimiter::tooManyAttempts($otpKey, 5)) {
        $this->clearResetSession();
        return redirect()->route('forget11')
            ->withErrors(['otp' => 'Too many failed attempts. Please request a new OTP.']);
    }

    $request->validate(['otp' => 'required|numeric|digits:6']);

    if (hash_equals((string) session('number'), (string) $request->otp)) {
        RateLimiter::clear($otpKey);
        session([
            'otp_verified' => true,
            'verified_at'  => Carbon::now(),
        ]);
        session()->forget('number');

        return redirect()->route('forget33.show');
    }

    RateLimiter::hit($otpKey, 300);
    $attempts = session('otp_attempts', 0) + 1;
    session(['otp_attempts' => $attempts]);

    if ($attempts >= 5) {
        $this->clearResetSession();
        return redirect()->route('forget11')
            ->withErrors(['otp' => 'Too many failed attempts. Please request a new OTP.']);
    }

    return back()->withErrors(['otp' => 'Invalid OTP. Attempts remaining: ' . (5 - $attempts)]);
}

public function showNewPasswordForm()
{
    if (!$this->resetAllowed()) {
        $this->clearResetSession();
        return redirect()->route('forget11')
            ->withErrors(['error' => 'Please verify the OTP first.']);
    }

    return view('auth.forget33');
}

public function forget44(Request $request)
{
    // OTP must have been verified in this session
    if (!$this->resetAllowed()) {
        $this->clearResetSession();
        return redirect()->route('forget11')
            ->withErrors(['error' => 'Session expired. Please start password reset again.']);
    }

    $validated = $request->validate([
        'password' => 'required|string|min:12|max:128|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
    ]);

    $email = session('email11');

    DB::table('users')
        ->where('email', $email)
        ->where('role','userone')
        ->update(['password' => Hash::make($validated['password'])]);

    try {
        DB::table('loginfo')->insert([
            'name'       => 'Password Reset',
            'mobile'     => null,
            'mail'       => $email,
            'Device'     => 'Web',
            'Browser'    => 'Unknown',
            'ip'         => $request->ip(),
            'Location'   => 'Password Reset',
            'created_at' => now(),
        ]);
    } catch (\Exception $e) {
        \Log::error('Failed to log password reset: ' . $e->getMessage());
    }

    $this->clearResetSession();

    toastr()->success('Password changed successfully. Please login with your new password.');
    return redirect()->route('login');
}

// ---- helpers (add anywhere in the class) ----

private function otpExpired(): bool
{
    $start = session('start_time');
    return !$start || Carbon::parse($start)->addMinutes(5)->isPast();
}

private function resetAllowed(): bool
{
    return session()->has('email11')
        && session('otp_verified') === true
        && session('verified_at')
        && Carbon::parse(session('verified_at'))->addMinutes(10)->isFuture();
}

private function clearResetSession(): void
{
    session()->forget(['email11', 'number', 'start_time', 'otp_attempts', 'otp_verified', 'verified_at']);
}

    public function registration()
    {
        return view('auth.registration');
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

       // $this->validateLogin($request);


        $validator = Validator::make($request->all(), [
        'email'    => 'required|email',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        $this->logFailedAttempt($request, 'Failed Login (Invalid Input)');
        return back()->withErrors($validator)->withInput($request->only('email'));
    }

        // ✅ Check rate limiting
        if ($this->hasTooManyLoginAttempts($request)) {
          
                    $this->logFailedAttempt($request, 'Failed Login (Throttled)');

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
            
           $this->sendLoginNotification();

            toastr('Successfully Logged in');
            return $this->redirectByRole(Auth::user());
        }

        // ❌ Login failed
        $this->incrementLoginAttempts($request);

    $this->logFailedAttempt($request, 'Failed Login Attempt');        
        
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

   protected function logFailedAttempt(Request $request, string $reason = 'Failed Login Attempt')
{
    try {
        $agent = new Agent();
        $data  = Location::get($request->ip());

        DB::table('loginfo')->insert([
            'name'       => $reason,
            'mobile'     => null,
            'mail'       => (string) $request->input('email', 'unknown'),
            'Device'     => $agent->platform() ?: 'Unknown',
            'Browser'    => $agent->browser() ?: 'Unknown',
            'ip'         => $request->ip(),
            'Location'   => ($data && $data->cityName) ? $data->cityName : 'Unknown',
            'created_at' => now(),
        ]);
    } catch (\Throwable $e) {
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
 private function sendLoginNotification(): void
{
    try {
        $user = Auth::user();
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');

        $browser = \Agent::browser();
        $browserVersion = \Agent::version($browser);
        $platform = \Agent::platform();
        $platformVersion = \Agent::version($platform);
        $ip = request()->ip();

        $city = session('user_data_city');
        $region = session('user_data_region');
        $country = session('user_data_country');

        Mail::to($user->email)->later(now()->addSeconds(5), new loginfo(
            $timestamp,
            $user,
            $browser,
            $browserVersion,
            $platform,
            $platformVersion,
            $ip,
            $city,
            $region,
            $country
        ));
    } catch (\Exception $e) {
        \Log::error('Login notification email failed: ' . $e->getMessage());
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
                 // Mail::to($user->email)->send(new loginfo($user));
                return redirect('StoreDashboard');
            case 'usersectionadmin': 
                return redirect('section5');
            case 'user': 
                return redirect('Newuser');
            case 'userone': 
               //Mail::to($user->email)->queue(new loginfo($user));
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