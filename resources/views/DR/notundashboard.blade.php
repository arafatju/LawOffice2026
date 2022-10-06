@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
             
        <thead>
                <tr class="table-success">
                

                    <th scope="col">নাম   </th>
                    <th scope="col">পিতার নাম   </th>
                    <th scope="col">মাতার নাম   </th>
                    
                    <th scope="col">মোবাইল </th>
                    <th scope="col">Delete  </th>
                    <th scope="col">Send  </th>
                    <th scope="col">Details  </th>
                </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$data->D}}</th>
                    <td> {{ $data->E }} </td>
                    <td>{{ $data->F }}</td>
                
                   
                     <td> {{ $data->M}}   </td>
                 <td>
                 <a class="btn btn-sm  btn-outline-dark" role="button" href="{{route('delnotun',encrypt($data->H))}}"> Delete </a>
 
                
                
                
                </td>
                <td>
                 <a class="btn btn-sm  btn-outline-dark" role="button" href="{{route('sendnotun',encrypt($data->H))}}"> Send </a>
 
                
                
                
                </td>
                <td>
                 <a class="btn btn-sm  btn-outline-dark" role="button" href="{{route('viewnotun',encrypt($data->H))}}"> View </a>
 
                
                
                
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
     
                 
           
                

