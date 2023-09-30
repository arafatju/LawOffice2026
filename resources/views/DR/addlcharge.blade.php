@extends('common.appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
        
        <thead>
                <tr>
                    <th colspan="7">
                    বিবাহ নিবন্ধক  গনের অতিরিক্ত দায়িত্ব প্রদান 
                    </th>
                </tr>
                </thead>
        <thead>
                <tr class="table-success">
               

                    <th scope="col">নাম   </th>
                    <th scope="col">পিতার নাম   </th>
                    <th scope="col"> মাতার নাম </th>
                    
                    <th scope="col">বর্তমান অধিক্ষেত্র  </th>
                    <th scope="col">অতিরিক্ত দায়িত্ব  </th>
                    <th scope="col">Related Documents  </th>
                    <th scope="col">Action </th>
                </tr>
            </thead> 
            <form enctype="multipart/form-data" action="/addlduty" method="POST">
                @csrf

               
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$data->D}}</th>
                    <td> {{ $data->E }} </td>
                    <td>{{ $data->F }}</td>
                     
                    <td>{{ $data->A }}</td>
                     <td>   
                <input type="text" name="charge">  
                <input type="hidden" name="name" value="{{ $data->D}}"> 
                <input type="hidden" name="bortoman" value="{{ $data->A}}" > 
              
                </td>
                 <td>
                 
                
                
                <input type="file" name="avatar">
                 
                
                </td>
                <td>
  
                <input type="submit" class="  btn btn-sm btn-primary" value="Draft">
        
                
                
                </td>
                </tr>
                @endforeach
            </tbody>
            </form>
        </table>
         
         
    </div>
  @endsection
     
                 
           
                

