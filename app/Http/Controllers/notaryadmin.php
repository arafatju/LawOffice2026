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
    public function newdash(Request $request)
    {
         $bread11="Dashboard";
         if ($request->ajax()) {
        $data = applicationinfo::with('personalinfo')->where('status','Processing')->get();

        return DataTables::of($data)
            ->addColumn('name', function($row) {
                return $row->personalinfo->name ?? 'N/A';
            })
            ->addColumn('mobile', function($row) {
                return $row->personalinfo->mobile ?? 'N/A';
            })
            ->addColumn('action', function($row) {
                $view = route('viewlist', $row->applicationid);
                $approve = route('approvedList', $row->applicationid);
                $back = route('back111', $row->applicationid);
                $delete = route('sendto111', $row->applicationid);

                return '
                    <a href="'.$view.'" class="btn btn-info btn-sm mr-1"><i class="fa fa-eye"></i> View</a>
                    <a href="'.$approve.'" class="btn btn-success btn-sm mr-1" onclick="event.preventDefault(); doubleConfirm(\''.$approve.'\');"><i class="fa fa-check"></i> Approve</a>
                    <a href="'.$back.'" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> File Back</a>
                    <a href="'.$delete.'" class="btn btn-danger btn-sm" onclick="event.preventDefault(); deleteConfirm(\''.$delete.'\');"><i class="fa fa-trash"></i> Delete</a>
                ';
            })
            ->rawColumns(['action']) // allow HTML in action column
            ->make(true);
    }
        
            $approved = applicationinfo::countApproved();
            $processing = applicationinfo::countProcessing();
         $validCount = notarydetails::approved()->count();
         $expiredCount = notarydetails::expired()->count();


        return view('DR.newdashboard', compact('bread11','approved', 'processing', 'validCount', 'expiredCount'));
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
     public function renew($id, $previous, $next)
{
 $notary = notarydetails::where('applicationid', $id)->firstOrFail();

    $success = $notary->renewDates($previous, $next);

    if ($success) {
        return redirect()->back()->with('success', 'Renewal dates updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update renewal dates.');
    }
}

    public function approved(Request $request)
    {
        $bread11="Approved List";

        if ($request->ajax()) {
        $data = applicationinfo::with('personalinfo')->where('status', 'Approved')->get();


        return DataTables::of($data)
            ->addColumn('name', function($row) {
                return $row->personalinfo->name ?? 'N/A';
            })
            ->addColumn('mobile', function($row) {
                return $row->personalinfo->mobile ?? 'N/A';
            })
            ->addColumn('action', function($row){
                $view = '<a href="'.route('viewlist', $row->applicationid).'" class="btn btn-info btn-sm"><span class="fa fa-eye"></span> View</a>';
                $publish = '<a href="'.route('publishedList', $row->applicationid).'" onclick="event.preventDefault(); doubleConfirm(\''.route('publishedList', $row->applicationid).'\');" class="btn btn-success btn-sm"><span class="fa fa-check"></span> Publish</a>';
                $back = '<a href="'.route('back111', $row->applicationid).'" class="btn btn-secondary btn-sm"><span class="fa fa-arrow-left"></span> File Back</a>';
                $delete = '<a href="'.route('deletelist', $row->applicationid).'" onclick="event.preventDefault(); deleteConfirm(\''.route('sendto111', $row->applicationid).'\');" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Delete</a>';
                return $view . ' ' . $publish . ' ' . $back . ' ' . $delete;
            })
            ->rawColumns(['action']) // Important: render HTML
            ->make(true);
         }
    
        $approved = applicationinfo::countApproved();
            $processing = applicationinfo::countProcessing();
         $validCount = notarydetails::approved()->count();
         $expiredCount = notarydetails::expired()->count();
        return view('DR.approved', compact('bread11','approved', 'processing', 'validCount', 'expiredCount'));
    
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
    public function published(Request $request)
    {
        $bread11="Published List";

        if ($request->ajax()) {
            $data = applicationinfo::with('personalinfo')->where('status', 'Published')->get();

           return DataTables::of($data)
        ->addColumn('name', function($row) {
            return $row->personalinfo->name ?? 'N/A';
        })
        ->addColumn('mobile', function($row) {
            return $row->personalinfo->mobile ?? 'N/A';
        })
        ->addColumn('license_status', function($row) {
            $notary = \App\Models\notarydetails::where('applicationid', $row->applicationid)->first();
            return ($notary && $notary->isExpired()) ? 'Expired' : 'Valid';
        })
        ->addColumn('action', function($row){
            $view = '<a href="'.route('viewlist', $row->applicationid).'" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>';
            $fileBack = '<a href="'.route('back111', $row->applicationid).'" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> File Back</a>';
            $delete = '<a href="'.route('deletelist', $row->applicationid).'" class="btn btn-danger btn-sm" onclick="event.preventDefault(); deleteConfirm(\''.route('sendto111', $row->applicationid).'\');"><i class="fa fa-trash"></i> Delete</a>';
            return $view . ' ' . $fileBack . ' ' . $delete;
        })
        ->rawColumns(['action']) // allow HTML in action column
        ->make(true);
            
            }
         $approved = applicationinfo::countApproved();
            $processing = applicationinfo::countProcessing();
         $validCount = notarydetails::approved()->count();
         $expiredCount = notarydetails::expired()->count();
        $application = applicationinfo::with('personalinfo')->where('status', 'Published')->get();
        return view('DR.published', compact('bread11','approved', 'processing', 'validCount', 'expiredCount'));
    
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
    public function expired(Request $request)
    {
        $bread11="Expired List";
        // First get the expired application IDs
        $expiredApplicationIds = notarydetails::expired()
        ->orderBy('natarydate', 'asc')
        ->pluck('applicationid');

        // Then get the applications with personal info
         
           if ($request->ajax()) {
        $data = applicationinfo::with('personalinfo')
        ->whereIn('applicationid', $expiredApplicationIds)
        ->get();
        return DataTables::of($data)
            ->addColumn('name', function($row){
                return $row->personalinfo->name ?? 'N/A';
            })
            ->addColumn('mobile', function($row){
                return $row->personalinfo->mobile ?? 'N/A';
            })
                        ->addColumn('action', function($row){
                $view = route('viewlist', $row->applicationid);
                $publish = route('publishedList', $row->applicationid);
                $back = route('back111', $row->applicationid);
                $delete = route('sendto111', $row->applicationid);

                $btn = '
                    <a href="'.$view.'" class="btn btn-info btn-sm mr-1">
                        <span class="fa fa-eye"></span> View
                    </a>
                    <a href="#" class="btn btn-success btn-sm mr-1" onclick="event.preventDefault(); doubleConfirm(\''.$publish.'\')">
                        <span class="fa fa-check"></span> Publish
                    </a>
                    <a href="'.$back.'" class="btn btn-secondary btn-sm mr-1">
                        <span class="fa fa-arrow-left"></span> File Back
                    </a>
                    <a href="#" class="btn btn-danger btn-sm mr-1" onclick="event.preventDefault(); deleteConfirm(\''.$delete.'\')">
                        <span class="fa fa-trash"></span> Delete
                    </a>
                    <a href="#" class="btn btn-warning btn-sm" onclick="event.preventDefault(); renewPrompt(\''.$row->applicationid.'\')">
                        <span class="fa fa-redo"></span> Renew
                    </a>
                ';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
         $validCount = notarydetails::approved()->count();
         $expiredCount = notarydetails::expired()->count();
        return view('DR.expired', compact('bread11', 'validCount', 'expiredCount'));
    
    }
    public function loginfo11()
    {
        $bread11="Loginfo List";
        $application = DB::table('loginfo')->select('*')->orderBy('created_at', 'desc')->paginate(10);
        return view('DR.logdr', compact('bread11', 'application'));     
    }
    public function getData(Request $request)
{
    $data = DB::table('loginfo')->select([
        'name', 'mail', 'mobile', 'ip', 'Location', 'Device', 'Browser', 'created_at'
    ]);
    if ($request->has('mobile') && !empty($request->mobile)) {
        $data->where('mobile', 'like', '%' . $request->mobile . '%');
    }
    if ($request->has('name') && !empty($request->name)) {
        $data->where('name', 'like', '%' . $request->name . '%');
    }

    return datatables()->of($data)->make(true);
}

    public function valid111(Request $request)
    {
        $bread11="Valid List";
        $expiredApplicationIds = notarydetails::approved()
        ->orderBy('natarydate', 'asc')
        ->pluck('applicationid');

        // Then get the applications with personal info
        
         if ($request->ajax()) {
$applications = applicationinfo::with('personalinfo')
        ->whereIn('applicationid', $expiredApplicationIds)
        ->get();
        return DataTables::of($applications)
            ->addColumn('name', function ($row) {
                return $row->personalinfo->name ?? 'N/A';
            })
            ->addColumn('mobile', function ($row) {
                return $row->personalinfo->mobile ?? 'N/A';
            })
            ->addColumn('action', function ($row) {
                $view = '<a href="' . route('viewlist', $row->applicationid) . '" class="btn btn-info btn-sm mr-1"><span class="fa fa-eye"></span> View</a>';
                $publish = '<a href="' . route('publishedList', $row->applicationid) . '" class="btn btn-success btn-sm mr-1" onclick="event.preventDefault(); doubleConfirm(\'' . route('publishedList', $row->applicationid) . '\');"><span class="fa fa-check"></span> Publish</a>';
                $back = '<a href="' . route('back111', $row->applicationid) . '" class="btn btn-secondary btn-sm"><span class="fa fa-arrow-left"></span> File Back</a>';
                $delete = '<a href="' . route('deletelist', $row->applicationid) . '" class="btn btn-danger btn-sm" onclick="event.preventDefault(); deleteConfirm(\'' . route('sendto111', $row->applicationid) . '\');"><span class="fa fa-trash"></span> Delete</a>';
                return $view . $publish . $back . $delete;
            })
            ->rawColumns(['action']) // Important to render HTML
            ->make(true);
    }

         $validCount = notarydetails::approved()->count();
         $expiredCount = notarydetails::expired()->count();
        return view('DR.valid111', compact('bread11','validCount', 'expiredCount'));
    
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
