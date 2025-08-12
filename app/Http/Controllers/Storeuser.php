<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;
use App\Models\User;
use App\Http\Controllers\ConverterController;
use App\Models\ProductInfo;
 
use App\Models\info11;
use App\Models\Allotment;
use App\Models\documents;
use App\Models\devicedetails;
use App\Models\ApplicationInfo;

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
        $products=ProductInfo::all();
       
             return view('Storeuser.product',compact('bread11','products'));
      }
     public function admin11(){
          $bread11="Admin User Management";
     $users=User::all();
        return view('Storeuser.admin11',compact('bread11','users'));
     }
public function destroyuser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }
public function updateRole(Request $request, $id)
{
    $request->validate([
        'role' => 'required|string'
    ]);

    $user = User::findOrFail($id);
    $user->role = $request->role;
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'User role updated successfully.'
    ]);
}
public function userdash(){
    $bread11="Dashboard";
      $categories = ProductInfo::whereNotNull('category')
                        ->distinct()
                        ->orderBy('category')
                        ->pluck('category'); // returns a Collection

        // Pass to the view that caused the error
        return view('Storeuser.userdash', compact('bread11','categories'));
 }
public function updatePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
     public function accepted11(){
        $bread11="Accepted User Management";
     $users=User::all();
        return view('Storeuser.accepted11',compact('bread11','users'));
     }
     public function updateQuantity(Request $request, $prcode)
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

     
     
      public function destroyByType($type, $prcode)
{
    switch ($type) {
        case 'product':
            $model = ProductInfo::class;
            break;
        case 'allotment':
            $model = AllotmentInfo::class;
            break;
        // add more types here as needed
        default:
            abort(404, 'Invalid type');
    }

    $record = $model::where('prcode', $prcode)->firstOrFail();
    $record->delete();
    ApplicationInfo::create([
      'userid'=>Auth::user()->userid,
        'action'=>'Product Deleted',
        'role'=>'Data Entry',
        'month'=>now()->format('F'),
        'year'=>now()->format('Y'),
        ]);
    return redirect()->back()->with('success', ucfirst($type).' deleted successfully.');
}
public function user11(){
     $bread11="User Management";
     $users=User::all();
      return view('Storeuser.user11',compact('bread11','users'));

}
public function updateByPrcode(Request $request, $prcode)
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

   public function getByPrcode($prcode)
{
    $allotments = Allotment::where('prcode', $prcode)->get(['designation', 'quantity']);
    return response()->json($allotments);
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
   $designations = ['উপদেষ্টা মহোদয়', 'সচিব', 'অতিরিক্ত সচিব', 'যুগ্ন সচিব', 'উপ সচিব','সিনিয়র সহকারী সচিব','সহকারী সচিব'];

foreach ($designations as $designation) {
    Allotment::create([
        'prcode' => $request['prcode'],
        'designation' => $designation,
        'quantity' => 1,
    ]);
}
 
    ApplicationInfo::create([
      'userid'=>Auth::user()->userid,
        'action'=>'Product Creation',
        'role'=>'Data Entry',
        'month'=>now()->format('F'),
        'year'=>now()->format('Y'),
        ]);
    

    return back()->with('success', 'Product Created successfully.');
}

public function getProductsByCategory($category)
    {
        $products = ProductInfo::where('category', $category)
            ->select('prcode', 'name')
            ->get();

        return response()->json($products);
    }

    public function getProductQuantity($prcode)
    {
        $product = ProductInfo::where('prcode', $prcode)->first();
        $userDesignation = Auth::user()->designation ?? null;

        $allotment = Allotment::where('prcode', $prcode)
            ->where('designation', $userDesignation)
            ->first();

        $warning = null;
        if ($allotment && $product) {
            if ($product->quantity < $allotment->quantity) {
                $warning = "Warning: Available quantity is less than your allotment requirement ({$allotment->quantity}).";
            }
        }

        return response()->json([
            'quantity' => $product->quantity ?? 0,
            'allotment_warning' => $warning
        ]);
    }

    public function saveDraft(Request $request)
    {
        // Save draft to DB or session (example here for DB)
        // $request->draft is an array of product + quantity
        // Your save logic here...

        return response()->json(['message' => 'Draft saved successfully!']);
    }

    public function submitProduct(Request $request)
    {
        $product = ProductInfo::where('prcode', $request->prcode)->first();
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        // Example logic: reduce quantity
        if ($product->quantity >= $request->quantity) {
            $product->quantity -= $request->quantity;
            $product->save();

            return response()->json(['success' => true, 'message' => 'Product submitted successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Not enough quantity available.']);
        }
    }

}
