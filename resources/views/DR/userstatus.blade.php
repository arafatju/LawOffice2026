@extends('common.appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
        <thead>
                <tr>
                    <th colspan="6">
                   Status 
                    </th>
                </tr>
                </thead>    
        <thead>
                <tr class="table-success">
                <th scope="col">ID1 </th>
                <th scope="col">ID2</th>
                <th scope="col">জেলা    </th>
                <th scope="col">Action   </th>
                    <th scope="col">Status   </th>
                    
                    <th scope="col">time   </th> 
                </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    
                    <td> {{ $data->id1 }} </td>

                    <td> {{ $data->id_user }} </td>
                    <td>{{ $data->district }}</td>
                    <td>{{ $data->action }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->time }}</td>
                    
                 
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
     
                 
           
                

