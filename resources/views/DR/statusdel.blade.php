

@extends('common.dr')
 
 
  
  
  
      
 
  
 @section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-offset-1">
             <h5> আপনি যে কারণে তথ্য ডিলিট করতে চাচ্ছেন সংশ্লিষ্ট কাগজ পত্র আপলোড করবেন । অবশয়ই  পিডিএফ ফরম্যাটে হতে হবে এবং ০১ মেগাবাইটের বেশি হওয়া যাবে না । একাধিক ফাইল থাকলে  মারজ করে একটি ফাইলে নিয়ে আসুন । </h5>
            <form enctype="multipart/form-data" action="/statusdel" method="POST">
                @csrf
                <label > Upload </label>
                <input type="file" name="avatar">
                 <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>

 @endsection
