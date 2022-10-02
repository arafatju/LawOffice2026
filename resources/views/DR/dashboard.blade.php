@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 <div class="row mt-4"style="padding: 2rem 2rem;">
    <div class="col ">
        <div class="card  text-center text-white" style="background-color:#CD6155;padding:2rem 0 rem;">
            <div class="card-header">
            Draft
            </div>
            <div class="card-body">
            Total Draft:0  
            </div>
            <div class="card-footer">
              <a class="btn btn-dark" role="button" href="{{route('okchange')}}">Click</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card   text-center text-white" style="background-color:green;" >
            <div class="card-header">
            Data Upload
            </div>
            <div class="card-body">
            Total File for Upload:0  

            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('dataone')}}">Click</a>

            </div>
        </div>
    </div>
    <div class="col">
        <div class="card  text-center" style="background-color:Olive;color:white;">
            <div class="card-header">
            Status
            </div>
            <div class="card-body">
            Status:0
            Updated:0
            Cancelled:0
            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('details')}}">Click</a>
 
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card  text-center" style="background-color:purple;color:white;">
            <div class="card-header">
            Log Book
            </div>
            <div class="card-body">
            Log info:0 
            Draft info:0
            Edit info: 0

            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('details')}}">Click</a>

             </div>
        </div>
    </div>

</div> 
 @endsection