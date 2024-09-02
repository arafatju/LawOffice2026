<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ConverterController;
use DB;

class OnuController extends Controller
{
    public function onujela(Request $request){

        $religion=$request->input('status');
        $bivag=$request->input('bivag11');
        session(['bivag' =>$bivag]);

        if($religion=='মুসলিম বিবাহ নিবন্ধক'){session(['religion' =>'2']);}
        elseif($religion=='হিন্দু বিবাহ নিবন্ধক'){session(['religion' =>'3']);}
        elseif($religion=='বিশেষ বিবাহ নিবন্ধক'){session(['religion' =>'4']);}
 
     return view('khujo.onujela', compact('bivag'));

  
 

 
             }
 public function onuupojela(Request $request){
    $jela=$request->input('jela11');
    $category=$request->input('category');

             $nametable = (new ConverterController)->name2table($jela);
             session(['table' =>$nametable]);
             session(['jela' =>$jela]);
     
             $vt=session('religion');
              
     
             if($vt=='2'){
                 $number=DB::table($nametable)
                      ->select('Thana')
                     ->where('District','=',$jela)
                     ->where('Report_Sent_By','<>','Hindu')
                     ->where('Report_Sent_By','<>','Special')
                     ->where('Pourosova_City_Corporation','=',NULL)
                     ->distinct()
                     ->get();
                 $number2=DB::table($nametable)
                     ->select('Pourosova_City_Corporation')
                    ->where('District','=',$jela)
                    ->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
                    ->where('Report_Sent_By','<>','Hindu')
                    ->where('Report_Sent_By','<>','Special')
                     ->distinct()
                    ->get();
                    $number3=DB::table($nametable)
                    ->select('Pourosova_City_Corporation')
                   ->where('District','=',$jela)
                   ->where('Pourosova_City_Corporation','regexp','কর্পোরেশন')
                   ->where('Report_Sent_By','<>','Hindu')
                   ->where('Report_Sent_By','<>','Special')
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

            $number2=DB::table($nametable)
                 ->select('Pourosova_City_Corporation')
                 ->where('District','=',$jela)
                 ->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
                 ->where('Report_Sent_By','=','Hindu')
                  ->distinct()
                 ->get();
            $number3=DB::table($nametable)
                 ->select('Pourosova_City_Corporation')
                 ->where('District','=',$jela)
                 ->where('Pourosova_City_Corporation','regexp','কর্পোরেশন')
                 ->where('Report_Sent_By','=','Hindu')
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

                 $number2=DB::table($nametable)
                     ->select('Pourosova_City_Corporation')
                     ->where('District','=',$jela)
                     ->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
                      ->where('Report_Sent_By','=','Special')
                      ->distinct()
                     ->get();
                $number3=DB::table($nametable)
                     ->select('Pourosova_City_Corporation')
                     ->where('District','=',$jela)
                     ->where('Pourosova_City_Corporation','regexp','কর্পোরেশন')
                      ->where('Report_Sent_By','=','Special')
                      ->distinct()
                     ->get();
             }
     
            
            $bivag=session('bivag');
            
            if($category=='উপজেলা')  {              session(['thanamid' =>$number]);

             return view('khujo.onuupojela',compact('number','bivag'));
            }
            elseif($category=='পৌরসভা'){  session(['thanamid' =>$number2]);
                return view('khujo.onupourosova',compact('number2','bivag'));

            }
            elseif($category=='সিটি কর্পোরেশন'){  session(['thanamid' =>$number3]);
                return view('khujo.onucity',compact('number3','bivag'));
            }


         }


         public function onuunion(Request $request){
          
            $thana=$request->input('thana');
         
                     $nametable = session('table');
                     $jela=session('jela') ;            
                     $vt=session('religion');
                      
             
                     if($vt=='2'){
                         $unionlist=DB::table($nametable)
                             ->select('Union_Ward')
                             ->where('District','=',$jela)
                             ->where('Thana','=',$thana)
                             ->where('Report_Sent_By','<>','Hindu')
                             ->where('Report_Sent_By','<>','Special')
                             ->where('Pourosova_City_Corporation','=',NULL)
                            ->get();
                                             }
                     elseif($vt=='3'){
                         $unionlist=DB::table($nametable)
                         ->select('Union_Ward')
                         ->where('District','=',$jela)
                         ->where('Thana','=',$thana)
                         ->where('Report_Sent_By','=','Hindu')
                         ->where('Pourosova_City_Corporation','=',NULL)
                         ->get();
        
                    
                     }
                     elseif($vt=='4'){
                         $unionlist=DB::table($nametable)
                             ->select('Union_Ward')
                             ->where('District','=',$jela)
                             ->where('Thana','=',$thana)
                             ->where('Report_Sent_By','=','Special')
                             ->where('Pourosova_City_Corporation','=',NULL)
                             ->get();
        
                         
                     }
                   $bivag=session('bivag');
                   $number=session('thanamid');
                     return view('khujo.onuunion',compact('unionlist','bivag','number'));
             
            
         }
         public function onuperson2(Request $request){
            $list23 =$request->input('thana');

			$table=session('table');
			$jela=session('jela');
 			$person=DB::table($table)
					->select('*')
					->where('District','=',$jela)
 					->where('Union_Ward','=',$list23)
					->get();
		
			return view('last.onuperson2',compact('person'));
				}
                public function onuperson3(Request $request){
                    $list23 =$request->input('thana');
        
                    $table=session('table');
                    $jela=session('jela');
                     $person=DB::table($table)
                            ->select('*')
                            ->where('Pourosova_City_Corporation','=',session('citycop'))
                            ->where('District','=',$jela)
                             ->where('Union_Ward','=',$list23)
                             
                            ->get();
                
                    return view('last.onuperson3',compact('person'));
                        }
                        public function onuperson1(Request $request){
                            $list23 =$request->input('thana');
                
                            $table=session('table');
                            $jela=session('jela');
                             $person=DB::table($table)
                                    ->select('*')
                                    ->where('District','=',$jela)
                                     ->where('Union_Ward','=',$list23)
                                    ->get();
                        
                            return view('last.onuperson1',compact('person'));
                                }
         public function onucityward(Request $request){
          
            $thana=$request->input('corporation');
            session(['citycop' =>$thana]);

                     $nametable = session('table');
                     $jela=session('jela') ;            
                     $vt=session('religion');
                      
             
                     if($vt=='2'){
                         $unionlist=DB::table($nametable)
                             ->select('Union_Ward')
                             ->where('District','=',$jela)
                             ->where('Pourosova_City_Corporation','=',$thana)
                             ->where('Report_Sent_By','<>','Hindu')
                             ->where('Report_Sent_By','<>','Special')
                             ->orderby('Union_Ward')
                             ->get();
                                             }
                     elseif($vt=='3'){
                         $unionlist=DB::table($nametable)
                         ->select('Union_Ward')
                         ->where('District','=',$jela)
                         ->where('Pourosova_City_Corporation','=',$thana)
                         ->where('Report_Sent_By','=','Hindu')
                         ->orderby('Union_Ward')
                         ->get();
        
                    
                     }
                     elseif($vt=='4'){
                         $unionlist=DB::table($nametable)
                             ->select('Union_Ward')
                             ->where('District','=',$jela)
                             ->where('Pourosova_City_Corporation','=',$thana)
                             ->where('Report_Sent_By','=','Special')
                             ->orderby('Union_Ward')
                            ->get();
        
                         
                     }
                   $bivag=session('bivag');
                   $number=session('thanamid');
                     return view('khujo.onucityward',compact('unionlist','bivag','number'));
             
            
         }
         public function onuward(Request $request){
          
            $thana=$request->input('pourosova');
         
                     $nametable = session('table');
                     $jela=session('jela') ;            
                     $vt=session('religion');
                      
             
                     if($vt=='2'){
                         $unionlist=DB::table($nametable)
                             ->select('Union_Ward')
                             ->where('District','=',$jela)
                             ->where('Pourosova_City_Corporation','=',$thana)
                             ->where('Report_Sent_By','<>','Hindu')
                             ->where('Report_Sent_By','<>','Special')
                             ->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
                            ->get();
                                             }
                     elseif($vt=='3'){
                         $unionlist=DB::table($nametable)
                         ->select('Union_Ward')
                         ->where('District','=',$jela)
                         ->where('Pourosova_City_Corporation','=',$thana)
                         ->where('Report_Sent_By','=','Hindu')
                         ->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
                         ->get();
        
                    
                     }
                     elseif($vt=='4'){
                         $unionlist=DB::table($nametable)
                             ->select('Union_Ward')
                             ->where('District','=',$jela)
                             ->where('Pourosova_City_Corporation','=',$thana)
                             ->where('Report_Sent_By','=','Special')
                             ->where('Pourosova_City_Corporation','not regexp','কর্পোরেশন')
                             ->get();
        
                         
                     }
                   $bivag=session('bivag');
                   $number=session('thanamid');
                     return view('khujo.onuward',compact('unionlist','bivag','number'));
             
            
         }
  
}
