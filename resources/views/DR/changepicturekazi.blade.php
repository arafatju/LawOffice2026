

@extends('common.dr')
 
 
  
  
  
      
 
  
 @section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-offset-1">
             <h2> {{Auth::user()->name}}'s Profile</h2>
            <form enctype="multipart/form-data" action="/updatepicturekazi" method="POST">
                @csrf
                <label > ছবি অবশ্যই ১০০ kb অথবা এর কম হতে হবে । এর বেশি হলে আপলোড হবে না ।  </label>
                <input type="file" name="avatar">
                 <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>

 @endsection
