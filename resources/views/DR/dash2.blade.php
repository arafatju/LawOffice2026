    
 @extends('common.dr')
  
 @section('content')
 
 <div class="row d-flex justify-content-center">

       
     
       <div class="card w-25 text-center mx-2" style="background-color:royalblue; color:white;">
         <div class="card-title">ব্যবহারকারী অনুমোদন</div>
         <div class="card-body">
         <div>অনুমোদন এর অপেক্ষায়:
           @php 
                            echo  App\Http\Controllers\ConverterController::bangladate11($user_number);
                             @endphp 
           
            </div>
           <div>গৃহীত ব্যবহারকারী: @php 
                            echo  App\Http\Controllers\ConverterController::bangladate11($count_accept);
                             @endphp </div>
         </div>
         <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{ route('finaluser') }}">Click</a>
         </div>
       </div>
     
     </div>
     
 

 

 
 @endsection