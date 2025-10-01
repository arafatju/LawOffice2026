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
use App\Models\LotInfo;

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

class StoreSectionadmin extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
         $bread11='Data Entry Dashboard';
            $products = ProductInfo::all();
            $highest = DB::table('transaction')
        ->select('prcode', DB::raw('SUM(number) as total_delivered'))
        ->where('status', 'approved')
        ->groupBy('prcode')
        ->orderByDesc('total_delivered')
        ->first();

    $highestOffice = DB::table('transaction as t')
        ->join('users as u', 't.userid', '=', 'u.userid')
        ->join('personalinfo as p', 'u.userid', '=', 'p.userid')
        ->select('p.office', DB::raw('SUM(t.number) as total_delivered'))
        ->where('t.status', 'approved')
        ->groupBy('p.office')
        ->orderByDesc('total_delivered')
        ->first();

    $pendingCount = Transaction::where('status', 'pending')
        ->count();

   

    $product111 = null;
    $lastUserLog =DB::table('loginfo')->where('mail', Auth::user()->email)->orderBy('created_at', 'desc')->skip(1)->value('created_at');

    if ($highest) {
        $product111 = ProductInfo::where('prcode', $highest->prcode)->first();
    }

        return view('Storesection.sectiondash', compact('bread11', 'products', 'highest', 'product111', 'highestOffice', 'pendingCount', 'lastUserLog'));
    }

     public function updateByPrcode114(Request $request, $prcode)
{
    $data = $request->validate([
        'quantities' => 'required|array',
        'quantities.*' => 'integer|min:0',
    ]);

    // Loop over submitted allotments and update
    foreach ($data['quantities'] as $designation => $quantity) {
        Allotment::updateOrCreate(
            ['prcode' => $prcode, 'designation' => $designation],
            ['quantity' => $quantity]
        );
    }

    return redirect()->back()->with('success', 'Allotments updated successfully.');
}

   public function getByPrcode114($prcode)
{
    $allotments = Allotment::where('prcode', $prcode)->get(['designation', 'quantity']);
    return response()->json($allotments);
}

     public function updateQuantity114(Request $request, $prcode)
{
     $request->validate([
        'quantity' => 'required|integer|min:0',
        'purchase_type' => 'required|string|max:255',
        'purchase_date' => 'required|date', // Validate as date but store as VARCHAR
    ]);
    $product = ProductInfo::where('prcode', $prcode)->firstOrFail();
    $product->update(['quantity' => $request->quantity]);
      $maxId = LotInfo::max('id') ?? 0;
    $lotNumber = 'Lot' . ($maxId + 1);

    LotInfo::create([
        'quantity' => $request->quantity,
        'lotnumber' => $lotNumber, // 'Lot' + max ID
        'prcode' => $prcode, // Product code
        'purchaseddate' => $request->purchase_date, // Purchase date
        'purchasedtype' => $request->purchase_type, // Purchase type
    ]);

    ApplicationInfo::create([
      'userid'=>Auth::user()->userid,
        'action'=>'Product Updated',
        'role'=>'Data Entry',
        'month'=>now()->format('F'),
        'year'=>now()->format('Y'),
        ]);
    return redirect()->back()->with('success', 'Quantity updated successfully.');
}



}
