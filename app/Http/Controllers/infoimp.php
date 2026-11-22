<?php

namespace App\Http\Controllers;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;
use App\Models\User;
use App\Http\Controllers\ConverterController;
  
 
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
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
 
use Carbon\Carbon;

class infoimp extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    
    public function index(){

        return view('auth.login');
    }
      
     
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
