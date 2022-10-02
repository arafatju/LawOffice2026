
@extends('master')
 
 
  
  
  
      
 
  
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
              <a class="btn btn-dark" role="button" href="{{route('details')}}">বিস্তারিত</a>
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
    <div class="col">
        <div class="card  text-center" style="background-color:Olive;color:white;">
            <div class="card-header">
            সিলেট
            </div>
            <div class="card-body">
            মোট বিবাহ নিবন্ধকের সংখ্যা:৪২৮  

            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('details')}}">বিস্তারিত</a>
 
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card  text-center" style="background-color:purple;color:white;">
            <div class="card-header">
            রাজশাহী
            </div>
            <div class="card-body">
            মোট বিবাহ নিবন্ধকের সংখ্যা:৭৫২  

            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('details')}}">বিস্তারিত</a>

             </div>
        </div>
    </div>

</div>    


<div class="row mt-4">
    <div class="col ">
        <div class="card  text-center" style="background-color:#F0B27A ;">
            <div class="card-header">
            খুলনা
            </div>
            <div class="card-body">
            মোট বিবাহ নিবন্ধকের সংখ্যা:৭২৩  

            </div>
            <div class="card-footer">
            <a class="btn btn-success" role="button" href="{{route('details')}}">বিস্তারিত</a>

            </div>
        </div>
    </div>
    <div class="col">
        <div class="card   text-center" style="background-color:#9C640C ;" >
            <div class="card-header">
            বরিশাল
            </div>
            <div class="card-body">
            মোট বিবাহ নিবন্ধকের সংখ্যা:৪৫৮  

            </div>
            <div class="card-footer">
            <a class="btn btn-success" role="button" href="{{route('details')}}">বিস্তারিত</a>

            </div>
        </div>
    </div>
    <div class="col">
        <div class="card  text-center" style="background-color:#16A085;color:white;">
            <div class="card-header">
            রংপুর
            </div>
            <div class="card-body">
            মোট বিবাহ নিবন্ধকের সংখ্যা:৭১৬  

            </div>
            <div class="card-footer">
            <a class="btn btn-success" role="button" href="{{route('details')}}">বিস্তারিত</a>

            </div>
        </div>
    </div>
    <div class="col">
        <div class="card  text-center" style="background-color:#21618C ;color:white;">
            <div class="card-header">
            চট্টগ্রাম
            </div>
            <div class="card-body">
            মোট বিবাহ নিবন্ধকের সংখ্যা:১১১৬  
           
            </div>
            <div class="card-footer">
            <a class="btn btn-success" role="button" href="{{route('details')}}">বিস্তারিত</a>

            </div>
        </div>
    </div>

</div>  
 @endsection