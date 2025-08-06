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

class notaryuser extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function personal()
    {   $bread11="Personal";
        return view('User.personal',compact('bread11'));
    }
    public function education()
    {    $bread11="Education";
        return view('User.education',compact('bread11'));
    }
    public function documents()
    {   $bread11="Documents";
        return view('User.documents',compact('bread11'));

    }
    public function profile()
    {   $bread11="Profile";

        $personalInfo=personalinfo::where('applicationid',session('appid'))->first();
        $educationInfo=education::where('applicationid',session('appid'))->first();
        $documents=documents::where('applicationid',session('appid'))->first();
        $notaryInfo=notarydetails::where('applicationid',session('appid'))->first();
        return view('User.profile',compact('bread11','personalInfo','educationInfo','documents','notaryInfo'));
        
    }
    public function notaryinfo()
    {   $bread11="Notary";
        return view('User.notaryinfo',compact('bread11'));
        
    }
    public function docunotary(Request $request)
{
    $request->validate([
        'applicationid' => 'required|string',
        'image' => 'nullable|file|mimes:jpg,jpeg|max:1024',
        'signature' => 'nullable|file|mimes:pdf|max:1024',
        'barcertificate' => 'nullable|file|mimes:pdf|max:1024',
        'notarycertificate' => 'nullable|file|mimes:pdf|max:1024',
        'nidcertificate' => 'nullable|file|mimes:pdf|max:1024',
    ]);

    $appId = $request->applicationid;
    $data = [
        'applicationid' => $appId,
    ];

    // Get existing document record to check for old files
    $existingDocument = documents::where('applicationid', $appId)->first();

    // Define file types to process
    $fileTypes = ['image', 'signature', 'barcertificate', 'notarycertificate', 'nidcertificate'];

    foreach ($fileTypes as $fileType) {
        if ($request->hasFile($fileType)) {
            // Delete old file if it exists
            if ($existingDocument && $existingDocument->$fileType) {
                $oldFilePath = "{$appId}/" . $existingDocument->$fileType;
                if (Storage::disk('secure')->exists($oldFilePath)) {
                    Storage::disk('secure')->delete($oldFilePath);
                }
            }

            // Upload new file
            $file = $request->file($fileType);
            $fileName = $fileType . '.' . $file->getClientOriginalExtension();
            Storage::disk('secure')->putFileAs("{$appId}", $file, $fileName);
            $data[$fileType] = $fileName;
        }
    }

    documents::updateOrCreate(
        ['applicationid' => $appId],
        $data
    );

    info11::create([
        'name' => Auth::user()->name,
        'userid' => Auth::user()->userid,
        'applicationid' => $appId,
        'action' => 'Upload Document',
        'status' => 'Draft',
    ]);

    return back()->with('success', 'Sensitive files securely uploaded.');
}
    
    public function educationstore(Request $request)
    {
        $validated = $request->validate([
            'applicationid' => 'required',
            'sscpass' => 'required|string|max:10',
            'hscpass' => 'required|string|max:10',
            'edu1' => 'required|string|max:10',
            'edu2' => 'nullable|string|max:10',
        ]);

        education::updateOrCreate(
            ['applicationid' => $validated['applicationid']],
            $validated
        );
        info11::create([
            'name' => Auth::user()->name,
            'userid' => Auth::user()->userid, // or any valid user ID
            'applicationid' => $validated['applicationid'],
            'action' => 'Education Info',
            'status' => 'Draft',
        ]);

        return redirect()->back()->with('success', 'Education info submitted successfully!');
    }
    public function sendto111($id)
    {
        $status=applicationinfo::where('applicationid',$id)->first();
        if($status->status=='Draft'){

            applicationinfo::where('applicationid',$id)->update(['status'=>'Processing']);
            info11::create([
                'name' => Auth::user()->name,
                'userid' => Auth::user()->userid, // or any valid user ID
                'applicationid' => $id,
                'action' => 'Send to Processing',
                'status' => 'Processing',
            ]);
            return redirect(route('NotaryDashboard'))->withInfo('  আপনার ফাইলটি  প্রক্রিয়াধীন আছে। ');  
    
    }
        else 
        {
            return redirect(route('NotaryDashboard'))->withInfo('  আপনার ফাইলটি ইতোমধ্যে পাঠান হয়েছে ।  প্রক্রিয়াধীন আছে। ');  
        }
    }
    
    public function notarystore(Request $request)
    {
        $validated = $request->validate([
           'applicationid' => 'required',
            'barnumber' => 'nullable|string|max:100',
            'bardate' => 'nullable|date',
            'lawnumber' => 'nullable|string|max:100',
            'lawdate' => 'nullable|date',
            'exp' => 'nullable|string|max:100',
            'notarysarok' => 'nullable|string|max:100',
            'natarydate' => 'nullable|date',
            'area' => 'nullable|string|max:255',
            'renewdate' => 'nullable|date',
            'lastrenewdate' => 'nullable|date',
        ]);
         
        notarydetails::updateOrCreate(
            ['applicationid' => $validated['applicationid']],
            $validated
        );
        info11::create([
            'name' => Auth::user()->name,
            'userid' => Auth::user()->userid, // or any valid user ID
            'applicationid' => $validated['applicationid'],
            'action' => 'Notary Info',
            'status' => 'Draft',
        ]);

        return redirect()->back()->with('success', 'Notary info submitted successfully!');
    }
    public function personal11(Request $request)
    {
        $validated = $request->validate([
            'applicationid' => 'required|string|max:100 ',
            'mobile'        => 'required|string|min:10|max:15',
            'name'          => 'required|string|max:255',
            'father'        => 'required|string|max:255',
            'mother'        => 'required|string|max:255',
            'dob'           => 'required|date',
            'permanent'     => 'required|string|max:255',
            'nid'           => 'required|string|max:20|unique:personalinfo,nid',
            'district'      => 'required|string|max:100',
            'present'       => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:personalinfo,email',
        ]);

        personalinfo::updateOrCreate(
            ['applicationid' => $validated['applicationid']],
            $validated
        );
        info11::create([
            'name' => Auth::user()->name,
            'userid' => Auth::user()->userid, // or any valid user ID
            'applicationid' => $validated['applicationid'],
            'action' => 'Personal Info',
            'status' => 'Draft',
        ]);

        return redirect()->back()->with('success', 'Personal info submitted successfully!');
    }        
    
    public function NotaryDashboard(Request $request){
                      
        $info=applicationinfo::where('userid',Auth::user()->userid)->first();
            $notary = notarydetails::where('applicationid',$info->applicationid)->first();
        session(['appid' => $info->applicationid]);
        $bread11="ড্যাশবোর্ড";
             return view('User.NotaryDashboard',compact('info','bread11','notary'));
      }
      public function edituser($id){
        session(['appid' => $id]);
        $status=applicationinfo::where('applicationid',$id)->first();
        if($status->status=='Draft'){
            return redirect(route('NotaryDashboard'))->withInfo('দুঃখিত আপনার ফাইলটি প্রক্রিয়াধীন আছে। ');  
    
    }
        else 
        {
            return redirect(route('NotaryDashboard'))->withInfo('দুঃখিত আপনার ফাইলটি প্রক্রিয়াধীন আছে। ');  
        }
      }
      public function new11(Request $request){
        $lastId = applicationinfo::max('id');
        $appid='App'.$lastId+100;             
         applicationinfo::create([
             'userid'=>Auth::user()->userid,
             'status'=>'Draft',
             'applicationid'=>$appid,

         ]);
         return redirect(route('NotaryDashboard'))->withSuccess('নতুন আবেদনপত্র  তৈরি করা হয়েছে । ');
      }
}
