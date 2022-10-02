		

      
@extends('master')
 
 
  
  
  
      
 
  
 @section('content')
 
<div class="row justify-content-center align-items-center">
		<div class="col-md-4 col-md-offset-4">
       <div class="card" style="top:60px;">

         <div class="card-header text-primary text-center"> 
 			    	<h3 >আপনার সিটি কর্পোরেশন নির্বাচন করুন   </h3>

          </div>
          <div class="card-body">
  			    	<form action="{{route('cityward')}}" method="POST" accept-charset="UTF-8" role="form">
                             @csrf
			    <select name="city" placeholder="office" id="office" class="form-control input-lg" text-align="center">
					 
                <option>ঢাকা উত্তর সিটি কর্পোরেশন
            </option>
		  <option>ঢাকা দক্ষিণ সিটি কর্পোরেশন</option>
          <option>গাজীপুর  সিটি কর্পোরেশন </option>
          <option> নারায়ণগঞ্জ  সিটি কর্পোরেশন </option>

		  <option>ময়মনসিংহ সিটি কর্পোরেশন</option>
		  <option>বরিশাল সিটি কর্পোরেশন</option>
		  <option>রংপুর সিটি কর্পোরেশন</option>
		  <option>রাজশাহী সিটি কর্পোরেশন</option>
		  <option>সিলেট সিটি কর্পোরেশন</option>
		  <option>চট্টগ্রাম সিটি কর্পোরেশন</option>
		 <option>খুলনা সিটি কর্পোরেশন</option>
		 <option>কুমিল্লা সিটি কর্পোরেশন</option>

                  </select>
 			    		  
          </div>
          <div class="card-footer text-center">
			    		<input class="btn btn-sm btn-primary btn-block" type="submit" value="Submit">
 			      	</form>
 		      </div>
          </div>

	</div>
</div>
          @endsection