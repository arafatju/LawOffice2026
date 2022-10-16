@extends('common.appinfosr')
 
 
  
  
  
      
 
  
 @section('content')
 <div class="row  justify-content-center align-items-center " >

<div class="col"style="padding: 2rem 2rem;">

<div class="card w-75 text-center" style="background-color:purple;color:white;">
           
          
            
           <div class="card-body">
            তথ্য যাচাইকরণ 

           </div>
           <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{route('verificationinfo')}}">Click</a>

            </div>
</div>
</div>
<div class="col">
       <div class="card w-75 text-center" style="background-color:royalblue;color:white;">
           
          
            
           <div class="card-body">
            তথ্য প্রেরণ  

           </div>
           <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{route('sendtoict')}}">Click</a>

            </div>
       </div>


</div>

<div class="col">
       <div class="card w-75 text-center" style="background-color:royalblue;color:white;">
           
          
            
           <div class="card-body">
          Status 

           </div>
           <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{route('adminstatus')}}">Click</a>

            </div>
       </div>


</div>

<div class="col">
       <div class="card w-75 text-center" style="background-color:royalblue;color:white;">
           
          
            
           <div class="card-body">
        Loginfo

           </div>
           <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{route('srloguser')}}">Click</a>

            </div>
       </div>


</div>

</div> 
 @endsection