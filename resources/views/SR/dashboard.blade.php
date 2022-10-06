@extends('common.appinfosr')
 
 
  
  
  
      
 
  
 @section('content')
 <div class="row  justify-content-center align-items-center " >

<div class="col-md-6 col-md-offset-4 ">

<div class="card  text-center" style="background-color:purple;color:white;">
           
          
            
           <div class="card-body">
            তথ্য যাচাইকরণ 

           </div>
           <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{route('showkazi')}}">Click</a>

            </div>
       </div>

       <div class="card  text-center" style="background-color:purple;color:white;">
           
          
            
           <div class="card-body">
            তথ্য প্রেরণ  

           </div>
           <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{route('showkazi')}}">Click</a>

            </div>
       </div>


</div>
 </div> 
 @endsection