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
    public function viewlist($id)
    {
        
        $bread11="Profile";
        session(['appid'=>$id]);
        $personalInfo=personalinfo::where('applicationid',session('appid'))->first();
        $educationInfo=education::where('applicationid',session('appid'))->first();
        $documents=documents::where('applicationid',session('appid'))->first();
        $notaryInfo=notarydetails::where('applicationid',session('appid'))->first();
        return view('DR.profile',compact('bread11','personalInfo','educationInfo','documents','notaryInfo'));
  }
    public function back111($id)
    {
        $status=applicationinfo::where('applicationid',$id)->first();
        if($status->status=='Approved'){

            applicationinfo::where('applicationid',$id)->update(['status'=>'Processing']);
            info11::create([
                'name' => Auth::user()->name,
                'userid' => Auth::user()->userid, // or any valid user ID
                'applicationid' => $id,
                'action' => 'Back to Processing',
                'status' => 'Fileback',
            ]);
            return redirect()->back()->withInfo(' File Sent to Processing Successfully');  
    
    }
        elseif($status->status=='Processing'){

            applicationinfo::where('applicationid',$id)->update(['status'=>'Draft']);
            info11::create([
                'name' => Auth::user()->name,
                'userid' => Auth::user()->userid, // or any valid user ID
                'applicationid' => $id,
                'action' => 'Back to User',
                'status' => 'Fileback',
            ]);
            return redirect()->back()->withInfo(' File Sent to User Successfully');  
        }
         
       
       
       
       
    }
    public function deletelist($id)
    {
        $bread11="Processing List";
        $application = applicationinfo::with('personalinfo')->where('status', 'Processing')->get();
        return view('DR.processing', compact('bread11', 'application'));
    }
   public function approvedList($id)
    {
        applicationinfo::where('applicationid',$id)->update(['status'=>'Approved']);
        info11::create([
            'name' => Auth::user()->name,
            'userid' => Auth::user()->userid, // or any valid user ID
            'applicationid' => $id,
            'action' => 'Approved Application',
            'status' => 'Sent for Publishing',
        ]);

        return redirect(route('approved'))->withSuccess('  File Approved Successfully');  

          }
   
    public function approved()
    {
        $bread11="Approved List";
        $application = applicationinfo::with('personalinfo')->where('status', 'Approved')->get();
        return view('DR.approved', compact('bread11', 'application'));
    
    }
    public function publishedList($id)
    {
        applicationinfo::where('applicationid',$id)->update(['status'=>'Published']);
        info11::create([
            'name' => Auth::user()->name,
            'userid' => Auth::user()->userid, // or any valid user ID
            'applicationid' => $id,
            'action' => 'Published Application',
            'status' => 'Sent for Publishing',
        ]);

        return redirect(route('published'))->withSuccess('  File Published Successfully');  
    }
    public function published()
    {
        $bread11="Published List";
        $application = applicationinfo::with('personalinfo')->where('status', 'Published')->get();
        return view('DR.published', compact('bread11', 'application'));
    
    }
    /**Get notaries expiring within 30 days
$expiringSoon = notarydetails::expiringSoon()->get();

// Check individual notary status
$notary = notarydetails::find(1);
if ($notary->isExpired()) {
    echo "This notary is expired";
} elseif ($notary->isRenewalDueSoon()) {
    echo "Renewal due soon: " . $notary->getRenewalStatus();
}
     */
    public function expiredList()
    {


        //$approvedApplications = NotaryInfo::approved()->get();
        
        //return view('DR.approved', compact('approvedApplications'));
       // $expiredApplications = NotaryInfo::expired()->get();
        
// You can also chain scopes with other query methods:
//$recentApprovedApplications = NotaryInfo::approved()->where('natarydate', '>=', now()->subYear())->get();

// Or combine with pagination:
//$paginatedExpired = NotaryInfo::expired()->paginate(10);

// Or use with ordering:
$oldestExpired = NotaryInfo::expired()->orderBy('natarydate', 'asc')->get();
        return view('notary.expired', compact('oldestExpired'));
    }
    public function expired()
    {
        $bread11="Expired List";
        // First get the expired application IDs
        $expiredApplicationIds = notarydetails::expired()
        ->orderBy('natarydate', 'asc')
        ->pluck('applicationid');

        // Then get the applications with personal info
        $application = applicationinfo::with('personalinfo')
        ->whereIn('applicationid', $expiredApplicationIds)
        ->get();
        return view('DR.expired', compact('bread11', 'application'));
    
    }
    public function valid111()
    {
        $bread11="Valid List";
        $expiredApplicationIds = notarydetails::approved()
        ->orderBy('natarydate', 'asc')
        ->pluck('applicationid');

        // Then get the applications with personal info
        $application = applicationinfo::with('personalinfo')
        ->whereIn('applicationid', $expiredApplicationIds)
        ->get();
        return view('DR.valid111', compact('bread11', 'application'));
    
    }
                /*
     * Check application status
   
    public function checkStatus($applicationId)
    {
        $application = NotaryInfo::where('applicationid', $applicationId)->first();
        
        if (!$application) {
            return redirect()->back()->with('error', 'Application not found');
        }
        
        $status = $application->isApproved() ? 'approved' : 'expired';
        
        return redirect()->back()->with('info', "Application status: {$status}");
    }  */
}
