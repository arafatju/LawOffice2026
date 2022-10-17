<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
   public function stat(){
    return view('stat');
   }
   public function motamot(){
      return view('motamot');
     }
     public function details($id){
      $bivag=$id;
      return view('details',compact('bivag'));
     }
}
