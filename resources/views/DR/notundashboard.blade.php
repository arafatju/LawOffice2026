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
                    <th scope="col"> জন্ম তারিখ  </th>

                    <th scope="col">  এন আই ডি </th>
                    <th scope="col"> অধিক্ষেত্র   </th>
                    <th scope="col"> উপজেলা   </th>
                    <th scope="col"> পৌরসভা / সিটি কর্পোরেশন </th>
                    <th scope="col">  স্থায়ী ঠিকানা  </th>
                    <th scope="col"> বর্তমান ঠিকানা   </th>
                    <th scope="col"> কার্যালয়ের ঠিকানা   </th>
                    <th scope="col"> ইমেইল   </th>
                    <th scope="col">  লাইসেন্স প্রাপ্তির তারিখ  </th>
                    <th scope="col">  লাইসেন্স সারক  </th>
                    <th scope="col"> গেজেট প্রকাশের তারিখ  </th>
                    <th scope="col"> ইনডেন্ট প্রকাশের তারিখ   </th>
                    <th scope="col"> অবসরের তারিখ (৬৭ বছর পূর্তিতে)    </th>
                    <th scope="col">   চাকুরী করেন কি না   </th>
                    <th scope="col"> চাকুরীর যে প্রতিষ্ঠানে করেন  </th>
                    <th scope="col">  ধর্ম </th>

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
                 
                 
                     <td> {{ $data->G}} </td>
                     <td> {{ $data->H}} </td>
                     <td> {{ $data->A}} </td>
                     <td> {{ $data->B}} </td>
                 
                     <td> {{ $data->Y}} </td>
                     <td>{{ $data->J}}  </td>
                     <td>{{ $data->K}}  </td>
                     <td> {{ $data->L}} </td>
                     <td> {{ $data->N}} </td>
                     <td> </td>
                     <td> </td>
                     <td> </td>
                 
                     <td> </td>
                     <td> </td>
                     <td>{{ $data->X}}  </td>
                     <td> {{ $data->W}} </td>
                     <td> {{ $data->T}} </td>

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
     
                 
           
                

