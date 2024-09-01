 
  
@extends('master')
 
 
  
  
  
      
 
  
 @section('content')
 <div class="card text-center mt-3 mb-3 ">
  <div class="card-body text-center w-50 " style="margin-left:20%;">
   <form action="{{route('onujela')}}" method="POST" accept-charset="UTF-8" role="form">
                             @csrf
  
    নিবন্ধকের ধরন 
                  
 
                 <select name="status"  id="office" class="form-control ">
                        
                        <option>মুসলিম বিবাহ নিবন্ধক</option>
                        <option>হিন্দু বিবাহ নিবন্ধক</option>
                        <option>বিশেষ বিবাহ নিবন্ধক</option>
                       
                       
                   </select> 



          বিভাগ 
          <select name="bivag11"  id="office" class="form-control ">
                             
                             <option>রাজশাহী</option>
                             <option>খুলনা</option>
                             <option>ময়মনসিংহ</option>
                             <option>বরিশাল</option>
                             <option>রংপুর</option>
                             <option>ঢাকা</option>
                             <option>সিলেট</option>
                             <option>চট্টগ্রাম</option>
                            
                            
                        </select> 
                  	<input class="btn btn-sm btn-primary  " type="submit" value="Submit">
          
                 
                    
 
 			   </form> 		  
  
  
     @php
        $total=0;
       $dhaka=array('ঢাকা','গাজীপুর','নারায়ণগঞ্জ','নরসিংদী','কিশোরগঞ্জ','ফরিদপুর','গোপালগঞ্জ','মাদারীপুর','মানিকগঞ্জ','মুন্সিগঞ্জ','রাজবাড়ী','শরীয়তপুর','টাঙ্গাইল');
       $chittagang=array('বান্দরবান','ব্রাহ্মণবাড়িয়া','চাঁদপুর','চট্টগ্রাম','কুমিল্লা','কক্সবাজার','ফেনী','খাগড়াছড়ি','লক্ষ্মীপুর','নোয়াখালী','রাঙ্গামাটি');
       $rajshahi=array('বগুড়া','চাঁপাইনবাবগঞ্জ','জয়পুরহাট','নওগাঁ','নাটোর','পাবনা','রাজশাহী','সিরাজগঞ্জ');
       $khulna=array('বাগেরহাট','চুয়াডাঙ্গা','যশোর','ঝিনাইদহ','খুলনা','কুষ্টিয়া','মাগুরা','মেহেরপুর','নড়াইল','সাতক্ষীরা');
        $maymensingh=array('জামালপুর','ময়মনসিংহ','নেত্রকোণা','শেরপুর');
        $barishal=array('বরগুনা','বরিশাল','ঝালকাঠি','পিরোজপুর','পটুয়াখালী','ভোলা');
        $rangpur=array('দিনাজপুর','গাইবান্ধা','কুড়িগ্রাম','লালমনিরহাট','নীলফামারী','পঞ্চগড়','রংপুর','ঠাকুরগাঁও');
        $sylhet=array('হবিগঞ্জ','মৌলভীবাজার','সুনামগঞ্জ','সিলেট');
     
       if($bivag=='ঢাকা')$hh=$dhaka;
       elseif($bivag=='চট্টগ্রাম') $hh=$chittagang;
       elseif($bivag=='রাজশাহী') $hh=$rajshahi;
       elseif($bivag=='খুলনা') $hh=$khulna;
       elseif($bivag=='ময়মনসিংহ') $hh=$maymensingh;
       elseif($bivag=='বরিশাল') $hh=$barishal;
       elseif($bivag=='রংপুর') $hh=$rangpur;
       elseif($bivag=='সিলেট') $hh=$sylhet;

       @endphp
       <form action="{{route('onuupojela')}}" method="POST" accept-charset="UTF-8" role="form">
                             @csrf
     জেলা              
         <select name="jela11"  id="office" class="form-control ">
         @foreach ($hh as $district) 
                             <option>  {{ $district}} </option>
                              
                     @endforeach       
                            
                        </select>  
                        শ্রেণী নিবাচন
                        <select name="category" id="offi" class="form-control">
                          <option>
                            উপজেলা
          </option>
          <option>
                            পৌরসভা 
          </option>
          <option>
                            সিটি কর্পোরেশন 
          </option>
          </select>
                      	<input class="btn btn-sm btn-primary  " type="submit" value="Submit">

                 
                    
          
      
     
    </form> 
   
 
 			  	  
          </div>
        </div> 
          @endsection