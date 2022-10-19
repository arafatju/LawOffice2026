@extends('common.appinfosr')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
        <thead>
                <tr>
                    <th colspan="8">
                    বিবাহ নিবন্ধগনের নতুন তথ্য  
                    </th>
                </tr>
                </thead>
        <thead>
                <tr class="table-success">
                <th scope="col">Serial </th>
                <th scope="col">জেলা    </th>

                    <th scope="col">নাম   </th>
                    <th scope="col">অধিক্ষেত্র   </th>
                    <th scope="col">এনাইডি   </th>
                    
                    <th scope="col">view  </th>
                    <th scope="col">Action  </th>
                    <th scope="col">তথ্য ঠিক আছে    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{ $data->district }} </td>

                    <td> {{ $data->name }} </td>
                    <td>{{ $data->area }}</td>
                    
                    <td>{{ $data->nid }}</td>
                    <td>  <a class="btn btn-danger" role="button" href="{{route('notunview',['name'=>'activitynew','id'=>encrypt($data->nid)])}}"> view </a>
 </td> 
                    <td>  <a class="btn btn-danger" role="button" href="{{route('overalldel',['name'=>'activitynew','id'=>encrypt($data->id)])}}"> Delete </a>
 </td>        <td>  <a class="btn btn-danger" role="button" href="{{route('overallverification',['name'=>'activitynew','id'=>encrypt($data->id)])}}"> তথ্য ঠিক আছে  </a>
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
     
                 
           
                

