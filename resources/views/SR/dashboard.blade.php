@extends('common.appinfosr')
 
 
  
  
  
      
 
  
 @section('content')

 <div class="row mt-4"style="padding: 2rem 2rem;">
    <div class="col ">
        <div class="card  text-center text-white" style="background-color:#CD6155;padding:2rem 0 rem;">
            <div class="card-header">
            Verification
            </div>
            <div class="card-body">
            Total Draft:0  
            </div>
            <div class="card-footer">
              <a class="btn btn-dark" role="button" href="{{route('verifychange')}}">Click</a>
            </div>
        </div>
    </div>
     

</div> 
 @endsection