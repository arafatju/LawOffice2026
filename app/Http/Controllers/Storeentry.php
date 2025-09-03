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



public function datapending(Request $request){
$applications=$pendingByOffice = Transaction::with(['product', 'user.personalInfo'])
    ->where('status', 'pending')
    ->get(); 
    $offices = DB::table('personalinfo')->distinct()->pluck('office');
    $bread11='Data Entry Pending';
return view('Storedata.pending', compact('applications', 'offices', 'bread11'));
}
public function dataapproved(){
$approved=Transaction::where('status', 'approved')->get();
return view('Storedata.approved', compact('approved'));
}

}
