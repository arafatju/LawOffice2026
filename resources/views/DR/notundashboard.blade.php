@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
 
        <table class="table table-bordered mb-5">
        <thead>
                <tr>
                    <th colspan="2">
                    বিবাহ নিবন্ধগনের নতুন তথ্য  
                    </th>
                </tr>
                </thead>   
                @foreach($draftdata as $data)

                <tr class="table-success">
                

                   <td> নাম   </td>  <td>   {{$data->Name}} </td>  
                        <td> পিতার নাম    </td>  <td>  {{$data->Father }}  </td>  
                     <td>মাতার নাম  </td>  <td>  {{$data->Mother}}  </td>  
                    
 
                     <td>  এন আই ডি </td>  <td> {{$data->NID}}   </td>  
                     <td> অধিক্ষেত্র  </td>  <td>  {{$data->Union_Ward}}  </td> 
                    <td> Delete</td> <td><a class="btn btn-sm  btn-outline-dark" role="button" href="{{route('delnotun',encrypt($data->NID))}}"> Delete </a>
 </td>
                     
                  <td>Send </td>  <td> <a class="btn btn-sm  btn-outline-dark" role="button" href="{{route('sendnotun',encrypt($data->NID))}}"> Send </a>
 </td> 
                  <td>view </td>  <td> <a class="btn btn-sm  btn-outline-dark" role="button" href="{{route('viewnotun',encrypt($data->NID))}}"> View details </a>
 </td> 
                </tr> 
                    

                    
                
             
                    @endforeach

                
                
               
  
                
                
                
                
             
          
        </table>
        <div class="d-flex justify-content-center">
            {!! $draftdata->links() !!}
        </div>
    </div>
  @endsection
     
                 
           
                

