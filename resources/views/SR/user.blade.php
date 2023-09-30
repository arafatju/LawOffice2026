

@extends('common.appinfosr')
 
 
  
  
  
      
 
  
 @section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-offset-1">
            <img src="upload/SR/{{Auth::user()->avatar}}" class="rounded-circle" style="width:150px;height:150px;float:left;boarder-radius:50%;"/>
            <h2> {{Auth::user()->name}}'s Profile</h2>
            <form enctype="multipart/form-data" action="/profilesr" method="POST">
                @csrf
                <label > Upload </label>
                <input type="file" name="avatar">
                 <input type="submit" class="pull-right btn btn-sm btn-primary">
            </form>
        </div>
    </div>
</div>

 @endsection
