<?php

namespace App\Http\Controllers;

 

use App\Models\LogInfo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LogInfoController extends Controller
{
    public function index()
    {
        return view('Report.loginfo');
    }

    public function getData()
    {
        $logs = LogInfo::select('id', 'name', 'mobile', 'mail', 'Device', 'Browser', 'ip', 'Location', 'created_at');

        return DataTables::of($logs)
            ->editColumn('created_at', function ($log) {
                return $log->created_at
                    ? $log->created_at->format('d M Y, h:i A') // ✅ Example: 08 Oct 2025, 03:42 PM
                    : 'N/A';
            })
            ->make(true);
    }
}

