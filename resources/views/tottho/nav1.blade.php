@extends('master')
 
 
  
  
  
      
 
  
 @section('content')
 <div style="margin-left:80px;">
    <div class="row justify-content-center align-items-center">
		<div class="col-md-4 col-md-offset-4">
    		 
        </br></br></br> <a class="btn btn-success" role="button" href="{{route('bivag', 1)}}" > সম্পূর্ণ  তালিকা </a>   </br></br> <a class="btn btn-success" role="button" href="{{route('bivag', 2)}}" > মুসলিম বিবাহ নিবন্ধক গনের  তালিকা </a> </br> </br> <a class="btn btn-success" role="button"href="{{route('bivag', 3)}}" > হিন্দু বিবাহ নিবন্ধক গনের  তালিকা </a></br> </br> <a class="btn btn-success" role="button" href="{{route('bivag', 4)}}" >  বিশেষ বিবাহ নিবন্ধক গনের  তালিকা </a></br> </br> 
		<a class="btn btn-success" role="button" href="{{route('city')}}" >  সিটি কর্পোরেশন ভিত্তিক তালিকা  </a>	
	
	</div>
	</div>
</div>  
 @endsection
 

 
 
 
 
 
