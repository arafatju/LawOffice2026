<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LotInfo;
use Yajra\DataTables\Facades\DataTables;

class LotInfoController extends Controller
{
    public function index()
    {
        return view('Report.lots');
    }

    public function getData()
    {
        $lots = LotInfo::with('product')->select('lotinfo.*');

        return DataTables::of($lots)
            ->addColumn('product_name', function ($lot) {
                return $lot->product->name ?? 'N/A';
            })
            ->editColumn('created_at', function ($lot) {
            return $lot->created_at
                ? $lot->created_at->format('d M Y, h:i A') // ✅ format applied
                : 'N/A';
        })
            ->make(true);
    }
}

 
