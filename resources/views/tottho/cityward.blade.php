

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
         
                                            
       			 
             
            <th style="text-align:center">  ওয়ার্ড  </th> 
            
            
             
			  
		</tr>  
        </thead> 




       

 






 
        @foreach ($ward124 as $district) 
          
  


		<tr>
		 <td align="center">
     @php
       echo App\Http\Controllers\ConverterController::en2bn($loop->iteration);

       @endphp


     </td>
		 
		 
		 
		 <td align="center"> 
           
     <a href="{{route('person3',encrypt($district->Union_Ward))}}">  @php echo App\Http\Controllers\ConverterController::en2bn ($district->Union_Ward) @endphp </a> 
 
		 </td>

 <td align="center"> 
  </td>
  
           
   
 		</tr> 
     @endforeach	
    <tr> <td align="center">মোট বিবাহ নিবন্ধকগনের সংখ্যা   </td> <td align="center"> </td>      <td align="center">  </td></tr> 
  
	</table> 
 




</div>

	</div>
</div>
        @endsection