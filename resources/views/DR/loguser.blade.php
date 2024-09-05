@extends('common.dr')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
           
        <thead>
                <tr class="table-success">
                <th scope="col">Serial </th>
                <th scope="col">জেলা    </th>

                    <th scope="col">Device   </th>
                    <th scope="col">Location </th>
                    <th scope="col">Browser  </th>
                    
                    <th scope="col">Time </th>
                    <th scope="col">Email </th>
                    <th scope="col">Mobile   </th>
                </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{ $data->district }} </td>

                    <td> {{ $data->Device }} </td>
                    <td>{{ $data->Location }}</td>
                    <td>{{ $data->Browser }}</td>
                    <td>{{ $data->time }}</td>
                    <td>{{ $data->mail }}</td>
                    <td>{{ $data->mobile }}</td>
                 
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
     
                 
           
                

