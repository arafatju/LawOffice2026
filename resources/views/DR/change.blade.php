

@extends('common.appinfo')
 
 
  
  
  
      
 
  
 @section('content')



 <div class="row mt-4">
    <div class="col ">
        <div class="card  text-center" style="background-color:#CD6155;">
            <div class="card-header">
            ঢাকা
            </div>
            <div class="card-body">
            মোট বিবাহ নিবন্ধকের সংখ্যা:১২৯৫  
            </div>
            <div class="card-footer">
              <a class="btn btn-dark" role="button" href="{{route('okchange')}}">বিস্তারিত</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card   text-center" style="background-color:green;" >
            <div class="card-header">
            ময়মনসিংহ
            </div>
            <div class="card-body">
            মোট বিবাহ নিবন্ধকের সংখ্যা:৪২২  

            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('details')}}">বিস্তারিত</a>

            </div>
        </div>
    </div>
</div>

   
 @endsection
