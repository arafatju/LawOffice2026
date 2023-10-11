@extends('common.appinfoar')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
        <table class="table table-bordered mb-5">
             
        <thead>
                <tr class="table-success">
                

                    <th scope="col">নাম   </th>
                    <th scope="col">বর্তমান অধিক্ষেত্র  </th>
                    <th scope="col">অতিরিক্ত দায়িত্ব   </th>
                    
                    <th scope="col">প্রয়োজনীয়  কাগজপত্র  </th>
                    <th scope="col">Delete  </th>
                    <th scope="col">Send  </th>
                </tr>
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$data->name}}</th>
                    <td> {{ $data->bortoman }} </td>
                    <td>{{ $data->sector }}</td>
                
                   
                     <td>  <a href="{{asset('/upload/kazi/papers/'.$data->avatar)}}"   >view</a>
   </td>
   <td>  <a class="btn btn-danger" role="button" href="{{route('admindel',['name'=>'activitycharge','id'=>encrypt($data->id)])}}"> Delete </a>
 </td>        <td>  <a class="btn btn-danger" role="button" href="{{route('publish',['name'=>'activitycharge','id'=>encrypt($data->id)])}}"> publish </a>
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
     
                 
           
                

