
@extends('common.dr')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
           
                 
        <thead>
                <tr>
                    <th colspan="3">
                    বিবাহ নিবন্ধগনের তথ্য সংশোধন আবেদন
                    </th>
                </tr>
                </thead>       
           
                @foreach($person as $row1)


		    
      	
        
		<tr  >
		<td > 
      
    @php
     echo '১.নাম';

       @endphp
    
      </td>	
		 
	 
	 
				 
						 <td  >  {{$row1->Name}} </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('D'),'id2'=>'নাম '])}}"> তথ্য সংশোধন </a>
 </td>  </tr> 

				 <tr>
		<td >  @php
 
        echo '২.পিতার নাম';

       @endphp
     </td>	
                         <td> {{$row1->Father}} </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('E'),'id2'=>'পিতার নাম'])}}"> তথ্য সংশোধন </a>
 </td> </tr> 
                                           
                         <tr>
		<td > @php
 
       echo  '৩.মাতার নাম';

       @endphp   </td>	
                         <td>{{$row1->Mother}}  </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme',['id'=>encrypt('F'),'id2'=>'মাতার নাম'] )}}"> তথ্য সংশোধন </a>
 </td></tr> 
                        
                         <tr>
		<td > @php
 
       echo '৪.অধিক্ষেত্র ';

       @endphp   </td>	
                         <td> {{$row1->A}} </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('A'),'id2'=>'অধিক্ষেত্র'])}}"> তথ্য সংশোধন </a>
 </td></tr>
                        
                         <tr>
		<td > @php
 
       echo '৫.জন্ম তারিখ';

       @endphp   </td>	
                         <td>                             
                          {{$row1->G}};
                           
                           
                        
                        </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('G'),'id2'=>'জন্ম তারিখ'])}}"> তথ্য সংশোধন </a>
 </td></tr> 
        
                         <tr>
		<td >@php
 
       echo '৬.শিক্ষাগত যোগ্যতা';

       @endphp   </td>	
		 
	 
	 
				 
						 <td>  {{$row1->I}} </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('I'),'id2'=>'শিক্ষাগত যোগ্যতা'])}}"> তথ্য সংশোধন </a>
 </td> </tr> 

				 <tr>
		<td > @php
 
       echo '৭.মোবাইল';

       @endphp </td>	
                         <td>   {{$row1->M}}
                          </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('M'),'id2'=>'মোবাইল'])}}"> তথ্য সংশোধন </a>
 </td></tr> 
                                           
                         <tr>
		<td > @php
     

       echo '৮.ই মেইল';

       @endphp   </td>	
                         <td>{{$row1->N}}  </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme',['id'=>encrypt('N'),'id2'=>'ই মেইল'])}}"> তথ্য সংশোধন </a>
 </td></tr> 
                        
                         <tr>
		<td > @php
    

       echo '৯.এনআইডি';

       @endphp   </td>	
                         <td>   {{$row1->H }} </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme',['id'=>encrypt('H'),'id2'=>'এনআইডি'] )}}"> তথ্য সংশোধন </a>
 </td></tr>
                        
                         <tr>
		<td > @php
    

       echo '১০.লাইসেন্স প্রাপ্তির স্মারক';

       @endphp  </td>	
                         <td> {{ $row1->O}}
                           
                           </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('O'),'id2'=>'লাইসেন্স প্রাপ্তির স্মারক'])}}"> তথ্য সংশোধন </a>
 </td></tr> 
                         <tr>
		<td > @php
    

       echo '১১.লাইসেন্স প্রাপ্তির তারিখ';

       @endphp  </td>	
		 
	 
	 
				 
						 <td>   
                          {{$row1->Z}}
                           
                          </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('Z'),'id2'=>'লাইসেন্স প্রাপ্তির তারিখ'])}}"> তথ্য সংশোধন </a>
 </td> </tr> 

				 <tr>
		<td > @php
 
       echo '১২.লাইসেন্স স্থায়ী না অস্থায়ী';

       @endphp </td>	
                         <td> {{$row1->P}} </td><td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme',['id'=>encrypt('P'),'id2'=>'লাইসেন্স স্থায়ী না অস্থায়ী'] )}}"> তথ্য সংশোধন </a>
 </td> </tr> 
                                           
                         <tr>
		<td > @php
 
       echo '১৩.জেলা রেজিস্ট্রার বরাবর যোগদানের তারিখ';

       @endphp  </td>	
                         <td>  {{$row1->Q}}
                           
                           </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme',['id'=>encrypt('Q'),'id2'=>'জেলা রেজিস্ট্রার বরাবর যোগদানের তারিখ'])}}"> তথ্য সংশোধন </a>
 </td></tr> 
                        
                         <tr>
		<td > @php
 
       echo '১৪.ইনডেন্ট পাশের তারিখ';

       @endphp  </td>	
                         <td>    {{$row1->R}}
                           
                          </td><td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme',['id'=>encrypt('R'),'id2'=>'ইনডেন্ট পাশের তারিখ'] )}}"> তথ্য সংশোধন </a>
 </td> </tr>
                        
                         <tr>
		<td > @php
 
       echo '১৫.লাইসেন্স গেজেট  প্রকাশের তারিখ';

       @endphp   </td>	
                         <td>  {{ $row1->S}}
                           
                          </td>
                          <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('S'),'id2'=>'লাইসেন্স গেজেট  প্রকাশের তারিখ'])}}"> তথ্য সংশোধন </a>
 </td> </tr> 
                     
                         <tr>
		<td >@php
 
       echo '১৬.বয়স ৬৭ বছর পূর্তিতে লাইসেন্স অবসানের তারিখ';

       @endphp  </td>	
                         <td>   {{$row1->V}}
                            
                          </td><td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme',['id'=>encrypt('V'),'id2'=>'বয়স ৬৭ বছর পূর্তিতে লাইসেন্স অবসানের তারিখ'] )}}"> তথ্য সংশোধন </a>
 </td> </tr> 
                                           
                         <tr>
		<td > @php
    $kk=$loop->iteration;

       echo '১৭.চাকুরী';

       @endphp    </td>	
                         <td>{{$row1->W}}  </td> <td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('W'),'id2'=>'চাকুরী'])}}"> তথ্য সংশোধন </a>
 </td></tr> 
                        
                         <tr>
		<td >@php
 
       echo '১৮.স্থায়ী ঠিকানা ';

       @endphp    </td>	
                         <td>    {{$row1->J}}
                           
                           </td><td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme', ['id'=>encrypt('J'),'id2'=>'স্থায়ী ঠিকানা'])}}"> তথ্য সংশোধন </a>
 </td> </tr>
                        
                         <tr>
		<td >@php
 
       echo '১৯.কার্যালয়ের ঠিকানা'; 

       @endphp    </td>	
                         <td>  {{$row1->L}}
                            
                           </td><td>  <a class="btn btn-primary btn-sm" role="button" href="{{route('changeme',['id'=>encrypt('L'),'id2'=>'কার্যালয়ের ঠিকানা'])}}"> তথ্য সংশোধন </a>
 </td> </tr> 




















                
                @endforeach
             
        </table>
        
    </div>
  @endsection
