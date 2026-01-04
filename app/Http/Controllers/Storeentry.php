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

class Storeentry extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function datadash()
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

    $pendingCount = Transaction::where('status', 'pending')->distinct('trid')
        ->count();

   

    $product111 = null;
    $lastUserLog =DB::table('loginfo')->where('mail', Auth::user()->email)->orderBy('created_at', 'desc')->skip(1)->value('created_at');

    if ($highest) {
        $product111 = ProductInfo::where('prcode', $highest->prcode)->first();
    }

        return view('Storedata.data11', compact('bread11', 'products', 'highest', 'product111', 'highestOffice', 'pendingCount', 'lastUserLog'));
    }
    public function datahistory(){
        $bread11='Data Entry History';
        return view('Storedata.history11', compact('bread11'));

    }
    public function dataprofile(){
        $user=User::with('personalinfo')->where('userid',Auth::user()->userid)->firstOrFail();

        $bread11='Data Entry Profile';
        return view('Storedata.profile13', compact('bread11', 'user'));
    }
    public function updateByPrcode111(Request $request, $prcode)
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

   public function getByPrcode111($prcode)
{
    $allotments = Allotment::where('prcode', $prcode)->get(['designation', 'quantity']);
    return response()->json($allotments);
}

     public function updateQuantity111(Request $request, $prcode)
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

public function productpending1124($id){

        $pendingTransactions = Transaction::where('status', 'pending')
            ->where('userid', $id)
            ->get();

        $pending= Transaction::where('status','approved')->where('userid',$id)
                              ->sum('number'); 

$bread11='Pending Products';
    return view('Storedata.pendingshow', compact('pendingTransactions','bread11','pending'));
}
public static function getAllotmentDetails($prcode,$userid)
{
     
    $userDesignation = PersonalInfo::where('userid', $userid)->first();

    $allotment = Allotment::where('prcode', $prcode)
        ->whereRaw('TRIM(designation) = ?', [$userDesignation->designation2])
        ->first();

   

    return  $allotment->quantity;
}

public static function getTransactionDetails($prcode,$month,$userid)
{
    $transaction = Transaction::where('prcode', $prcode)
                    ->where('status', 'approved')
                    ->where('userid', $userid)
                    ->where('month', $month)
                    ->sum('number');

     

    return   $transaction;

}  
public static function getStockDetails($prcode)
{
    $allotment = ProductInfo::where('prcode', $prcode)
        ->first();

    

    return $allotment->quantity; // Ensure stock is not negative
}
 
public function approveMultiple11(Request $request)
{
    $transactionId = $request->id;
    $numbers = $request->numbers; // array: [transaction_row_id => new_qty]
    
    $updatedCount = 0;
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
        
        // Simply update the transaction number (no approval, no stock deduction)
        try {
            $transaction->number = $number;
            $transaction->save();
            $updatedCount++;
        } catch (\Exception $e) {
            $failedItems[] = [
                'rowId' => $rowId,
                'prcode' => $transaction->prcode ?? 'Unknown',
                'reason' => 'Update failed: ' . $e->getMessage()
            ];
        }
    }
    
    // Return response
    if ($updatedCount > 0 && count($failedItems) === 0) {
        // All items updated successfully
        return response()->json([
            'success' => true,
            'updated' => $updatedCount,
            'message' => 'All transactions updated successfully'
        ]);
    } elseif ($updatedCount > 0 && count($failedItems) > 0) {
        // Partial success
        return response()->json([
            'success' => true,
            'partial' => true,
            'updated' => $updatedCount,
            'failed' => count($failedItems),
            'failedItems' => $failedItems,
            'message' => "Updated {$updatedCount} item(s). {count($failedItems)} item(s) failed."
        ]);
    } else {
        // All items failed
        return response()->json([
            'success' => false,
            'updated' => 0,
            'failed' => count($failedItems),
            'failedItems' => $failedItems,
            'message' => 'All transactions failed to update.'
        ], 422);
    }
}

public function datapending(Request $request){
 
  $office = $request->input('office'); // for filtering

    $offices = DB::table('personalinfo')->distinct()->pluck('office'); // get distinct office
  
     
$query = Transaction::with(['user.personalInfo', 'product'])
    ->where('status', 'pending');

if ($office) {
    $query->whereHas('user.personalInfo', function ($q) use ($office) {
        $q->where('office', $office);
    });
}
 $transactions = $query->orderBy('created_at', 'desc')->get();
$pendingTransactions = $transactions->groupBy('trid');
 $pendingCount = Transaction::where('status', 'pending')->distinct('trid')
        ->count();
 
    $bread11='Data Entry Pending';
return view('Storedata.pending', compact('pendingTransactions', 'offices', 'bread11', 'pendingCount'));
}

public function dataarchive(Request $request){
 
    try {
         
        
        // Get distinct offices
        $offices = DB::table('personalinfo')
            ->distinct()
            ->whereNotNull('office')
            ->pluck('office');
        
        // Build query with proper relationships
        $query = Transaction::with(['user.personalInfo', 'product'])
            ->where('status', 'archived')
            ->whereHas('product') // Ensure product exists
            ->whereHas('user'); // Ensure user exists
        
        // Apply office filter if provided
        
        
      // Get transactions and group by updated_at
    $transactions = $query->orderBy('updated_at', 'desc')->get();
    
    // Group by updated_at (date only, not timestamp)
     $pendingTransactions = $transactions->groupBy('trid');

        // Count approved transactions
        $approved111 = Transaction::where('status', 'archived')->count();
        
        $bread11 = 'Data Entry Approved';
        
        return view('Storedata.archive', compact(
            'pendingTransactions', 
            'offices', 
            'bread11', 
            'approved111'
        ));
        
    } catch (\Exception $e) {
        \Log::error('Error in dataapproved: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return back()->withErrors([
            'error' => 'An error occurred while loading the data. Please try again.'
        ]);
    }




}


public function dataapproved(Request $request){
      try {
        $office = $request->input('office');
        
        // Get distinct offices
        $offices = DB::table('personalinfo')
            ->distinct()
            ->whereNotNull('office')
            ->pluck('office');
        
        // Build query with proper relationships
        $query = Transaction::with(['user.personalInfo', 'product'])
            ->where('status', 'approved')
            ->whereHas('product') // Ensure product exists
            ->whereHas('user'); // Ensure user exists
        
        // Apply office filter if provided
        if ($office) {
            $query->whereHas('user.personalInfo', function ($q) use ($office) {
                $q->where('office', $office);
            });
        }
        
        // Get transactions and group by trid
        $transactions = $query->orderBy('created_at', 'desc')->get();
        
        // Group by trid (transaction ID)
        $pendingTransactions = $transactions->groupBy('trid');
        
        // Count approved transactions
        $approved111 = Transaction::where('status', 'approved')->count();
        
        $bread11 = 'Data Entry Approved';
        
        return view('Storedata.approved', compact(
            'pendingTransactions', 
            'offices', 
            'bread11', 
            'approved111'
        ));
        
    } catch (\Exception $e) {
        \Log::error('Error in dataapproved: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return back()->withErrors([
            'error' => 'An error occurred while loading the data. Please try again.'
        ]);
    }

 

}
public function productapproved(Request $request){

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

public function officeapproved($id, $userid)
{
     $user = User::where('userid', $userid)->firstOrFail();
    $transactions = Transaction::with('product')
        ->where('trid', $id)
        ->where('status', 'approved')
        ->orderBy('created_at', 'desc')  // Order by newest first
        ->get();
      
       Transaction::where('trid', $id)
    ->where('status', 'approved')
    ->update(['status' => 'archived']);
     
    $html = View::make('PDF.approved_office', [
        'transactions' => $transactions,
        'user' => $user,
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
    
    // Generate filename with timestamp
    $filename = 'approved_products_' . $user->userid . '_' . date('Y-m-d_H-i-s') . '.pdf';
    
    return $mpdf->Output($filename, 'I'); // 


}

public function officeapproved12($id, $userid)
{
     $user = User::where('userid', $userid)->firstOrFail();
    $transactions = Transaction::with('product')
        ->where('trid', $id)
        ->where('status', 'archived')
        ->orderBy('created_at', 'desc')  // Order by newest first
        ->get();
      
       
     
    $html = View::make('PDF.approved_office', [
        'transactions' => $transactions,
        'user' => $user,
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
    
    // Generate filename with timestamp
    $filename = 'archived_products_' . $user->userid . '_' . date('Y-m-d_H-i-s') . '.pdf';
    
    return $mpdf->Output($filename, 'I'); // 


}
public function destroy11($id)
{
    $transaction = Transaction::findOrFail($id);
    $transaction->delete();

    return redirect()->back()->with('success', 'Transaction deleted successfully!');
}

}
