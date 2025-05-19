<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\applicationinfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
 
class CheckApplicationStatus
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
         // or fetch by ID if needed

        $info=applicationinfo::where('userid',Auth::user()->userid)->first();
        $application = $info->status;
        if (!$application || $application !== 'Draft') {
            return redirect()
                ->route('NotaryDashboard') // Replace with your actual dashboard route name
                ->with('warning', 'আপনার ফাইলটি  ইতোমধ্যে পাঠান হয়েছে । বর্তমানে সেটা প্রক্রিয়াধীন আছে  বিধায় সংশোধন করতে পারবেন না । ');
        }

        return $next($request);
    }
}
