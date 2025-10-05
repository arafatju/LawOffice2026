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
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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

  public function officereport(Request $request)
{
    $bread11 = 'Office Report';
    
    // Get filter parameters from request
    $office = $request->input('office');
    $requestMonth = $request->input('month'); 
    $requestYear = $request->input('year');
    
    // Get all offices for dropdown
    $offices = DB::table('personalinfo')->distinct()->pluck('office');
    
    // Count number of offices
    $numberOfOffices = PersonalInfo::whereHas('user', function($q) {
        $q->where('role', 'userone');
    })
    ->distinct('office')
    ->count('office');
    
    // Get all months and years for dropdowns (these remain collections)
    $month = Transaction::where('status','approved')->distinct('month')->pluck('month');
    $year = Transaction::where('status','approved')->distinct('year')->pluck('year');
    
    // Highest product by delivery
    $highest = DB::table('transaction')
        ->select('prcode', DB::raw('SUM(number) as total_delivered'))
        ->where('status', 'approved')
        ->groupBy('prcode')
        ->orderByDesc('total_delivered')
        ->first();
    
    // Highest office by delivery
    $highestOffice = DB::table('transaction as t')
        ->join('users as u', 't.userid', '=', 'u.userid')
        ->join('personalinfo as p', 'u.userid', '=', 'p.userid')
        ->select('p.office', DB::raw('SUM(t.number) as total_delivered'))
        ->where('t.status', 'approved')
        ->groupBy('p.office')
        ->orderByDesc('total_delivered')
        ->first();
    
    // Pending count
    $pendingCount = Transaction::where('status','pending')->groupBy('trid')->count();
    
    // Out of stock products
    $threshold = 5;
    $outOfStockProducts = ProductInfo::where('quantity', '<=', $threshold)->get();
    
    // Get product info for highest product
    $product111 = null;
    if ($highest) {
        $product111 = ProductInfo::where('prcode', $highest->prcode)->first();
    }
    
    // Build the main query for applications/transactions
   

$pendingTransactions = Transaction::with(['product', 'user.personalInfo'])
    ->where('status', 'approved')
    ->when($request->filled('month'), function($query) use ($request) {
        return $query->where('month', $request->input('month'));
    })
    ->when($request->filled('year'), function($query) use ($request) {
        return $query->where('year', $request->input('year'));
    })
    ->when($request->filled('office'), function($query) use ($request) {
        return $query->whereHas('user.personalInfo', function($q) use ($request) {
            $q->where('office', $request->input('office'));
        });
    })
    ->paginate(10);


    
    /*Manual Pagination
    $perPage = 5;
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentItems = $applicationsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();
    
    $applications = new LengthAwarePaginator(
        $currentItems,
        $applicationsCollection->count(),
        $perPage,
        $currentPage,
        [
            'path' => $request->url(), 
            'query' => $request->query()
        ]
    );
    */  

    return view('Storemonitor.officereport', compact(
        'bread11', 'offices', 'pendingTransactions', 'highest', 'highestOffice', 'pendingCount',
        'outOfStockProducts', 'product111', 'numberOfOffices', 
        'office', 'month', 'year'
    ));
}
 
    public function dash11()
    {
        $bread11 = 'Admin Dashboard';

// Approved count
$approvedCount = Transaction::where('status', 'approved')
    
    ->count();

// Pending count  
$pendingCount = Transaction::where('status', 'pending')->groupBy('trid')
     ->count();

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
        $userCount= User::count('userid');
        $useradmin = User::where('role', 'usermonitor')->count('userid');
        $userone111= User::where('role', 'userone')->count('userid');
        $usersuper111= User::where('role', 'useradmin')->count('userid');
        $userdata111 = User::where('role', 'userdataentry')->count('userid');
        $lastLogin=DB::table('loginfo')->where('mail', Auth::user()->email)->orderBy('created_at', 'desc')->skip(1)->value('created_at');
        return view('Storemonitor.monitor11', compact('bread11', 'users','highestProduct','highestOffice','lowStockProducts','pendingCount','approvedCount','userCount','totalQuantity','categories','useradmin','userone111','usersuper111','userdata111','lastLogin'));
    }

    public function prtreport111(Request $request)
    {
        $office = $request->get('office');
        
        // Get applications for the view (same as your original query)
        $applications = ApplicationInfo::with([
            'user.personalInfo',
            'transactions.product'
        ])
        ->where('action', 'draft')
        ->when($office, function ($query) use ($office) {
            $query->whereHas('user.personalInfo', function ($q) use ($office) {
                $q->where('office', $office);
            });
        })
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->paginate(25);

        // Get unique offices for dropdown
        $offices = PersonalInfo::whereNotNull('office')
            ->distinct('office')
            ->pluck('office')
            ->filter()
            ->sort()
            ->values();
$bread11 = 'Office Report';
        return view('Storemonitor.productreport111', compact('applications', 'offices','bread11'));


     }

   public function report113(Request $request)
    {
        $office = $request->get('office');
        
        // Get applications for the view (same as your original query)
        $applications = ApplicationInfo::with([
            'user.personalInfo',
            'transactions.product'
        ])
        ->where('action', 'draft')
        ->when($office, function ($query) use ($office) {
            $query->whereHas('user.personalInfo', function ($q) use ($office) {
                $q->where('office', $office);
            });
        })
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->paginate(25);

$bread11 = 'Office Report';

        return view('Report.office', compact('applications',  'bread11'));
    }
}
