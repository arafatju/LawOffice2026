<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Storeentry extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dataentry11()
    {
        $bread11='Data Entry Dashboard';
        return view('Storedata.data11', compact('bread11'));
    }
}
