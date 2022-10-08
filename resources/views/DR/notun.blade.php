
@extends('appinfo')
 
 
  
 
               
      
 
  
 @section('content')

 
<div class="container mt-5">
<form enctype="multipart/form-data" action="/notuninfo" method="POST">
                @csrf
        <table class="table ">
           
                 
                 
           
               


		    
      	
        
		<tr  >
		        <td > 
      
                         @php
                        echo '১.নাম';

                         @endphp
    
                 </td>	
		        <td>    <input type="text" name="name">  
                </td>  
        </tr> 

		<tr>
		         <td >  @php
 
                         echo '২.পিতার নাম';

                         @endphp
                 </td>	
                          
                 <td>     <input type="text" name="father">  
                </td> 
        </tr> 
                                           
        <tr>
		        <td > @php
 
                        echo  '৩.মাতার নাম';
                        @endphp   
                </td>	
                <td>     
                    <input type="text" name="mother"> 
                </td>
        </tr> 
                        
        <tr>
		
        <tr>
		        <td > @php
 
                    echo  '৪.উপজেলা ';

                    @endphp   
                </td>	
                          
                <td>   
                    <select name="upojela" >
                    @foreach($upojela as $row1)
                    <option>{{$row1->B}} </option>
                    @endforeach
                    </select>

                </td>
            </tr> 
                        
                          
            <tr>
		        <td > @php
 
       echo  '৫.পৌরসভা/সিটি কর্পোরেশন';

       @endphp   </td>	
                         <td><select name="pourosova" >
                         @foreach($pourosova as $row2)    
                         <option>{{$row2->Y}} </option>
                         @endforeach  
                            </select>  </td>  </tr> 
                        
                         
                         <tr>
        
        
                         <td > @php
 
       echo '৭.অধিক্ষেত্র ';

       @endphp   </td>	
                         <td> <input type="text" name="area"> </td>  </tr>
                        
                         <tr>
		<td > @php
 
       echo '৮.জন্ম তারিখ';

       @endphp   </td>	
                         <td>                             
                         <input type="text" name="dob"> 
                           
                           
                        
                        </td> <td>   </td></tr> 
        
                         <tr>
		<td >@php
 
       echo '১০.শিক্ষাগত যোগ্যতা';

       @endphp   </td>	
		 
	 
	 
				 
						 <td> <input type="text" name="education">  </td>  </tr> 

				 <tr>
		<td > @php
 
       echo '১১.মোবাইল';

       @endphp </td>	
                         <td>   <input type="text" name="mobile"> 
                          </td>  </tr> 
                                           
                         <tr>
		<td > @php
     

       echo '১২.ই মেইল';

       @endphp   </td>	
                         <td><input type="text" name="email">  </td> </tr> 
                        
                         <tr>
		<td > @php
    

       echo '১৩.এনআইডি';

       @endphp   </td>	
                         <td>  <input type="text" name="nid"> </td>  </tr>
                        
                         <tr>
		<td > @php
    

       echo '১৪.লাইসেন্স প্রাপ্তির স্মারক';

       @endphp  </td>	
                         <td> <input type="text" name="dategot"> 
                           
                           </td>  </tr> 
                         <tr>
		<td > @php
    

       echo '১৫.লাইসেন্স প্রাপ্তির তারিখ';

       @endphp  </td>	
		 
	 
	 
				 
						 <td>   
                         <input type="text" name="datelicense"> 
                           
                          </td>   </tr> 

				 <tr>
		<td > @php
 
       echo '১৬.লাইসেন্স স্থায়ী না অস্থায়ী';

       @endphp </td>	
                         <td> <select  name="statuslicense">  
                          <option>স্থায়ী</option>
                          <option>অস্থায়ী</option>
                          </select>
                         </td>  </tr> 
                                           
                         <tr>
		<td > @php
 
       echo '১৭.জেলা রেজিস্ট্রার বরাবর যোগদানের তারিখ';

       @endphp  </td>	
                         <td>  <input type="text" name="join"> 
                           
                           </td>  </tr> 
                        
                         <tr>
		<td > @php
 
       echo '১৮.ইনডেন্ট পাশের তারিখ';

       @endphp  </td>	
                         <td>   <input type="text" name="indent"> 
                           
                          </td>  </tr>
                        
                         <tr>
		<td > @php
 
       echo '১৯.লাইসেন্স গেজেট  প্রকাশের তারিখ';

       @endphp   </td>	
                         <td>  <input type="text" name="gazetdate"> 
                           
                          </td>
                          </tr> 
                     
                         <tr>
		<td >@php
 
       echo '২০.বয়স ৬৭ বছর পূর্তিতে লাইসেন্স অবসানের তারিখ';

       @endphp  </td>	
                         <td>  <input type="text" name="expired"> 
                            
                          </td>  </tr> 
                                           
                         <tr>
		<td > @php
 
       echo '২১.চাকুরী';

       @endphp    </td>	
                         <td><select  name="jobdo">  
                            <option>হ্যা  </option>                          
                               <option>না   </option>

                            </select>
                         </td> 
                        
        </tr> 
                        
                        
        <tr>
		            <td > @php
 
                    echo  '২২.প্রতিষ্ঠানের নাম';

                    @endphp   
                    </td>	
                    <td> <input type="text" name="jobname">   </td>  </tr> 
                        
                         
                        
                         <tr>

            
		<td >@php
 
       echo '২৩.স্থায়ী ঠিকানা ';

       @endphp    </td>	
                         <td>   <input type="text" name="permanent"> 
                           
                           </td>  </tr>
                        
                         <tr>
		<td >@php
 
       echo '২৪.কার্যালয়ের ঠিকানা'; 

       @endphp    </td>	
                         <td>  <input type="text" name="office"> 
                            
                           </td>  </tr> 


         

                           <tr>
		<td >@php
 
       echo '২৫.বর্তমান ঠিকানা'; 

       @endphp    </td>	
                         <td>  <input type="text" name="present"> 
                            
                           </td>  </tr> 

                           <tr>
		<td >@php
 
       echo '২৬.ধর্ম  '; 

       @endphp    </td>	
                         <td>  <select name="religion">
                            <option> Islam </option>
                            <option> Hindu </option>
                            <option> Special </option>
                                </select>
                            
                           </td>  </tr> 

               <tr> 
                        <td> Draft
                        </td>
                        <td>     
                 <input type="submit" class=" btn btn-sm btn-primary">
         
                        </td>

                </tr>


                
         
             
        </table>
        </form>
    </div>
  @endsection
