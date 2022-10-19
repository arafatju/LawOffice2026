@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
        <thead>
                <tr>
                    <th colspan="6">
                    বিবাহ নিবন্ধগনের তথ্য সংশোধন আবেদন
                    </th>
                </tr>
                </thead>
        <thead>
                <tr class="table-success">
                <th scope="col">Serial </th>

                    <th scope="col">ফিল্ড   </th>
                    <th scope="col">বর্তমান তথ্য  </th>
                    <th scope="col">সংশোধিত  তথ্য  </th>
                    
                    <th scope="col">এন আই  ডি </th>
                    <th scope="col">Action  </th>
 
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
                     
                    <td>  <a class="btn btn-danger" role="button" href="{{route('deleteme',encrypt($data->id))}}"> Delete </a>
 </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
        <a class="btn btn-primary" role="button" href="{{route('finalchange')}}"> Send  </a>
</div>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $draftdata->links() !!}
        </div>
    </div>
  @endsection
     
                 
           
                

