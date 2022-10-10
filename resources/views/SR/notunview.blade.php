@extends('appinfosr')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
@foreach($draftdata as $data)
 
        <table class="table table-bordered mb-5">
             
 
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
                    <tr> <td>  লাইসেন্স প্রাপ্তির তারিখ  </td>  <td> {{$data->Z}}   </td> </tr> 
                    <tr> <td>  লাইসেন্স সারক  </td>  <td>  {{$data->O}}  </td> </tr> 
                    <tr> <td> গেজেট প্রকাশের তারিখ  </td>  <td> {{$data->S}}   </td> </tr> 
                    <tr> <td> ইনডেন্ট প্রকাশের তারিখ   </td>  <td> {{$data->R}}   </td> </tr> 
                    <tr> <td> অবসরের তারিখ (৬৭ বছর পূর্তিতে)    </td>  <td> {{$data->V}}   </td> </tr> 
                    <tr> <td>   চাকুরী করেন কি না   </td>  <td>  {{$data->W}}  </td> </tr> 
                    <tr> <td> চাকুরীর যে প্রতিষ্ঠানে করেন  </td>  <td> {{$data->X}}   </td> </tr> 
                    <tr> <td>  ধর্ম </td>  <td>  {{$data->T}}  </td> </tr> 

                    
                
             
                 
                
                
               
  
                
                
                
                
             
          
        </table>
        @endforeach
         
    </div>
  @endsection
     
                 
           
                

