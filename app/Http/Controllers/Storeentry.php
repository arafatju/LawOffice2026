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

        return view('Storedata.data11', compact('bread11', 'products'));
    }
    public function datahistory(){
        $bread11='Data Entry History';
        return view('Storedata.history11', compact('bread11'));

    }
    public function dataprofile(){
            $bread11='Data Entry Profile';
        return view('Storedata.profile13', compact('bread11'));
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
    $request->validate(['quantity' => 'required|integer|min:0']);
    $product = ProductInfo::where('prcode', $prcode)->firstOrFail();
    $product->update(['quantity' => $request->quantity]);
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
$bread11='Pending Products';
    return view('Storedata.pendingshow', compact('pendingTransactions','bread11'));
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
    $transactionId = $request->id; // not used directly if multiple rowIds
    $numbers = $request->numbers; // array: [transaction_row_id => approved_qty]

    foreach ($numbers as $rowId => $number) {
        $transaction = Transaction::find($rowId);

        if ($transaction) {
            // 1. Update transaction
            $transaction->number = $number;
            $transaction->status = 'approved';
            $transaction->save();

            // 2. Deduct quantity from productinfo
            $product = ProductInfo::where('prcode', $transaction->prcode)->first();
            if ($product) {
                $product->quantity -= $number;  // deduct approved qty
                if ($product->quantity < 0) {
                    $product->quantity = 0; // prevent negative stock
                }
                $product->save();
            }

            // 3. Insert into applicationinfo
            ApplicationInfo::create([
                'userid' => $transaction->userid,
                'action' => 'approved',
                'role'   => $transaction->trid, // e.g. "Laptop (3)"
                'month'  => now()->format('m'),
                'year'   => now()->format('Y'),
            ]);
        }
    }

    return response()->json(['success' => true]);
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

$pendingTransactions = $query->get()->groupBy('userid');

 
    $bread11='Data Entry Pending';
return view('Storedata.pending', compact('pendingTransactions', 'offices', 'bread11'));
}




public function dataapproved(Request $request){
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


    $bread11='Data Entry Approved';
return view('Storedata.approved', compact('pendingTransactions', 'offices', 'bread11'));


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
public function destroy11($id)
{
    $transaction = Transaction::findOrFail($id);
    $transaction->delete();

    return redirect()->back()->with('success', 'Transaction deleted successfully!');
}

}
