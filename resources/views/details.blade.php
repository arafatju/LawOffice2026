
 



@extends('master')
 
 
  
  
  
      
 
  
 @section('content')
 
 

<div class="table-scrol">  
      
  <div id="employee_table">  
<div class="table-responsive" align="center" ><!--this is used for responsive display in mobile and other devices-->  
   
    <br />
    <table         class="table"  style="width:60%;margin-bottom:10%;" >  
        <thead  >  
  
        <tr  class="info"   >  
             
             <th style="text-align:center">ক্রমিক নং </th>
         
                                            
       			 
             
            <th style="text-align:center">   জেলার নাম   </th> 
            
            <th style="text-align:center">  মুসলিম  </th>
            
            <th style="text-align:center">   হিন্দু  </th>
            
            <th style="text-align:center">   বিশেষ </th>

             
            <th style="text-align:center">  মোট   সংখ্যা  </th>
            
           
          

			  
		</tr>  
        </thead> 




       

 








       @php
        $total=0; $total_muslim=0; $total_hindu=0; $total_special=0;
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
        @foreach ($hh as $district) 
          
  


		<tr>
		 <td align="center">
       @php
       echo App\Http\Controllers\ConverterController::en2bn($loop->iteration);

       @endphp
     
     </td>
		 
		 
		 
		 <td align="center"> 
           
       {{ $district}} 
 
		 </td>

  
 
     
          <td align="center">
          @php 
$ffgg=App\Http\Controllers\CountController::muslim($district); $total_muslim=$ffgg+$total_muslim; 
echo App\Http\Controllers\ConverterController::en2bn($ffgg);
@endphp
          </td>
          <td align="center">
          @php 
$ffgg=App\Http\Controllers\CountController::hindu($district);  $total_hindu=$ffgg+$total_hindu; 
echo App\Http\Controllers\ConverterController::en2bn($ffgg);
@endphp
</td>
   
<td align="center">
          @php 
$ffgg=App\Http\Controllers\CountController::special($district);  $total_special=$ffgg+$total_special;
echo App\Http\Controllers\ConverterController::en2bn($ffgg);
@endphp
</td>
<td align="center">
 @php 
$ffgg=App\Http\Controllers\CountController::allcount($district); $total=$ffgg+$total;
echo App\Http\Controllers\ConverterController::en2bn($ffgg);
@endphp
          </td>

 		</tr> 
     @endforeach	
    <tr> <td align="center">মোট  সংখ্যা   </td> <td align="center">   </td> <td align="center">@php 
    echo App\Http\Controllers\ConverterController::en2bn($total_muslim);
  
  @endphp </td>  
  <td align="center">@php 
    echo App\Http\Controllers\ConverterController::en2bn($total_hindu);
  
  @endphp </td>
  <td align="center">@php 
    echo App\Http\Controllers\ConverterController::en2bn($total_special);
  
  @endphp </td>
  
  <td align="center"> @php 
    echo App\Http\Controllers\ConverterController::en2bn($total);
  
  @endphp
  </td></tr> 
  
	</table> 
 




</div>

	</div>
</div>
@endsection       
   
