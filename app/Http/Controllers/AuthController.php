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

use Alert;
use App\Rules\ReCaptcha;

class AuthController extends Controller
{
    // Session key constants
    const SESSION_PASSWORD_RESET_EMAIL = 'password_reset_email';
    const SESSION_PASSWORD_RESET_OTP = 'password_reset_otp';
    const SESSION_PASSWORD_RESET_TIMESTAMP = 'password_reset_timestamp';
    const SESSION_PASSWORD_RESET_VERIFIED = 'password_reset_verified';
    const OTP_EXPIRY_MINUTES = 5;
    const OTP_MAX_ATTEMPTS = 5;

    /**
     * Show password reset request form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forget11');
    }

    /**
     * Send password reset OTP
     */
    public function sendPasswordResetOTP(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $validated['email'];

        // Rate limiting: 3 attempts per 10 minutes per email
        $rateLimitKey = 'password-reset-otp:' . $email;
        
        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return back()->withErrors([
                'email' => "Too many attempts. Please try again in " . ceil($seconds / 60) . " minutes."
            ]);
        }

        RateLimiter::hit($rateLimitKey, 600); // 10 minutes

        // Generate secure OTP
        $otp = $this->generateSecureOTP();
        
        // Store in session with encryption
        $this->storePasswordResetSession($email, $otp);

        // Send OTP via email
        try {
            Mail::to($email)->send(new recovery11($otp));
            
            if (!empty(Mail::failures())) {
                $this->clearPasswordResetSession();
                return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
            }

            toastr()->success('OTP sent to your email successfully');
            
            return view('auth.forget22', [
                'email' => $email,
                'expiryTime' => Carbon::now()->addMinutes(self::OTP_EXPIRY_MINUTES)->toISOString()
            ]);

        } catch (\Exception $e) {
            $this->clearPasswordResetSession();
            \Log::error('OTP Send Error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again later.']);
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6'
        ]);

        // Check if session exists
        if (!session()->has(self::SESSION_PASSWORD_RESET_EMAIL)) {
            return redirect()->route('password.request')
                ->withErrors(['error' => 'Session expired. Please start again.']);
        }

        // Check OTP expiry
        if ($this->isOTPExpired()) {
            $this->clearPasswordResetSession();
            return redirect()->route('password.request')
                ->withErrors(['error' => 'OTP has expired. Please request a new one.']);
        }

        // Rate limiting for OTP verification
        $email = session(self::SESSION_PASSWORD_RESET_EMAIL);
        $rateLimitKey = 'otp-verify:' . $email;
        
        if (RateLimiter::tooManyAttempts($rateLimitKey, self::OTP_MAX_ATTEMPTS)) {
            $this->clearPasswordResetSession();
            return redirect()->route('password.request')
                ->withErrors(['error' => 'Too many failed attempts. Please request a new OTP.']);
        }

        // Verify OTP
        $storedOTP = session(self::SESSION_PASSWORD_RESET_OTP);
        
        if ($request->otp != $storedOTP) {
            RateLimiter::hit($rateLimitKey, 600);
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }

        // OTP verified successfully
        RateLimiter::clear($rateLimitKey);
        
        // Mark as verified and clear OTP from session
        session([self::SESSION_PASSWORD_RESET_VERIFIED => true]);
        session()->forget(self::SESSION_PASSWORD_RESET_OTP);

        return view('auth.forget33');
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        // Check if OTP was verified
        if (!session()->has(self::SESSION_PASSWORD_RESET_VERIFIED)) {
            return redirect()->route('password.request')
                ->withErrors(['error' => 'Unauthorized access. Please verify OTP first.']);
        }

        // Check if session is still valid
        if ($this->isOTPExpired()) {
            $this->clearPasswordResetSession();
            return redirect()->route('password.request')
                ->withErrors(['error' => 'Session expired. Please start again.']);
        }

        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:12',
                'max:128',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{12,}$/'
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ]);

        $email = session(self::SESSION_PASSWORD_RESET_EMAIL);
        
        DB::beginTransaction();
        try {
            $user = User::where('email', $email)->firstOrFail();
            
            $user->password = Hash::make($validated['password']);
            $user->save();

            // Log the password reset
            info11::create([
                'name' => $user->name,
                'email' => $user->email,
                'userid' => $user->userid,
                'type' => 'User',
                'action' => 'Password Reset',
                'status' => 'success'
            ]);

            DB::commit();

            // Clear all password reset session data
            $this->clearPasswordResetSession();

            toastr()->success('Password reset successfully. Please login with your new password.');
            return redirect()->route('login');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Password Reset Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to reset password. Please try again.']);
        }
    }


public function alreadyLoggedIn()
{
    return view('auth.already-logged-in', ['user' => Auth::user()]);
}

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        // If already authenticated, redirect to dashboard
        if (Auth::check()) {
            return $this->redirectToDashboard();
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
           // 'g-recaptcha-response' => ['required', new ReCaptcha()]
        ]);

        $credentials = $request->only('email', 'password');
        
        // Rate limiting: 5 attempts per 15 minutes per IP
        $rateLimitKey = 'login-attempts:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in " . ceil($seconds / 60) . " minutes."
            ])->withInput($request->only('email'));
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Clear rate limiter on successful login
            RateLimiter::clear($rateLimitKey);

            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Set secure session parameters
            $this->setSecureSessionParameters($request);

            // Log the login attempt
            $this->logLoginAttempt($request, true);

            // Send login notification email
           $this->sendLoginNotification();

            toastr()->success('Successfully logged in');
            return $this->redirectToDashboard();
        }

        // Increment rate limiter on failed attempt
        RateLimiter::hit($rateLimitKey, 900); // 15 minutes

        // Log failed login attempt
        $this->logLoginAttempt($request, false);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle user registration
     */

    public function registration()
    {
        $draft1 = DB::table('codetable')
        ->select('*')->where('status','designation')
        ->get(); 
        $draft2 = DB::table('codetable')
        ->select('*')->where('status','district')
        ->get();       
               
        $draft3 = DB::table('codetable')
        ->select('*')->where('status','office')
        ->get(); 
    return view('auth.registration', compact('draft1','draft2','draft3'));
    }


     public function customRegistration(Request $request)
    {    
        $converter = new ConverterController();
 $request->merge([
        'serviceid' => $converter->bn2en($request->serviceid),
    ]);
       $validated=$request->validate([
            'name' => 'required|string|max:30',
            'district' => 'required|string|max:30',
            'designation' => 'required|string|max:100',
            'office' => 'required|string|max:100',

            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:12|max:128|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'serviceid'=>['required','string','size:10','regex:/^(199[0-9]|20[0-2][0-9]|2030)[0-9]{6}$/', 'unique:users'],
            'mobile'=>'required|string|max:20|unique:users'
        ]);
        
        
        
        
        // $ip=$request->ip();
 
         
         //$browser = \Agent::browser();
          
        
        
        // $dataloc = \Location::get($ip); 

        $data = $validated;
         

       

        $check = $this->create($data);
        Auth::login($check);
         $request->session()->regenerate();

            // Set secure session parameters
            $this->setSecureSessionParameters($request);
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
      
      wifeinfo::create([
        'userid' => $userid,
       
         
       ]);
       workingnow::create([
        'userid' => $userid,
        'district'=>Auth::user()->district,
        'designation'=>Auth::user()->designation,
        'mobile'=>Auth::user()->mobile,
         
        'office'=>Auth::user()->doptor,
       ]);
       personalinfo::create([
        'userid' => $userid,
         
        'mobile'=>Auth::user()->mobile,
        'name'=>Auth::user()->name ,
        
        'email'=>Auth::user()->email,
        'serviceid'=>Auth::user()->serviceid,
       
       ]);

       preferred111::create([
        'userid' => $userid,
        'district'=>'kk', 
        'reason'=>'kk',
        'date'=>'2022-02-02',
        'representation'=>'kk'
       ]);
        
     

        return redirect("profile")->with('You have signed-in');
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
        
        'avatar'=>'j1.png',
         'serviceid'=>$data['serviceid'],
         'doptor'=>trim($data['office']),
         'userid'=>$userid,
      ]);
    }   


    public function register(Request $request)
    {
        $converter = new ConverterController();
        $request->merge([
            'serviceid' => $converter->bn2en($request->serviceid),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'district' => 'required|string|max:50',
            'designation' => 'required|string|max:100',
            'office' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:12',
                'max:128',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{12,}$/'
            ],
            'serviceid' => [
                'required',
                'string',
                'size:10',
                'regex:/^(199[0-9]|20[0-2][0-9]|2030)[0-9]{6}$/',
                'unique:users,serviceid'
            ],
            'mobile' => 'required|string|max:20|unique:users,mobile',
            //'g-recaptcha-response' => ['required', new ReCaptcha()]
        ]);

        DB::beginTransaction();
        try {
            // Create user with secure userid
            $user = $this->createUser($validated);

            // Log user in
            Auth::login($user);

            // Regenerate session after login
            $request->session()->regenerate();

            // Set secure session parameters
            $this->setSecureSessionParameters($request);

            // Create related records
            $this->createUserRelatedData($user, $request);

            DB::commit();

            toastr()->success('Registration successful! Welcome aboard.');
            return redirect()->route('jobinfo');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Registration Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Registration failed. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Logout user
     */
   
   
   public function logout11()
    {
                Session::flush();

      Auth::logout();

        // Invalidate session
       // $request->session()->invalidate();

        // Regenerate CSRF token
       // $request->session()->regenerateToken();

        toastr()->info('You have been logged out successfully');
        return redirect()->route('login');
    }
   
   
   
    public function logout(Request $request)
    {
        $user = Auth::user();

        // Log the logout
        if ($user) {
            info11::create([
                'name' => $user->name,
                'email' => $user->email,
                'userid' => $user->userid,
                'type' => 'User',
                'action' => 'Logout',
                'status' => 'success'
            ]);
        }

        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        toastr()->info('You have been logged out successfully');
        return redirect()->route('login');
    }

    // ==================== Helper Methods ====================

    /**
     * Generate secure OTP
     */
    private function generateSecureOTP(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Store password reset session data securely
     */
    private function storePasswordResetSession(string $email, string $otp): void
    {
        session([
            self::SESSION_PASSWORD_RESET_EMAIL => $email,
            self::SESSION_PASSWORD_RESET_OTP => $otp,
            self::SESSION_PASSWORD_RESET_TIMESTAMP => Carbon::now(),
            self::SESSION_PASSWORD_RESET_VERIFIED => false
        ]);
    }

    /**
     * Check if OTP has expired
     */
    private function isOTPExpired(): bool
    {
        if (!session()->has(self::SESSION_PASSWORD_RESET_TIMESTAMP)) {
            return true;
        }

        $timestamp = session(self::SESSION_PASSWORD_RESET_TIMESTAMP);
        $expiryTime = Carbon::parse($timestamp)->addMinutes(self::OTP_EXPIRY_MINUTES);

        return Carbon::now()->isAfter($expiryTime);
    }

    /**
     * Clear password reset session data
     */
    private function clearPasswordResetSession(): void
    {
        session()->forget([
            self::SESSION_PASSWORD_RESET_EMAIL,
            self::SESSION_PASSWORD_RESET_OTP,
            self::SESSION_PASSWORD_RESET_TIMESTAMP,
            self::SESSION_PASSWORD_RESET_VERIFIED
        ]);
    }

    /**
     * Set secure session parameters
     */
    private function setSecureSessionParameters(Request $request): void
    {
        // Store session metadata for security
        session([
            'user_ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'last_activity' => Carbon::now(),
            'session_id' => Str::random(40)
        ]);

        // Set session lifetime (optional)
        config(['session.lifetime' => 120]); // 2 hours
    }

    /**
     * Log login attempt
     */
    private function logLoginAttempt(Request $request, bool $success): void
    {
        $browser = \Agent::browser();
        $platform = \Agent::platform();
        $ip = $request->ip();
        
        $location = 'Unknown';
        try {
            $locationData = Location::get($ip);
            if ($locationData) {
                $location = $locationData->cityName ?? 'Unknown';
            }
        } catch (\Exception $e) {
            \Log::warning('Location lookup failed: ' . $e->getMessage());
        }

        DB::table('loginfo')->insert([
            'district' => $success ? Auth::user()->district : null,
            'mobile' => $success ? Auth::user()->mobile : null,
            'mail' => $request->email,
            'time' => Carbon::now(),
            'Device' => $platform,
            'Browser' => $browser,
            'ip' => $ip,
            'Location' => $location,
            'status' => $success ? 'success' : 'failed'
        ]);
    }

    /**
     * Send login notification email
     */
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

    /**
     * Redirect to appropriate dashboard based on user role
     */
    private function redirectToDashboard()
    {
        $user = Auth::user();
        
        $dashboards = [
            'userdr' => 'newdash',
            
            'userone' => 'profile'
        ];

        $route = $dashboards[$user->role] ?? 'profile';
        return redirect()->route($route);
    }

    /**
     * Create user with secure userid
     */
    private function createUser(array $data): User
    {
        // Generate unique userid using UUID or secure random string
        $userid = 'User' . Str::upper(Str::random(12));

        // Ensure uniqueness
        while (User::where('userid', $userid)->exists()) {
            $userid = 'User' . Str::upper(Str::random(12));
        }

        return User::create([
            'name' => trim($data['name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'district' => trim($data['district']),
            'designation' => trim($data['designation']),
            'mobile' => $data['mobile'],
            'serviceid' => $data['serviceid'],
            'doptor' => trim($data['office']),
            'userid' => $userid,
            'role' => 'userone',
            'avatar' => 'j1.png'
        ]);
    }

    /**
     * Create user-related data
     */
    private function createUserRelatedData(User $user, Request $request): void
    {
        $browser = \Agent::browser();
        $browserVersion = \Agent::version($browser);
        $platform = \Agent::platform();
        $platformVersion = \Agent::version($platform);
        $ip = $request->ip();

        $region = 'Unknown';
        try {
            $locationData = Location::get($ip);
            if ($locationData) {
                $region = $locationData->regionName ?? 'Unknown';
            }
        } catch (\Exception $e) {
            \Log::warning('Location lookup failed: ' . $e->getMessage());
        }

        // Device details
        devicedetails::create([
            'userid' => $user->userid,
            'ip' => $ip,
            'region' => $region,
            'browser' => $browser,
            'browser_version' => $browserVersion,
            'device' => $platform,
            'device_version' => $platformVersion
        ]);

        // Working now
        workingnow::create([
            'userid' => $user->userid,
            'district' => $user->district,
            'designation' => $user->designation,
            'mobile' => $user->mobile,
            'office' => $user->doptor,
        ]);

        // Personal info
        personalinfo::create([
            'userid' => $user->userid,
            'mobile' => $user->mobile,
            'name' => $user->name,
            'email' => $user->email,
            'serviceid' => $user->serviceid,
        ]);

        // Preferred (initialize with placeholder data)
        preferred111::create([
            'userid' => $user->userid,
            'district' => 'Not Set',
            'reason' => 'Not Set',
            'date' => Carbon::now(),
            'representation' => 'Not Set'
        ]);
    }
}