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
        return view('User.profile',compact('bread11'));
        
    }
    public function notaryinfo()
    {   $bread11="Notary";
        return view('User.notaryinfo',compact('bread11'));
        
    }
    public function docunotary(Request $request)
    {

        $request->validate([
            'applicationid' => 'required|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,pdf|max:1024',
            'signature' => 'nullable|file|mimes:jpg,jpeg,pdf|max:1024',
            'barcertificate' => 'nullable|file|mimes:jpg,jpeg,pdf|max:1024',
            'notarycertificate' => 'nullable|file|mimes:jpg,jpeg,pdf|max:1024',
            'nidcertificate' => 'nullable|file|mimes:jpg,jpeg,pdf|max:1024',
        ]);
    
        $appId = $request->applicationid;
        $data = [
            'applicationid' => $appId,
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image.' . $image->getClientOriginalExtension();
            Storage::disk('secure')->putFileAs("uploads/{$appId}", $image, $imageName);
            $data['image'] = $imageName;
        }
    
        if ($request->hasFile('signature')) {
            $signature = $request->file('signature');
            $signatureName = 'signature.' . $signature->getClientOriginalExtension();
            Storage::disk('secure')->putFileAs("uploads/{$appId}", $signature, $signatureName);
       
            $data['signature'] = $signatureName;
        }
        if ($request->hasFile('barcertificate')) {
            $barcertificate = $request->file('barcertificate');
            $barcertificateName = 'barcertificate.' . $barcertificate->getClientOriginalExtension();
            Storage::disk('secure')->putFileAs("uploads/{$appId}", $barcertificate, $barcertificateName);
            $data['barcertificate'] = $barcertificateName;    
        }
        if ($request->hasFile('notarycertificate')) {
            $notarycertificate = $request->file('notarycertificate');
            $notarycertificateName = 'notarycertificate.' . $notarycertificate->getClientOriginalExtension();
            Storage::disk('secure')->putFileAs("uploads/{$appId}", $notarycertificate, $notarycertificateName);
            $data['notarycertificate'] = $notarycertificateName;
        }
        if ($request->hasFile('nidcertificate')) {
            $nidcertificate = $request->file('nidcertificate');
            $nidcertificateName = 'nidcertificate.' . $nidcertificate->getClientOriginalExtension();
            Storage::disk('secure')->putFileAs("uploads/{$appId}", $nidcertificate, $nidcertificateName);
            $data['nidcertificate'] = $nidcertificateName;
        }
        documents::updateOrCreate(
            ['applicationid' => $appId],
            $data
        );
        info11::create([
            'name' => Auth::user()->name,
            'userid' => Auth::user()->userid, // or any valid user ID
            'applicationid' => $appId,
            'action' => 'Upload Document',
            'status' => 'Draft',
        ]);
        return back()->with('success', 'Sensitive files securely uploaded.');

    } 
    public function personal11(Request $request)
    {
        $validated = $request->validate([
            'applicationid' => 'required|string|max:100|unique:personalinfo,applicationid',
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

        personalinfo::create($validated);

        return redirect()->back()->with('success', 'Personal info submitted successfully!');
    }        
    
    public function NotaryDashboard(Request $request){
                      
        $info=applicationinfo::where('userid',Auth::user()->userid)->first();
        session(['appid' => $info->applicationid]);
        $bread11="Dashboard";
             return view('User.NotaryDashboard',compact('info','bread11'));
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
