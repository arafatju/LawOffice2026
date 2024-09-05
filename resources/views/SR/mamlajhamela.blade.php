@extends('common.sr')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
             
        <thead>
                <tr class="table-success">
                

                    <th scope="col">নাম   </th>
                    <th scope="col">পিতার নাম   </th>
                    <th scope="col">মাতার নাম   </th>
                    
                    <th scope="col">মোবাইল </th>
                    <th scope="col">Mamla  </th>
                  </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$data->name}}</th>
                    <td> {{ $data->father }} </td>
                    <td>{{ $data->mother }}</td>
                
                   
                     <td> {{ $data->mobile}}   </td>
                     <td> {{ $data->mamla}}   </td>
                 
                 
                 
                </tr>
                @endforeach
            </tbody>
        </table>
         
        <div class="d-flex justify-content-center">
            {!! $draftdata->links() !!}
        </div>
    </div>
  @endsection
     
                 
           
                

