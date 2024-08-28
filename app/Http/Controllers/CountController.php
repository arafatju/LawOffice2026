<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CountController extends Controller
{
    public static function distcount($name){
        $nametable = (new ConverterController)->name2table($name);
        $vt=session('religion');
		if($vt=='1'){
         $number=DB::table($nametable)
                ->where('District','=',$name)
                ->count();}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			->where('District','=',$name)
			->where('Report_Sent_By','<>','Hindu')
			->where('Report_Sent_By','<>','Special')
			->count();

		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
			->where('District','=',$name)
			->where('Report_Sent_By','=','Hindu')
			->count();

		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
			->where('District','=',$name)
			->where('Report_Sent_By','=','Special')
			->count();

		}
                return $number;

    }

    public static function upojelacount($name){
		$nametable = session('table');
        $jela=session('jela');

        $vt=session('religion');
		if($vt=='1'){
         $number=DB::table($nametable)
                ->where('District','=',$jela)
                ->where('Thana','=',$name)
                ->where('Pourosova_City_Corporation','=',NULL)
                ->count();}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			->where('District','=',$jela)
            ->where('Thana','=',$name)
            ->where('Pourosova_City_Corporation','=',NULL) 
            ->where('Report_Sent_By','<>','Hindu')
			->where('Report_Sent_By','<>','Special')
			->count();

		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
            ->where('District','=',$jela)
            ->where('Thana','=',$name)
            ->where('Pourosova_City_Corporation','=',NULL)
            ->where('Report_Sent_By','=','Hindu')
			->count();

		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
            ->where('District','=',$jela)
            ->where('Thana','=',$name)
            ->where('Pourosova_City_Corporation','=',NULL)
            ->where('Report_Sent_By','=','Special')
			->count();

		}
                return $number;

    }


    public static function pourosovacount($name){
		$nametable = session('table');
        $jela=session('jela');
        
        $vt=session('religion');
		if($vt=='1'){
         $number=DB::table($nametable)
                ->where('District','=',$jela)
                ->where('Pourosova_City_Corporation','=',$name)
                ->count();}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			->where('District','=',$jela)
            ->where('Pourosova_City_Corporation','=',$name)
             ->where('Report_Sent_By','<>','Hindu')
			->where('Report_Sent_By','<>','Special')
			->count();

		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
            ->where('District','=',$jela)
            ->where('Pourosova_City_Corporation','=',$name)
            ->where('Report_Sent_By','=','Hindu')
			->count();

		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
            ->where('District','=',$jela)
            ->where('Pourosova_City_Corporation','=',$name)
            ->where('Report_Sent_By','=','Special')
			->count();

		}
                return $number;

    }
	public static function allcount($name){
        $nametable = (new ConverterController)->name2table($name);
         
         $number=DB::table($nametable)
                ->where('District','=',$name)
                ->count();
			return $number;
			
			}
    public static function piccount($name){

		$number=DB::table('kazipicture')
		        ->where('district','=',$name)
				->count();
				return $number;	
	}
	public static function muslim($name){
		$nametable = (new ConverterController)->name2table($name);

			$number=DB::table($nametable)
			->where('District','=',$name)
			->where('Report_Sent_By','<>','Hindu')
			->where('Report_Sent_By','<>','Special')
			->count();
         return $number;
		}
		public static function hindu($name){
	  $nametable = (new ConverterController)->name2table($name);
			$number=DB::table($nametable)
			->where('District','=',$name)
			->where('Report_Sent_By','=','Hindu')
			->count();
			return $number;

		}
		public static function special($name){
			$nametable = (new ConverterController)->name2table($name);
			$number=DB::table($nametable)
			->where('District','=',$name)
			->where('Report_Sent_By','=','Special')
			->count();
			return $number;
		}
                

    
}
