<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;
use App\Models\User;
use App\Http\Controllers\ConverterController;
use App\Models\ProductInfo;
  use App\Models\PersonalInfo;
use App\Models\info11;
use App\Models\Allotment;
use App\Models\Transaction;
use App\Models\devicedetails;
use App\Models\ApplicationInfo;

use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\File;
 use Illuminate\Support\Facades\Cache;
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

class Storeadminmonitor extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function productreport()
    {
        $bread11 = 'Product Report';
        $total = ProductInfo::count('prcode');
$products = ProductInfo::orderBy('quantity', 'asc')->get();
        $highestProduct = Transaction::select('prcode')
        ->selectRaw('SUM(number) as total_quantity')
        ->selectRaw('COUNT(DISTINCT trid) as orders_count')
        ->where('status', 'approved')
        ->with('product')
        ->groupBy('prcode')
        ->orderByDesc('total_quantity')
        ->first();
        $threshold = 20; // e.g., less than 5 units

$lowStockProducts = ProductInfo::where('quantity', '<=', $threshold)->get();
        return view('Storemonitor.productreport', compact('bread11', 'highestProduct', 'total', 'lowStockProducts', 'products'));
    }
     
  public function officereport()
    {
        $bread11 = 'Office Report';
        return view('Storemonitor.officereport', compact('bread11'));
    }

    public function dash11()
    {
        $bread11 = 'Admin Dashboard';

// Approved count
$approvedCount = Transaction::where('status', 'approved')
    ->distinct('trid')
    ->count('trid');

// Pending count  
$pendingCount = Transaction::where('status', 'pending')
     ->distinct('trid')
    ->count('trid');

// Total approved quantity
$totalQuantity = Transaction::where('status', 'approved')
    ->sum('number'); 

    $highestProduct = Transaction::select('prcode')
        ->selectRaw('SUM(number) as total_quantity')
        ->selectRaw('COUNT(DISTINCT trid) as orders_count')
        ->where('status', 'approved')
        ->with('product')
        ->groupBy('prcode')
        ->orderByDesc('total_quantity')
        ->first();
    $highestOffice = Transaction::select('personalinfo.office')
    ->selectRaw('SUM(transaction.number) as total_quantity')
    ->join('users', 'users.userid', '=', 'transaction.userid')
    ->join('personalinfo', 'personalinfo.userid', '=', 'users.userid')
    ->where('transaction.status', 'approved')
    ->groupBy('personalinfo.office')
    ->orderByDesc('total_quantity')
    ->first();
$threshold = 20; // e.g., less than 5 units

$lowStockProducts = ProductInfo::where('quantity', '<=', $threshold)->get();


        // Access: $highestProduct->product->name and $highestProduct->total_quantity
      $categories = ProductInfo::whereNotNull('category')
                        ->distinct()
                        ->orderBy('category')
                        ->pluck('category'); // returns a Collection

        $users = User::with('personalinfo')->get();
        return view('Storemonitor.monitor11', compact('bread11', 'users','highestProduct','highestOffice','lowStockProducts','pendingCount'));
    }
}
