@extends('common.appinfoar')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
           
        <thead>
                <tr class="table-success">
                <th scope="col">Serial </th>
               
                <th scope="col">Name   </th>
                <th scope="col">Designation  </th>
                <th scope="col">জেলা    </th>
                    <th scope="col">Device   </th>
                    <th scope="col">Location </th>
                    <th scope="col">Email </th>
                    <th scope="col">Mobile   </th>
                   
                   
                    <th scope="col">Role   </th>
                    <th scope="col">picture   </th>


                </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{ $data->name }} </td>

                    <td> {{ $data->Designation }} </td>
                    <td>{{ $data->District }}</td>
                    <td>{{ $data->Device }}</td>
                    <td>{{ $data->Location }}</td>
                    <td>{{ $data->email }}</td> 
                    <td>{{ $data->mobile }}</td>
                    

                    <td>{{ $data->role }}</td>
                     <td>  <img src="/upload/DR/{{$data->avatar}}" class="rounded-circle" style="width:32px;height:32px;boarder-radius:50%;"/>
   </td>
   <td>  <a class="btn btn-danger" role="button" href="{{route('rolechange',['district'=>$data->District ,'mobile'=>$data->mobile ,'email'=>$data->email])}}"> Change </a>
       </td>
       <td>  <a class="btn btn-danger" role="button" href="{{route('deluser',$data->mobile)}}"> Delete </a>
 </td>
                </tr>
                @endforeach
            </tbody>
        </table>
         
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $draftdata->links() !!}
        </div>
    </div>
  @endsection
     
                 
           
                

