

@extends('master')
 
 
  
  
  
      
 
  
 @section('content')
 
 
<div class="table-scrol">  
      
  <div id="employee_table">  
<div class="table-responsive" align="center" ><!--this is used for responsive display in mobile and other devices-->  
   
    <br />
    <table         class="table"  style="width:60%;" >  
        <thead  >  
  
        <tr  class="info"   >  
             
             <th style="text-align:center">ক্রমিক নং </th>
         
                                            
       			 
             
            <th style="text-align:center">  পৌরসভা   </th> 
            
            
            <th style="text-align:center">   বিবাহ নিবন্ধকগনের সংখ্যা  </th>
            
			  
		</tr>  
        </thead> 




       

 
        @php
        $total=0;
        @endphp





 
        @foreach ($number as $district) 
          
  


		<tr>
		 <td align="center"> @php
       echo App\Http\Controllers\ConverterController::en2bn($loop->iteration);

       @endphp
      </td>
		 
		 
		 
		 <td align="center"> 
           
     <a href="{{route('ward123',$district->Pourosova_City_Corporation)}}">  {{ $district->Pourosova_City_Corporation}} </a> 
 
		 </td>

 <td align="center"> 
 @php 
$ffgg=App\Http\Controllers\CountController::pourosovacount($district->Pourosova_City_Corporation); $total=$ffgg+$total;
echo App\Http\Controllers\ConverterController::en2bn($ffgg);
@endphp

  </td>
  
           
   
 		</tr> 
     @endforeach	
    <tr> <td align="center">মোট বিবাহ নিবন্ধকগনের সংখ্যা   </td> <td align="center"> </td>      <td align="center"> 
      
    @php
       echo App\Http\Controllers\ConverterController::en2bn($total);

       @endphp
  
  </td></tr> 
  
	</table> 
 




</div>

	</div>
</div>
@endsection  
