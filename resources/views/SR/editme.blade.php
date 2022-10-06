@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
           
        <thead>
                <tr class="table-success">
                <th scope="col">Serial </th>

                    <th scope="col">ফিল্ড   </th>
                    <th scope="col">বর্তমান তথ্য  </th>
                    <th scope="col">সংশোধিত  তথ্য  </th>
                    
                    <th scope="col">এন আই  ডি </th>
                    <th scope="col">Action  </th>
                    <th scope="col">তথ্য ঠিক আছে    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{ $data->heading }} </td>
                    <td>{{ $data->bortoman }}</td>
                    <td>{{ $data->after }}</td>
                    <td>{{ $data->nid }}</td>
                     
                    <td>  <a class="btn btn-danger" role="button" href="{{route('delme',encrypt($data->id))}}"> Delete </a>
 </td>        <td>         <a class="btn btn-primary" role="button" href="{{route('draftict')}}"> তথ্য ঠিক আছে   </a>
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
     
                 
           
                

