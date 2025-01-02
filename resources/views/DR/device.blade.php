@extends('common.test')

@section('content')
<div class="container   d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4   ">
      
            <h1 class="h3 mb-3 fw-normal text-center w-100">Device Registration(You can choose either one)</h1>
   <div class="col-md-4 mb-2 w-100">
             
           <a href="{{route('sendotp')}}"class="btn btn-primary">Send OTP</a> </div>  <div class="col-md-4 mb-2 w-100">
           <a href="{{route('special11')}}"class="btn btn-primary">Special Code</a> 
   </div>
        </div>
</div>
@endsection
