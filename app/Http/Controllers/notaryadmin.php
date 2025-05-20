<?php

 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;
use App\Models\User;
use App\Http\Controllers\ConverterController;
use App\Models\notarydetails;
use App\Models\personalinfo;
use App\Models\info11;
use App\Models\education;
use App\Models\documents;
use App\Models\devicedetails;
use App\Models\applicationinfo;

use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\File;
 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginfo;
use App\Mail\userinfo; 
use Illuminate\Support\Facades\View;
use Image;
use DB;
use Mpdf\Mpdf;
use Toastr;
use RealRashid\SweetAlert\Facades\Alert;
use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;




class notaryadmin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function newdash()
    {
         $bread11="Dashboard";
        $application = applicationinfo::with('personalinfo')->where('status', 'Processing')->get();
        return view('DR.newdashboard', compact('bread11', 'application'));
    }
    public function approvedList()
    {
        $approvedApplications = NotaryInfo::approved()->get();
        
        return view('notary.approved', compact('approvedApplications'));
    }
    
    /**
     * Display list of expired applications
     */
    public function expiredList()
    {
        $expiredApplications = NotaryInfo::expired()->get();
        
// You can also chain scopes with other query methods:
$recentApprovedApplications = NotaryInfo::approved()->where('natarydate', '>=', now()->subYear())->get();

// Or combine with pagination:
$paginatedExpired = NotaryInfo::expired()->paginate(10);

// Or use with ordering:
$oldestExpired = NotaryInfo::expired()->orderBy('natarydate', 'asc')->get();
        return view('notary.expired', compact('expiredApplications'));
    }
    
    /**
     * Check application status
     */
    public function checkStatus($applicationId)
    {
        $application = NotaryInfo::where('applicationid', $applicationId)->first();
        
        if (!$application) {
            return redirect()->back()->with('error', 'Application not found');
        }
        
        $status = $application->isApproved() ? 'approved' : 'expired';
        
        return redirect()->back()->with('info', "Application status: {$status}");
    }
}
