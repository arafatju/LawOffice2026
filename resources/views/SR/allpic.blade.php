@extends('common.appinfosr')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
             
        <thead>
                <tr class="table-success">
                <th scope="col">Serial </th>

                    <th scope="col">District  </th>
                    <th scope="col">Picture number  </th>
                    <th scope="col">Details  </th>
                </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{ $data->district }} </td>
                    <td> 
                    @php 
                    $ffgg=App\Http\Controllers\CountController::piccount($data->district);
                    echo App\Http\Controllers\ConverterController::en2bn($ffgg);
@endphp


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
     
                 
           
                

