 
@extends('appinfo')
 
 
  
 
               
      
 
  
 @section('content')

 
<div class="container mt-5">

<div class="d-flex justify-content-end p-1">
<a class="btn btn-outline-primary" role="button" href="{{route('mamladashboard')}}"> মামলা ড্যাশবোর্ড  </a>
     
</div>

<div class="d-flex justify-content-center">
<h1>
মামলা  সঙ্ক্রান্ত তথ্যাদি পূরণ করুন </h1>

<form enctype="multipart/form-data" action="/mamlainfo" method="POST" >
                @csrf
        <table class="table " style="width:100%;">
           
                 
                 
           
               


<thead>

</thead>
      	
        
		    <tr>
		             <td > 
      
                         @php
                        echo '১.নাম';

                         @endphp
    
                 </td>	
		              <td>   
                     <input type="text" class="form-control" name="name">  
                  </td>  
         
		              <td >  @php
 
                         echo '২.পিতার নাম';

                         @endphp
                  </td>	
                          
                  <td>    
                    <input type="text" class="form-control" name="father">  
                  </td> 
        </tr> 
                                           
        <tr>
		              <td > @php
 
                        echo  '৩.মাতার নাম';
                        @endphp   
                  </td>	
                  <td>     
                    <input type="text" class="form-control"name="mother"> 
                  </td>
         
                        
         
		              <td > @php
 
                  echo  '৪.উপজেলা ';

                  @endphp   
                  </td>	
                          
                  <td>   
                  <select name="upojela" class="form-control">
                    @foreach($upojela as $row1)
                  <option>{{$row1->Thana}} </option>
                    @endforeach
                  </select>

                  </td>
            </tr> 
                        
                          
            <tr>
		               <td > @php
 
                         echo  '৫.পৌরসভা/সিটি কর্পোরেশন';

                         @endphp  
                    </td>	
                    <td>
                        <select name="pourosova" class="form-control">
                         @foreach($pourosova as $row2)    
                         <option>{{$row2->Pourosova_City_Corporation}} </option>
                         @endforeach  
                            </select>  
                      </td>  
             
                        
                      <td > @php
 
                            echo '৬.অধিক্ষেত্র ';

                              @endphp  
                        </td>	
                        <td> 
                               <input type="text" name="area"> 
                          </td>  
              </tr>
                        
               <tr>
	                    	<td > @php
 
                             echo '৭.জন্ম তারিখ';

                             @endphp  
                         </td>	
                         <td>                             
                         <input type="text" name="dob"> 
                           
                           
                        
                        </td> 
                         <td > @php
 
                                echo '৮.মোবাইল';

                                  @endphp 
                          </td>	
                          <td>   
                                <input type="text" name="mobile"> 
                          </td>  
		 
		 
	 
	 
				 
						      </tr> 

				          <tr>
		 
	 
                         
		                    <td > @php
    

                               echo '৯.এনআইডি';

                                  @endphp  
                         </td>	
                         <td>  
                              <input type="text" name="nid"> 
                          </td>  
	                        <td > @php
    

                                echo '১০.লাইসেন্স প্রাপ্তির স্মারক';

                                 @endphp 
                           </td>	
                           <td> 
                                  <input type="text" name="dategot"> 
                           
                           </td> 
                     </tr> 
                      
                   <tr>

            
		                        <td >@php
 
                                echo '১১.স্থায়ী ঠিকানা ';

                                   @endphp   
                             </td>	
                             <td>   
                                  <input type="text" name="permanent"> 
                           
                              </td>   
	 
                               
	                        	<td >@php
 
                                 echo '১২.ধর্ম  '; 

                                @endphp    
                            </td>	
                            <td> 
                                  <select name="religion">
                                  <option> Islam </option>
                                  <option> Hindu </option>
                                  <option> Special </option>
                                   </select>
                      
                            </td> 
                            
                </tr> 

               <tr>
                           <td>
                          
                                 @php
 
                                 echo '১৩.মামলার বিষয়';

                                  @endphp 
                         
                         
                           </td>
                          
                          
                          <td colspan="3">
                          <input type="textarea" name="mamla"> 

                            
                            </td>
                </tr>
         

                          

               <tr> 
                         
                        <td colspan="4">     
                 <input type="submit" class=" btn btn-sm btn-primary"value="Draft">
         
                        </td>

                </tr>


                
         
             
        </table>
        </form>
 </div>
    </div>
  @endsection
