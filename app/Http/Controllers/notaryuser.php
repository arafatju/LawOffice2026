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
    {
        return view('User.personal');
    }
    public function education()
    {
        return view('User.education');
    }
    public function documents()
    {
        return view('User.documents');

    }
    public function profile()
    {
        return view('User.profile');
        
    }
    public function notaryinfo()
    {
        return view('User.notaryinfo');
        
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
                      
        $info=applicationinfo::where('userid',Auth::user()->userid)->get();
             return view('User.NotaryDashboard',compact('info'));
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
