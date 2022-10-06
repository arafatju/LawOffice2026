
@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
           
                 
                 
           
                @foreach($person as $row1)


		    
      	
        
		<tr  >
		<td > 
      
    @php
     echo '১.নাম';

       @endphp
    
      </td>	
		 
	 
	 
				 
						 <td  >  {{$row1->D}} </td> <td>   </td>  </tr> 

				 <tr>
		<td >  @php
 
        echo '২.পিতার নাম';

       @endphp
     </td>	
                         <td> {{$row1->E}} </td> <td>    </td> </tr> 
                                           
                         <tr>
		<td > @php
 
       echo  '৩.মাতার নাম';

       @endphp   </td>	
                         <td>{{$row1->F}}  </td> <td>   </td></tr> 
                        
                         <tr>
		
                         <tr>
		<td > @php
 
       echo  '৪.উপজেলা ';

       @endphp   </td>	
                         <td>{{$row1->F}}  </td> <td>   </td></tr> 
                        
                         <tr>
                         <tr>
		<td > @php
 
       echo  '৫.পৌরসভা';

       @endphp   </td>	
                         <td>{{$row1->F}}  </td> <td>   </td></tr> 
                        
                         <tr>
                         <tr>
		<td > @php
 
       echo  '৬.সিটি কর্পোরেশন';

       @endphp   </td>	
                         <td>{{$row1->F}}  </td> <td>   </td></tr> 
                        
                         <tr>
        
        
        
                         <td > @php
 
       echo '৭.অধিক্ষেত্র ';

       @endphp   </td>	
                         <td> {{$row1->A}} </td> <td>    </td></tr>
                        
                         <tr>
		<td > @php
 
       echo '৮.জন্ম তারিখ';

       @endphp   </td>	
                         <td>                             
                          {{$row1->G}};
                           
                           
                        
                        </td> <td>   </td></tr> 
        
                         <tr>
		<td >@php
 
       echo '১০.শিক্ষাগত যোগ্যতা';

       @endphp   </td>	
		 
	 
	 
				 
						 <td>  {{$row1->I}} </td> <td>    </td> </tr> 

				 <tr>
		<td > @php
 
       echo '১১.মোবাইল';

       @endphp </td>	
                         <td>   {{$row1->M}}
                          </td> <td>    </td></tr> 
                                           
                         <tr>
		<td > @php
     

       echo '১২.ই মেইল';

       @endphp   </td>	
                         <td>{{$row1->N}}  </td> <td>   </td></tr> 
                        
                         <tr>
		<td > @php
    

       echo '১৩.এনআইডি';

       @endphp   </td>	
                         <td>   {{$row1->H }} </td> <td>  </td></tr>
                        
                         <tr>
		<td > @php
    

       echo '১৪.লাইসেন্স প্রাপ্তির স্মারক';

       @endphp  </td>	
                         <td> {{ $row1->O}}
                           
                           </td> <td>    </td></tr> 
                         <tr>
		<td > @php
    

       echo '১৫.লাইসেন্স প্রাপ্তির তারিখ';

       @endphp  </td>	
		 
	 
	 
				 
						 <td>   
                          {{$row1->Z}}
                           
                          </td> <td>   </td> </tr> 

				 <tr>
		<td > @php
 
       echo '১৬.লাইসেন্স স্থায়ী না অস্থায়ী';

       @endphp </td>	
                         <td> {{$row1->P}} </td><td>   </td> </tr> 
                                           
                         <tr>
		<td > @php
 
       echo '১৭.জেলা রেজিস্ট্রার বরাবর যোগদানের তারিখ';

       @endphp  </td>	
                         <td>  {{$row1->Q}}
                           
                           </td> <td>   </td></tr> 
                        
                         <tr>
		<td > @php
 
       echo '১৪.ইনডেন্ট পাশের তারিখ';

       @endphp  </td>	
                         <td>    {{$row1->R}}
                           
                          </td><td>    </td> </tr>
                        
                         <tr>
		<td > @php
 
       echo '১৫.লাইসেন্স গেজেট  প্রকাশের তারিখ';

       @endphp   </td>	
                         <td>  {{ $row1->S}}
                           
                          </td>
                          <td>   </td> </tr> 
                     
                         <tr>
		<td >@php
 
       echo '১৬.বয়স ৬৭ বছর পূর্তিতে লাইসেন্স অবসানের তারিখ';

       @endphp  </td>	
                         <td>   {{$row1->V}}
                            
                          </td><td>   </td> </tr> 
                                           
                         <tr>
		<td > @php
    $kk=$loop->iteration;

       echo '১৭.চাকুরী';

       @endphp    </td>	
                         <td>{{$row1->W}}  </td> <td>   </td></tr> 
                        
                        
                         <tr>
		<td > @php
 
       echo  '৩.প্রতিষ্ঠানের নাম';

       @endphp   </td>	
                         <td>{{$row1->F}}  </td> <td>   </td></tr> 
                        
                         <tr>
                        
                         <tr>

            
		<td >@php
 
       echo '১৮.স্থায়ী ঠিকানা ';

       @endphp    </td>	
                         <td>    {{$row1->J}}
                           
                           </td><td>  </td> </tr>
                        
                         <tr>
		<td >@php
 
       echo '১৯.কার্যালয়ের ঠিকানা'; 

       @endphp    </td>	
                         <td>  {{$row1->L}}
                            
                           </td><td>    </td> </tr> 




















                
                @endforeach
             
        </table>
        
    </div>
  @endsection
