@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
             
        <thead>
                <tr class="table-success">
                <th scope="col">Serial </th>

                    <th scope="col">নাম   </th>
                    <th scope="col">পিতার নাম   </th>
                    <th scope="col"> মাতার নাম </th>
                    
                    <th scope="col">এন আই  ডি </th>
                    <th scope="col">ছবি  </th>
                    <th scope="col">Update  </th>
                </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$data->id}}</th>
                    <td> {{ $data->district }} </td>
                    <td>{{ $data->nid }}</td>
                     
                    <td>{{ $data->time }}</td>
                     <td>  <a href="{{asset('/upload/kazi/papers/'.$data->avatar)}}"   >view</a>
   </td>
                 <td>
                 <a class="btn btn-sm  btn-outline-dark" role="button" href="{{route('deliddr',encrypt($data->id))}}"> Delete </a>
 
                
                
                
                </td>
                <td>
                 <a class="btn btn-sm  btn-outline-dark" role="button" href="{{route('delsend',encrypt($data->id))}}"> Send </a>
 
                
                
                
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
         
        <div class="d-flex justify-content-center">
            {!! $draftdata->links() !!}
        </div>
    </div>
  @endsection
     
                 
           
                

