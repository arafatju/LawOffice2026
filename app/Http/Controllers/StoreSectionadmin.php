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

    $pendingCount = Transaction::where('status', 'pending')->groupBy('trid')
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

public function productapproved14(Request $request){

$transactions = ProductInfo::orderBy('quantity', 'asc')->get();

    $html = View::make('PDF.product', [
        'transactions' => $transactions,
         
    ])->render();

    $mpdf = new Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'P',
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 10,
        'margin_bottom' => 15,
        'margin_header' => 5,
        'margin_footer' => 5,
        'default_font_size' => 12,
        // Try these fonts in order of preference
        'default_font' => 'SolaimanLipi', // This usually works better than nikosh
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'tempDir' => storage_path('app/temp'), // Better temp directory
    ]);

    // Remove the extra CSS - let the template handle styling
    $mpdf->WriteHTML($html);
        $mpdf->SetFooter(' Page {PAGENO} Of  {nbpg}'); // "Page X of Y" in Bangla
    // Generate filename with timestamp
    $filename = 'approved_products_' . '_' . date('Y-m-d_H-i-s') . '.pdf';
    
    return $mpdf->Output($filename, 'I'); //




}
public static function getAllotmentDetails14($prcode,$userid)
{
     
    $userDesignation = PersonalInfo::where('userid', $userid)->first();

    $allotment = Allotment::where('prcode', $prcode)
        ->whereRaw('TRIM(designation) = ?', [$userDesignation->designation2])
        ->first();

   

    return  $allotment->quantity;
}

public static function getTransactionDetails14($prcode,$month,$userid)
{
    $transaction = Transaction::where('prcode', $prcode)
                    ->where('status', 'approved')
                    ->where('userid', $userid)
                    ->where('month', $month)
                    ->sum('number');

     

    return   $transaction;

}  
public static function getStockDetails14($prcode)
{
    $allotment = ProductInfo::where('prcode', $prcode)
        ->first();

    

    return $allotment->quantity; // Ensure stock is not negative
}
 
public function approveMultiple14(Request $request)
{
    $transactionId = $request->id;
    $numbers = $request->numbers; // array: [transaction_row_id => approved_qty]
    
    $approvedCount = 0;
    $failedItems = [];
    
    foreach ($numbers as $rowId => $number) {
        $transaction = Transaction::find($rowId);
        
        if (!$transaction) {
            $failedItems[] = [
                'rowId' => $rowId,
                'reason' => 'Transaction not found'
            ];
            continue;
        }
        
        $lastLot = LotInfo::where('prcode', $transaction->prcode)
            ->latest('id')
            ->first();
        
        $product = ProductInfo::where('prcode', $transaction->prcode)->first();
        
        if (!$product) {
            $failedItems[] = [
                'rowId' => $rowId,
                'prcode' => $transaction->prcode,
                'reason' => 'Product not found'
            ];
            continue;
        }
        
        // Check if sufficient quantity available
        if ($product->quantity < $number) {
            $failedItems[] = [
                'rowId' => $rowId,
                'prcode' => $transaction->prcode,
                'productName' => $product->name ?? 'Unknown',
                'requested' => $number,
                'available' => $product->quantity,
                'reason' => 'Insufficient stock'
            ];
            continue;
        }
        
        // 1. Update transaction
        $transaction->number = $number;
        $transaction->status = 'approved';
        $transaction->lotnumber = $lastLot ? $lastLot->lotnumber : null;
        $transaction->save();
        
        // 2. Deduct quantity from productinfo
        $product->quantity -= $number;
        if ($product->quantity < 0) {
            $product->quantity = 0;
        }
        $product->save();
        
        // 3. Insert into applicationinfo
        ApplicationInfo::create([
            'userid' => $transaction->userid,
            'action' => 'approved',
            'role' => $transaction->trid,
            'month' => now()->format('m'),
            'year' => now()->format('Y'),
        ]);
        
        $approvedCount++;
    }
    
    // Return response with detailed status
    if ($approvedCount > 0 && count($failedItems) === 0) {
        // All items approved successfully
        return response()->json([
            'success' => true,
            'approved' => $approvedCount,
            'message' => 'All transactions approved successfully'
        ]);
    } elseif ($approvedCount > 0 && count($failedItems) > 0) {
        // Partial success
        return response()->json([
            'success' => true,
            'partial' => true,
            'approved' => $approvedCount,
            'failed' => count($failedItems),
            'failedItems' => $failedItems,
            'message' => "Approved {$approvedCount} item(s). {count($failedItems)} item(s) failed."
        ]);
    } else {
        // All items failed
        return response()->json([
            'success' => false,
            'approved' => 0,
            'failed' => count($failedItems),
            'failedItems' => $failedItems,
            'message' => 'All transactions failed. Please check stock availability.'
        ], 422);
    }
}
public function dataapproved14(Request $request){
      $office = $request->input('office'); // for filtering

    $offices = DB::table('personalinfo')->distinct()->pluck('office'); // get distinct office
  
     
$query = Transaction::with(['user.personalInfo', 'product'])
    ->where('status', 'approved')->whereHas('product');

if ($office) {
    $query->whereHas('user.personalInfo', function ($q) use ($office) {
        $q->where('office', $office);
    });
}

$pendingTransactions = $query->get()->groupBy('trid');

$approved111= Transaction::where('status', 'approved')->count();
    $bread11='Data Entry Approved';
return view('Storesection.approved22', compact('pendingTransactions', 'offices', 'bread11', 'approved111'));


}
 public function dataprofile14(){
        $user=User::with('personalinfo')->where('userid',Auth::user()->userid)->firstOrFail();

        $bread11='Data Entry Profile';
        return view('Storesection.profile14', compact('bread11', 'user'));
    }
public function productpending1135($id){
         $highest =Transaction::where('userid',$id)
                   ->where('status','approved')
                    ->orderByDesc('number')
                    ->first();
 
        $product111=null;

        if ($highest) {
        $product111 = ProductInfo::where('prcode', $highest->prcode)->first();
    }

        $pendingTransactions = Transaction::where('status', 'pending')
            ->where('userid', $id)
            ->get();
            $totalaccepted=Transaction::where('status', 'approved')
            ->where('userid', $id)
            ->count();
$bread11='Pending Products';
    return view('Storesection.pendingshow14', compact('pendingTransactions','bread11','totalaccepted','highest','product111'));
}
public function datapending14(Request $request){
 
  $office = $request->input('office'); // for filtering

    $offices = DB::table('personalinfo')->distinct()->pluck('office'); // get distinct office
  
     
$query = Transaction::with(['user.personalInfo', 'product'])
    ->where('status', 'pending');

if ($office) {
    $query->whereHas('user.personalInfo', function ($q) use ($office) {
        $q->where('office', $office);
    });
}

$pendingTransactions = $query->get()->groupBy('userid');
 $pendingCount = Transaction::where('status', 'pending')->groupBy('trid')
        ->count();
 
    $bread11='Data Entry Pending';
return view('Storesection.pending14', compact('pendingTransactions', 'offices', 'bread11', 'pendingCount'));
}

}
