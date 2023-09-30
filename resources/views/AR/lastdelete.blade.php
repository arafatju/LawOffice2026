@extends('common.appinfoar')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
             
        <thead>
                <tr class="table-success">
                <th scope="col">Serial </th>

                    
                    
                    <th scope="col">এন আই  ডি </th>
                    <th scope="col"> জেলা </th>
                    <th scope="col">Documents </th>

                    
                    
<th scope="col">Delete </th>
<th scope="col"> Send </th>
                </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{ $data->nid }} </td>
                    <td>{{ $data->district }}</td>
                     
                    
                     <td>  <a href="{{asset('/upload/kazi/papers/'.$data->avatar)}}"   >view</a>
   </td>
   <td>  <a class="btn btn-danger" role="button" href="{{route('admindel',['name'=>'activitydel','id'=>encrypt($data->id)])}}"> Delete </a>
 </td>        <td>  <a class="btn btn-danger" role="button" href="{{route('publish',['name'=>'activitydel','id'=>encrypt($data->id)])}}"> publish </a>
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
     
                 
           
                

