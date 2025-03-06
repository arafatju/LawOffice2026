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


    public function NotaryDashboard(Request $request){
                      
        $info=applicationinfo::where('userid',Auth::user()->userid)->get();
             return view('User.NotaryDashboard',compact('info'));
      }

      public function new11(Request $request){
        $lastId = applicationinfo::max('id');
        $appid='App'.$lastId+100;             
         applicationinfo::create([
             'userid'=>Auth::user()->userid,
             'status'=>'Draft',
             'applicationid'=>$appid,

         ]);
         return redirect(route('NotaryDashboard'));
      }
}
