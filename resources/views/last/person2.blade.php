


@extends('common.kazi')
 
 
  
  
  
      
 
  
 @section('content')

 

<div class="table-scrol">  
      
  <div id="employee_table">  
<div class="table-responsive" align="center" ><!--this is used for responsive display in mobile and other devices-->  
   
    <br />
  
    <table    class="table caption-top" style="width:50%;margin-bottom:40px;" textcolor="white">  
    <caption>বিবাহ নিবন্ধক এর তথ্য </caption>

    <thead  >  
  
        <tr  bgcolor="purple" style="color:white;" >  
             
             <th>ক্রমিক নং </th>
              <th> তথ্য  </th>

  </tr> 
            
             
		 
        </thead> 
        
        
        @foreach ($person as $row1)  
            
			 
		
		 
		    
        
      	
        
		<tr  >
		<td > 
      
    @php
     echo '১.নাম';

       @endphp
    
      </td>	
		 
	 
	 
				 
						 <td  >  {{$row1->Name}} </td>  </tr> 

				 <tr>
		<td >  @php
 
        echo '২.পিতার নাম';

       @endphp
     </td>	
                         <td> {{$row1->Father}} </td> </tr> 
                                           
                         <tr>
		<td > @php
 
       echo  '৩.মাতার নাম';

       @endphp   </td>	
                         <td>{{$row1->Mother}}  </td> </tr> 
                        
                         <tr>
		<td > @php
 
       echo '৪.অধিক্ষেত্র ';

       @endphp   </td>	
                         <td> {{$row1->Union_Ward}} </td> </tr>
                        
                         <tr>
		<td > @php
 
       echo '৫.জন্ম তারিখ';

       @endphp   </td>	
                         <td>                             @php 
                          echo  App\Http\Controllers\ConverterController::bangladate11($row1->DOB);
                           @endphp
                           
                        
                        </td> </tr> 
        
                         <tr>
		<td >@php
 
       echo '৬.শিক্ষাগত যোগ্যতা';

       @endphp   </td>	
		 
	 
	 
				 
						 <td>  {{$row1->Education}} </td>  </tr> 

				 <tr>
		<td > @php
 
       echo '৭.মোবাইল';

       @endphp </td>	
                         <td>  @php 
                        
                         if(strlen($row1->Mobile)==10){
                                   $kkp='0'.$row1->Mobile  ;
                                   echo  App\Http\Controllers\ConverterController::en2bn($kkp);

                          }
                         else {
                          echo  App\Http\Controllers\ConverterController::en2bn($row1->Mobile);

                         }
                         
                         
                        
                           @endphp
                          </td> </tr> 
                                           
                         <tr>
		<td > @php
    $kk=$loop->iteration;

       echo '৮.ই মেইল';

       @endphp   </td>	
                         <td>{{$row1->Email}}  </td> </tr> 
                        
                         <tr>
		<td > @php
    $kk=$loop->iteration;

       echo '৯.এনআইডি';

       @endphp   </td>	
                         <td> @php echo App\Http\Controllers\ConverterController::en2bn($row1->NID); @endphp </td> </tr>
                        
                          
                                      
                         
                         <tr>
		<td >@php
 
       echo '১০.স্থায়ী ঠিকানা ';

       @endphp    </td>	
                         <td>   @php 
                          echo  App\Http\Controllers\ConverterController::en2bn($row1->Permanent);
                           @endphp
                           </td> </tr>
                        
                         <tr>
		<td >@php
 
       echo '১১.কার্যালয়ের ঠিকানা';

       @endphp    </td>	
                         <td>  @php 
                          echo  App\Http\Controllers\ConverterController::en2bn($row1->Office);
                           @endphp
                           </td> </tr> 
                     
		@endforeach
		
		
   
	</table> 




</div>

	</div>
</div>
          @endsection