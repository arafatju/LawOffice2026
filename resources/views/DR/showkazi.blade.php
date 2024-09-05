@extends('common.dr')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
        <thead>
                <tr>
                    <th colspan="7">
                    বিবাহ নিবন্ধগনের  ছবি সংযজন 
                    </th>
                </tr>
                </thead>    
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
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{ $data->name }} </td>
                    <td>{{ $data->father }}</td>
                    <td>{{ $data->mother }}</td>
                    <td>{{ $data->nid }}</td>
                     
                    <td> <a href="/upload/kazi/picture/{{$data->picture}}"   > <img src="/upload/kazi/picture/{{$data->picture}}" class="rounded-circle" style="width:32px;height:32px;boarder-radius:50%;"/></a>
   </td>
                 <td>
                 <a class="btn btn-sm  btn-outline-dark" role="button" href="{{route('changepicturekazi',encrypt($data->nid))}}"> ছবি  পরিবর্তন </a>
 
                
                
                
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
     
                 
           
                

