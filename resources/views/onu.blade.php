 
@extends('master')
 
 
  
  
  
      
 
  
 @section('content')
 


 
<div class="card text-center">
   			    
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
  
          </div>
        @endsection


