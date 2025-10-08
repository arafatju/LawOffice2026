<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
   
    public function index()
    {
        return view('Report.data11');
    }

    public function getData(Request $request)
    {
        $transactions = Transaction::with(['user', 'product'])->select('transaction.*');

        return DataTables::of($transactions)
            ->addColumn('user_name', function ($row) {
                return $row->user->name ?? 'N/A';
            })
            ->addColumn('product_name', function ($row) {
                return $row->product->name ?? 'N/A';
            })
            
            ->make(true);
    }
}
