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

class Pdfpermission111 extends Controller
{
     
    public function officereport1212(Request $request){
    
    $month = $request->input('month');
        $year = $request->input('year');
        $office = $request->input('office');
        
  $transactions = Transaction::with(['product', 'user.personalInfo'])
        ->where('status', 'approved')
        ->when($month, function($query, $month) {
            return $query->where('month', $month);
        })
        ->when($year, function($query, $year) {
            return $query->where('year', $year);
        })
        ->when($office, function($query, $office) {
            return $query->whereHas('user.personalInfo', function($q) use ($office) {
                $q->where('office', $office);
            });
        })
        ->get();

    $html = View::make('PDF.office', [
        'transactions' => $transactions,
        'office' => $office,
        'month' => $month,
        'year' => $year,
         
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

     $mpdf->WriteHTML($html);
        $mpdf->SetFooter(' Page {PAGENO} Of  {nbpg}'); // "Page X of Y" in Bangla
    // Generate filename with timestamp
    $filename = 'approved_products_' . '_' . date('Y-m-d_H-i-s') . '.pdf';

    return $mpdf->Output($filename, 'I');
    }
    
    public function productapproved111(Request $request){

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
public function userapproved111()
    {
        $bread11 = 'User Approved Report';
        $applications = User::with(['personalInfo'])
            ->get();

        $html = View::make('PDF.userapproved', [
            'transactions' => $applications,
            'bread11' => $bread11,
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

        $mpdf->WriteHTML($html);
        $mpdf->SetFooter(' Page {PAGENO} Of  {nbpg}'); // "Page X of Y" in Bangla
        // Generate filename with timestamp
        $filename = 'user_approved_report_' . '_' . date('Y-m-d_H-i-s') . '.pdf';

        return $mpdf->Output($filename, 'I');
    }

}
