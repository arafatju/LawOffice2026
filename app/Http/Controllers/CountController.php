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
                ->where('U','=',$name)
                ->count();}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			->where('U','=',$name)
			->where('T','<>','Hindu')
			->where('T','<>','Special')
			->count();

		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
			->where('U','=',$name)
			->where('T','=','Hindu')
			->count();

		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
			->where('U','=',$name)
			->where('T','=','Special')
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
                ->where('U','=',$jela)
                ->where('B','=',$name)
                ->where('Y','=',NULL)
                ->count();}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			->where('U','=',$jela)
            ->where('B','=',$name)
            ->where('Y','=',NULL) 
            ->where('T','<>','Hindu')
			->where('T','<>','Special')
			->count();

		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
            ->where('U','=',$jela)
            ->where('B','=',$name)
            ->where('Y','=',NULL)
            ->where('T','=','Hindu')
			->count();

		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
            ->where('U','=',$jela)
            ->where('B','=',$name)
            ->where('Y','=',NULL)
            ->where('T','=','Special')
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
                ->where('U','=',$jela)
                ->where('Y','=',$name)
                ->count();}

		elseif($vt=='2'){
			$number=DB::table($nametable)
			->where('U','=',$jela)
            ->where('Y','=',$name)
             ->where('T','<>','Hindu')
			->where('T','<>','Special')
			->count();

		}
		elseif($vt=='3'){
			$number=DB::table($nametable)
            ->where('U','=',$jela)
            ->where('Y','=',$name)
            ->where('T','=','Hindu')
			->count();

		}
		elseif($vt=='4'){
			$number=DB::table($nametable)
            ->where('U','=',$jela)
            ->where('Y','=',$name)
            ->where('T','=','Special')
			->count();

		}
                return $number;

    }
	public static function allcount($name){
        $nametable = (new ConverterController)->name2table($name);
         
         $number=DB::table($nametable)
                ->where('U','=',$name)
                ->count();
			return $number;
			
			}

	public static function muslim($name){
		$nametable = (new ConverterController)->name2table($name);

			$number=DB::table($nametable)
			->where('U','=',$name)
			->where('T','<>','Hindu')
			->where('T','<>','Special')
			->count();
         return $number;
		}
		public static function hindu($name){
	  $nametable = (new ConverterController)->name2table($name);
			$number=DB::table($nametable)
			->where('U','=',$name)
			->where('T','=','Hindu')
			->count();
			return $number;

		}
		public static function special($name){
			$nametable = (new ConverterController)->name2table($name);
			$number=DB::table($nametable)
			->where('U','=',$name)
			->where('T','=','Special')
			->count();
			return $number;
		}
                

    
}
