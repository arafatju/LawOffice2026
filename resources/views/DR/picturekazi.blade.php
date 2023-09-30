

@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-offset-1">
             <h2> {{Auth::user()->name}}'s Profile</h2>
            <form enctype="multipart/form-data" action="/changepicture" method="POST">
                @csrf
                <label > File size should be equal or less than 100 kb </label>
                <input type="file" name="avatar">
                 <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>

 @endsection
