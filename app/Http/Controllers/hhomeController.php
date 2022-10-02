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
			->select('A')
 			->where('Y','=',$city)
 			->get();

			 $ward125=DB::table($nametable)
			 ->select('U')
			  ->where('Y','=',$city)
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
			->where('U','=',$jela)
			->where('B','=',$thana)
			->where('A','=',$odhi)
			->get();
    
	return view('last.person',compact('person'));
		}

		public function person2($odhi){

			$table=session('table');
			$jela=session('jela');
			$pourosova=session('thana');
			$person=DB::table($table)
					->select('*')
					->where('U','=',$jela)
					->where('Y','=',$pourosova)
					->where('A','=',$odhi)
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
							->where('Y','=',$city)
 							->where('A','=',$odhi)
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
		        ->select('B')
                ->where('U','=',$jela)
				->where('Y','=',NULL)
				->distinct()
                ->get();
			}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			     ->select('B')
                ->where('U','=',$jela)
				->where('T','<>','Hindu')
			    ->where('T','<>','Special')
				->where('Y','=',NULL)
				->distinct()
                ->get();
		 
		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
			->select('B')
			->where('U','=',$jela)
			->where('T','=','Hindu')
			->where('Y','=',NULL)
			->distinct()
			->get();
		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
			    ->select('B')
                ->where('U','=',$jela)
 			    ->where('T','=','Special')
				->where('Y','=',NULL)
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
		        ->select('Y')
                ->where('U','=',$jela)
				->where('Y','not regexp','কর্পোরেশন')
				->distinct()
                ->get();
			}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			     ->select('Y')
                ->where('U','=',$jela)
				->where('Y','not regexp','কর্পোরেশন')
                ->where('T','<>','Hindu')
			    ->where('T','<>','Special')
 				->distinct()
                ->get();
		 
		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
			->select('Y')
			->where('U','=',$jela)
			->where('Y','not regexp','কর্পোরেশন')
            ->where('T','=','Hindu')
 			->distinct()
			->get();
		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
			    ->select('Y')
                ->where('U','=',$jela)
				->where('Y','not regexp','কর্পোরেশন')
                 ->where('T','=','Special')
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
		        ->select('A')
                ->where('U','=',$jela)
				->where('B','=',$thana)
				->where('Y','=',NULL)
                 ->get();
			}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			     ->select('A')
                 ->where('U','=',$jela)
				->where('B','=',$thana)
				->where('T','<>','Hindu')
			    ->where('T','<>','Special')
				->where('Y','=',NULL)
				->get();
		 
		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
			->select('A')
			->where('U','=',$jela)
			->where('B','=',$thana)
			->where('T','=','Hindu')
			->where('Y','=',NULL)
			->get();
		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
			    ->select('A')
                ->where('U','=',$jela)
				->where('B','=',$thana)
 			    ->where('T','=','Special')
				->where('Y','=',NULL)
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
		        ->select('A')
                ->where('U','=',$jela)
				->where('Y','=',$pourosova)
                ->get();
			}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			     ->select('A')
                 ->where('U','=',$jela)
				->where('Y','=',$pourosova)
				->where('T','<>','Hindu')
			    ->where('T','<>','Special')
 				->get();
		 
		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
			->select('A')
			->where('U','=',$jela)
			->where('Y','=',$pourosova)
			->where('T','=','Hindu')
 			->get();
		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
			    ->select('A')
                ->where('U','=',$jela)
				->where('Y','=',$pourosova)
 			    ->where('T','=','Special')
 				->get();
		}

       return view('tottho.ward123',compact('number'));
	}
  
}
