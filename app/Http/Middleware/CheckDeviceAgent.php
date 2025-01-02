<?php

namespace App\Http\Middleware;
 
use App\Models\devicedetails;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Closure;

use Illuminate\Support\Facades\DB;

class CheckDeviceAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       
        if (Auth::check()) {
           
          
            $browser = \Agent::browser();
            $browser_version =\Agent::version($browser);
            
                 $platform = \Agent::platform();
             $platform_version = \Agent::version($platform);

            // Check if the user is using a registered device/agent in the device_details table
            $exists = devicedetails::
                        where('userid', Auth::user()->userid)  // Assuming 'user_id' is the column name
                        ->where('browser', $browser)
                        ->where('browser_version', $browser_version)
                        ->where('device', $platform)
                        ->where('device_version', $platform_version)
                        ->exists();  // 'exists()' will return true/false


            if (!$exists) {
                return redirect()->route('device.register') // Replace 'your.route.name' with your desired route
                ->with([
                    'message' => 'Unauthorized device or agent.',
                    'exists' => $exists,
                ]);
            }
        }

        return $next($request);
    }
     
}
