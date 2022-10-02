 


@extends('master')
 
 
  
  
  
      
 
  
 @section('content')
<div class="row justify-content-center align-items-center">
		<div class="col-md-4 col-md-offset-4">
       <div class="card" style="top:60px;">

         <div class="card-header text-primary text-center"> 
 			    	<h3 >আপনার বিভাগ নির্বাচন করুন   </h3>

          </div>
          <div class="card-body">
  			    	<form action="{{route('jela')}}" method="POST" accept-charset="UTF-8" role="form">
                             @csrf
			    <select name="bivag"  placeholder="office" id="office" class="form-select" text-align="center">
							
                      <option>রাজশাহী</option>
		                  <option>খুলনা</option>
		                  <option>ময়মনসিংহ</option>
		                  <option>বরিশাল</option>
		                  <option>রংপুর</option>
		                  <option>ঢাকা</option>
		                  <option>সিলেট</option>
		                  <option>চট্টগ্রাম</option>
		 
		 
                  </select>
 			    		  
          </div>
          <div class="card-footer text-center">
			    		<input class="btn btn-sm btn-primary btn-block" type="submit" value="Submit">
 			      	</form>
 		      </div>
          </div>

	</div>
</div>
          </div>






 @endsection

