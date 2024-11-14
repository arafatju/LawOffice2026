    
 @extends('common.dr')
  
 @section('content')
 
 <div class="row d-flex justify-content-center">

       <div class="card w-25 text-center mx-2" style="background-color:purple; color:white;">
         <div class="card-title">তথ্য যাচাইকরণ</div>
         <div class="card-body">
           <div>মোট আবেদনের সংখ্যা: ১২৩২২</div>
           <div>অনুমোদন এর অপেক্ষায়: ২৩</div>
           <div>গৃহীত: ১২৩</div>
         </div>
         <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{ route('verificationinfo') }}">Click</a>
         </div>
       </div>
     
       <div class="card w-25 text-center mx-2" style="background-color:royalblue; color:white;">
         <div class="card-title">ব্যবহারকারী অনুমোদন</div>
         <div class="card-body">
           <div>অনুমোদন এর অপেক্ষায়: ২৩</div>
           <div>গৃহীত ব্যবহারকারী: ১২৩</div>
         </div>
         <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{ route('sendtoict') }}">Click</a>
         </div>
       </div>
     
     </div>
     
 

 

 
 @endsection