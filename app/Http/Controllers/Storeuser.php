<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;
use App\Models\User;
use App\Http\Controllers\ConverterController;
use App\Models\ProductInfo;
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

class Storeuser extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     public function StoreDashboard(Request $request){
                      
       // $info=applicationinfo::where('userid',Auth::user()->userid)->first();
         //   $notary = notarydetails::where('applicationid',$info->applicationid)->first();
       // session(['appid' => $info->applicationid]);
        $bread11="Dashboard";
             return view('Storeuser.StoreDashboard',compact('bread11'));
      }

      public function product(Request $request){
                      
       // $info=applicationinfo::where('userid',Auth::user()->userid)->first();
         //   $notary = notarydetails::where('applicationid',$info->applicationid)->first();
       // session(['appid' => $info->applicationid]);
        $bread11="Product";
             return view('Storeuser.product',compact('bread11'));
      }
      public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'prcode' => 'required|string|max:50',
        'quantity' => 'required|integer|min:1',
        'category' => 'nullable|string|max:50',
    ]);

    ProductInfo::create($request->only(['name', 'prcode', 'quantity', 'category']));

    return back()->with('success', 'Product inserted successfully.');
}

}
