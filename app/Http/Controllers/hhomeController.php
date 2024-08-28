<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ConverterController;
use DB;


class hhomeController extends Controller
{
    public function index()
    {
        return view('tottho.nav1');
    } 
    public function bivag($id)
    {
        
        $tt1=" AND T <> 'Hindu' AND T <> 'Special' ";
        $tt2=" AND T='Hindu' ";
        $tt3=" AND T='Special' ";
        if ($id==1) { session(['religion' =>'1']);}
        else if ($id==2) { session(['religion' =>'2']);}
        else if ($id==3) { session(['religion' =>'3']);}
        else if ($id==4) { session(['religion' =>'4']);}
        


 

        return view('tottho.bivag');
    }

	public function cityward(Request $request){
        $city=$request->input('city');
        if($city=='ঢাকা উত্তর সিটি কর্পোরেশন'||$city=='ঢাকা দক্ষিণ সিটি কর্পোরেশন') $nametable='Dhaka';
       elseif($city=='চট্টগ্রাম সিটি কর্পোরেশন') $nametable='chatogram';
       elseif($city=='রাজশাহী সিটি কর্পোরেশন') $nametable='rajshahi';
       elseif($city=='খুলনা সিটি কর্পোরেশন') $nametable='khulna';
       elseif($city=='ময়মনসিংহ সিটি কর্পোরেশন') $nametable='maymensingh';
       elseif($city=='বরিশাল সিটি কর্পোরেশন') $nametable='barishal';
       elseif($city=='রংপুর সিটি কর্পোরেশন') $nametable='rangpu';
       elseif($city=='সিলেট সিটি কর্পোরেশন') $nametable='sylhet';
       elseif($city=='কুমিল্লা সিটি কর্পোরেশন') $nametable='comilla';
       elseif($city=='নারায়ণগঞ্জ সিটি কর্পোরেশন') $nametable='narayanganj';
       elseif($city=='গাজীপুর সিটি কর্পোরেশন') $nametable='gazipur';


 
  	$ward124=DB::table($nametable)
			->select('Union_Ward')
 			->where('Pourosova_City_Corporation','=',$city)
 			->get();

			 $ward125=DB::table($nametable)
			 ->select('District')
			  ->where('Pourosova_City_Corporation','=',$city)
			  ->distinct()
			  ->get();
			  
			  
			 session(['table' =>$nametable]);
			 session(['city' =>$city]);
			 
			 session(['jela' =>$ward125]);

		return view('tottho.cityward',compact('ward124'));


	}
	public function city(){
 
 
        

		return view('tottho.city');

	}
    public function jela(Request $request){

       		$bivag=$request->input('bivag');
        
            return view('tottho.jela', compact('bivag'));

         
		
 
		
    }

public function person($odhi){

	$table=session('table');
	$jela=session('jela');
	$thana=session('thana');
	$person=DB::table($table)
			->select('*')
			->where('District','=',$jela)
			->where('Thana','=',$thana)
			->where('Union_Ward','=',decrypt($odhi))
			->get();
    
	return view('last.person',compact('person'));
		}

		public function person2($odhi){

			$table=session('table');
			$jela=session('jela');
			$pourosova=session('thana');
			$person=DB::table($table)
					->select('*')
					->where('District','=',$jela)
					->where('Pourosova_City_Corporation','=',$pourosova)
					->where('Union_Ward','=',decrypt($odhi))
					->get();
		
			return view('last.person2',compact('person'));
				}
		        public function onu(){

					return view('khujo.onu');
				}
				public function person3($odhi){

					$table=session('table');
					$city=session('city');
 					$person=DB::table($table)
							->select('*')
							->where('Pourosova_City_Corporation','=',$city)
 							->where('Union_Ward','=',decrypt($odhi))
							->get();
				
					return view('last.person3',compact('person'));
						}
				


	public function upojela($jela){
		$nametable = (new ConverterController)->name2table($jela);
		session(['table' =>$nametable]);
		session(['jela' =>$jela]);

		$vt=session('religion');
		if($vt=='1'){
         $number=DB::table($nametable)
		        ->select('Thana')
                ->where('District','=',$jela)
				->where('Pourosova_City_Corporation','=',NULL)
				->distinct()
                ->get();
			}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			     ->select('Thana')
                ->where('District','=',$jela)
				->where('Report_Sent_By','<>','Hindu')
			    ->where('Report_Sent_By','<>','Special')
				->where('Pourosova_City_Corporation','=',NULL)
				->distinct()
                ->get();
		 
		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
			->select('Thana')
			->where('District','=',$jela)
			->where('Report_Sent_By','=','Hindu')
			->where('Pourosova_City_Corporation','=',NULL)
			->distinct()
			->get();
		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
			    ->select('Thana')
                ->where('District','=',$jela)
 			    ->where('Report_Sent_By','=','Special')
				->where('Pourosova_City_Corporation','=',NULL)
				->distinct()
                ->get();
		}

       return view('tottho.upojela',compact('number'));
	}
	public function pourosova($jela){
		$nametable = (new ConverterController)->name2table($jela);
		session(['table' =>$nametable]);
		session(['jela' =>$jela]);
 
		$vt=session('religion');
		if($vt=='1'){
         $number=DB::table($nametable)
		        ->select('Pourosova_City_Corporation')
                ->where('District','=',$jela)
				->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
				->distinct()
                ->get();
			}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			     ->select('Pourosova_City_Corporation')
                ->where('District','=',$jela)
				->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
                ->where('Report_Sent_By','<>','Hindu')
			    ->where('Report_Sent_By','<>','Special')
 				->distinct()
                ->get();
		 
		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
			->select('Pourosova_City_Corporation')
			->where('District','=',$jela)
			->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
            ->where('Report_Sent_By','=','Hindu')
 			->distinct()
			->get();
		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
			    ->select('')
                ->where('District','=',$jela)
				->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
                 ->where('Report_Sent_By','=','Special')
 				->distinct()
                ->get();
		}

       return view('tottho.pourosova',compact('number'));
	}
   
	public function union123($thana){
		$nametable = session('table');
 		session(['thana' =>$thana]);
         $jela=session('jela');
		$vt=session('religion');
		if($vt=='1'){
         $number=DB::table($nametable)
		        ->select('Union_Ward')
                ->where('District','=',$jela)
				->where('Thana','=',$thana)
				->where('Pourosova_City_Corporation','=',NULL)
                 ->get();
			}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			     ->select('Union_Ward')
                 ->where('District','=',$jela)
				->where('Thana','=',$thana)
				->where('Report_Sent_By','<>','Hindu')
			    ->where('Report_Sent_By','<>','Special')
				->where('Pourosova_City_Corporation','=',NULL)
				->get();
		 
		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
			->select('Union_Ward')
			->where('District','=',$jela)
			->where('Thana','=',$thana)
			->where('Report_Sent_By','=','Hindu')
			->where('Pourosova_City_Corporation','=',NULL)
			->get();
		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
			    ->select('Union_Ward')
                ->where('District','=',$jela)
				->where('Thana','=',$thana)
 			    ->where('Report_Sent_By','=','Special')
				->where('Pourosova_City_Corporation','=',NULL)
				->get();
		}

       return view('tottho.union123',compact('number'));
	}
	public function ward123($pourosova){
		$nametable = session('table');
 		session(['thana' =>$pourosova]);
         $jela=session('jela');
		$vt=session('religion');
		if($vt=='1'){
         $number=DB::table($nametable)
		        ->select('Union_Ward')
                ->where('District','=',$jela)
				->where('Pourosova_City_Corporation','=',$pourosova)
                ->get();
			}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			     ->select('Union_Ward')
                 ->where('District','=',$jela)
				->where('Pourosova_City_Corporation','=',$pourosova)
				->where('Report_Sent_By','<>','Hindu')
			    ->where('Report_Sent_By','<>','Special')
 				->get();
		 
		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
			->select('Union_Ward')
			->where('District','=',$jela)
			->where('Pourosova_City_Corporation','=',$pourosova)
			->where('Report_Sent_By','=','Hindu')
 			->get();
		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
			    ->select('Union_Ward')
                ->where('District','=',$jela)
				->where('Pourosova_City_Corporation','=',$pourosova)
 			    ->where('Report_Sent_By','=','Special')
 				->get();
		}

       return view('tottho.ward123',compact('number'));
	}
  
}
