@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
    
        <table class="table table-bordered mb-5">
             
        <thead>
                <tr class="table-success">
                

                   <td> নাম   </td>  <td>   {{$data->D}} </td> </tr> 
                   <tr>     <td> পিতার নাম    </td>  <td>  {{$data->E }}  </td> </tr> 
                    <tr> <td>মাতার নাম  </td>  <td>  {{$data->F}}  </td> </tr> 
                    
                    <tr> <td>মোবাইল </td>  <td> {{$data->M}}   </td> </tr> 
                    <tr> <td> জন্ম তারিখ  </td>  <td>{{$data->G}}    </td> </tr> 

                    <tr> <td>  এন আই ডি </td>  <td> {{$data->H}}   </td> </tr> 
                    <tr> <td> অধিক্ষেত্র  </td>  <td>  {{$data->A}}  </td> </tr> 
                    <tr> <td> উপজেলা  </td>  <td>   {{$data->B}} </td> </tr> 
                    <tr> <td> পৌরসভা / সিটি কর্পোরেশন </td>  <td> {{$data->Y}}   </td> </tr> 
                    <tr> <td>  স্থায়ী ঠিকানা  </td>  <td> {{$data->J}}   </td> </tr> 
                    <tr> <td> বর্তমান ঠিকানা  </td>  <td> {{$data->K}}   </td> </tr> 
                    <tr> <td> কার্যালয়ের ঠিকানা   </td>  <td>  {{$data->L}}  </td> </tr> 
                    <tr> <td> ইমেইল   </td>  <td>  {{$data->N}}  </td> </tr> 
                    <tr> <td>  লাইসেন্স প্রাপ্তির তারিখ  </td>  <td>    </td> </tr> 
                    <tr> <td>  লাইসেন্স সারক  </td>  <td>    </td> </tr> 
                    <tr> <td> গেজেট প্রকাশের তারিখ  </td>  <td>    </td> </tr> 
                    <tr> <td> ইনডেন্ট প্রকাশের তারিখ   </td>  <td>    </td> </tr> 
                    <tr> <td> অবসরের তারিখ (৬৭ বছর পূর্তিতে)    </td>  <td>    </td> </tr> 
                    <tr> <td>   চাকুরী করেন কি না   </td>  <td>  {{$data->X}}  </td> </tr> 
                    <tr> <td> চাকুরীর যে প্রতিষ্ঠানে করেন  </td>  <td> {{$data->W}}   </td> </tr> 
                    <tr> <td>  ধর্ম </td>  <td>  {{$data->T}}  </td> </tr> 

                    <tr> <td>Delete  </td>  <td>    </td> </tr> 
                    <tr> <td>Send  </td>  <td>    </td> </tr> 
                    <tr> <td>Details  </td>  <td>    </td> </tr> 
                
            </thead>
            <tbody>
                @foreach($draftdata as $data)
                <tr>
                    <th scope="row">{{$data->D}}</td>  <td>    </td> </tr> 
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
     
                 
           
                

