 

@extends('common.kazi')
 
 
  
  
  
      
 
  
 @section('content')
<div class="table-scrol">  
      
  <div id="employee_table">  
<div class="table-responsive" align="center" ><!--this is used for responsive display in mobile and other devices-->  
   
    <br />

    <table    class="table  " style="width:50%;"  >  
     
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
		 
	 
	 
				 
						 <td  >  {{$row1->D}} </td>  </tr> 

				 <tr>
		<td >  @php
 
        echo '২.পিতার নাম';

       @endphp
     </td>	
                         <td> {{$row1->E}} </td> </tr> 
                                           
                         <tr>
		<td > @php
 
       echo  '৩.মাতার নাম';

       @endphp   </td>	
                         <td>{{$row1->F}}  </td> </tr> 
                        
                         <tr>
		<td > @php
 
       echo '৪.অধিক্ষেত্র ';

       @endphp   </td>	
                         <td> {{$row1->A}} </td> </tr>
                        
                         <tr>
		<td > @php
 
       echo '৫.জন্ম তারিখ';

       @endphp   </td>	
                         <td>                             @php 
                          echo  App\Http\Controllers\ConverterController::bangladate11($row1->G);
                           @endphp
                           
                        
                        </td> </tr> 
        
                         <tr>
		<td >@php
 
       echo '৬.শিক্ষাগত যোগ্যতা';

       @endphp   </td>	
		 
	 
	 
				 
						 <td>  {{$row1->I}} </td>  </tr> 

				 <tr>
		<td > @php
 
       echo '৭.মোবাইল';

       @endphp </td>	
                         <td>  @php 
                        
                         if(strlen($row1->M)==10){
                                   $kkp='0'.$row1->M ;
                                   echo  App\Http\Controllers\ConverterController::en2bn($kkp);

                          }
                         else {
                          echo  App\Http\Controllers\ConverterController::en2bn($row1->M);

                         }
                         
                         
                        
                           @endphp
                          </td> </tr> 
                                           
                         <tr>
		<td > @php
    $kk=$loop->iteration;

       echo '৮.ই মেইল';

       @endphp   </td>	
                         <td>{{$row1->N}}  </td> </tr> 
                        
                         <tr>
		<td > @php
    $kk=$loop->iteration;

       echo '৯.এনআইডি';

       @endphp   </td>	
                         <td> @php echo App\Http\Controllers\ConverterController::en2bn($row1->H); @endphp </td> </tr>
                        
                         <tr>
		<td > @php
    $kk=$loop->iteration;

       echo '১০.লাইসেন্স প্রাপ্তির স্মারক';

       @endphp  </td>	
                         <td>  @php 
                          echo  App\Http\Controllers\ConverterController::en2bn($row1->O);
                           @endphp
                           </td> </tr> 
                         <tr>
		<td > @php
    $kk=$loop->iteration;

       echo '১১.লাইসেন্স প্রাপ্তির তারিখ';

       @endphp  </td>	
		 
	 
	 
				 
						 <td>   @php 
                          echo  App\Http\Controllers\ConverterController::bangladate11($row1->Z);
                           @endphp
                          </td>  </tr> 

				 <tr>
		<td > @php
 
       echo '১২.লাইসেন্স স্থায়ী না অস্থায়ী';

       @endphp </td>	
                         <td> {{$row1->P}} </td> </tr> 
                                           
                         <tr>
		<td > @php
 
       echo '১৩.জেলা রেজিস্ট্রার বরাবর যোগদানের তারিখ';

       @endphp  </td>	
                         <td> @php 
                          echo  App\Http\Controllers\ConverterController::bangladate11($row1->Q);
                           @endphp
                           </td> </tr> 
                        
                         <tr>
		<td > @php
 
       echo '১৪.ইনডেন্ট পাশের তারিখ';

       @endphp  </td>	
                         <td>   @php 
                          echo  App\Http\Controllers\ConverterController::bangladate11($row1->R);
                           @endphp
                          </td> </tr>
                        
                         <tr>
		<td > @php
 
       echo '১৫.লাইসেন্স গেজেট  প্রকাশের তারিখ';

       @endphp   </td>	
                         <td>  @php 
                          echo  App\Http\Controllers\ConverterController::bangladate11($row1->S);
                           @endphp
                          </td> </tr> 
                     
                         <tr>
		<td >@php
 
       echo '১৬.বয়স ৬৭ বছর পূর্তিতে লাইসেন্স অবসানের তারিখ';

       @endphp  </td>	
                         <td>  @php 
                          echo  App\Http\Controllers\ConverterController::bangladate11($row1->V);
                           @endphp
                          </td> </tr> 
                                           
                         <tr>
		<td > @php
    $kk=$loop->iteration;

       echo '১৭.চাকুরী';

       @endphp    </td>	
                         <td>{{$row1->W}},{{$row1->X}}   </td> </tr> 
                        
                         <tr>
		<td >@php
 
       echo '১৮.স্থায়ী ঠিকানা ';

       @endphp    </td>	
                         <td>   @php 
                          echo  App\Http\Controllers\ConverterController::en2bn($row1->J);
                           @endphp
                           </td> </tr>
                        
                         <tr>
		<td >@php
 
       echo '১৯.কার্যালয়ের ঠিকানা';

       @endphp    </td>	
                         <td>  @php 
                          echo  App\Http\Controllers\ConverterController::en2bn($row1->L);
                           @endphp
                           </td> </tr> 
                     
		@endforeach
		
		
   
	</table> 
 
          </div>



</div>

	</div>
</div>
         @endsection
