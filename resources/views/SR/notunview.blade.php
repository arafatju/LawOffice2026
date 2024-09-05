@extends('common.sr')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">

 
        <table class="table table-bordered mb-5">
        <thead>
                <tr>
                    <th colspan="8">
                    বিবাহ নিবন্ধগনের নতুন তথ্য  
                    </th>
                </tr>
                </thead>

                @foreach($draftdata as $data)
 
                <tr class="table-success">
                

                    <td> নাম   </td>  <td>   {{$data->Name}} </td> </tr> 
                    <tr>     <td> পিতার নাম    </td>  <td>  {{$data->Father }}  </td> </tr> 
                     <tr> <td>মাতার নাম  </td>  <td>  {{$data->Mother}}  </td> </tr> 
                     
                     <tr> <td>মোবাইল </td>  <td> {{$data->Mobile}}   </td> </tr> 
                     <tr> <td> জন্ম তারিখ  </td>  <td>{{$data->DOB}}    </td> </tr> 
 
                     <tr> <td>  এন আই ডি </td>  <td> {{$data->NID}}   </td> </tr> 
                     <tr> <td> অধিক্ষেত্র  </td>  <td>  {{$data->Union_Ward}}  </td> </tr> 
                     <tr> <td> উপজেলা  </td>  <td>   {{$data->Thana}} </td> </tr> 
                     <tr> <td> পৌরসভা / সিটি কর্পোরেশন </td>  <td> {{$data->Pourosova_City_Corporation}}   </td> </tr> 
                     <tr> <td>  স্থায়ী ঠিকানা  </td>  <td> {{$data->Permanent}}   </td> </tr> 
                     <tr> <td> বর্তমান ঠিকানা  </td>  <td> {{$data->Present}}   </td> </tr> 
                     <tr> <td> কার্যালয়ের ঠিকানা   </td>  <td>  {{$data->Office}}  </td> </tr> 
                     <tr> <td> ইমেইল   </td>  <td>  {{$data->Email}}  </td> </tr> 
                     <tr> <td>  লাইসেন্স প্রাপ্তির তারিখ  </td>  <td> {{$data->License_Achieved_Date}}   </td> </tr> 
                     <tr> <td>  লাইসেন্স সারক  </td>  <td>  {{$data->License_Sarok}}  </td> </tr> 
                     <tr> <td> গেজেট প্রকাশের তারিখ  </td>  <td> {{$data->License_Gazet_Date}}   </td> </tr> 
                     <tr> <td> ইনডেন্ট প্রকাশের তারিখ   </td>  <td> {{$data->Indent_Date}}   </td> </tr> 
                     <tr> <td> অবসরের তারিখ (৬৭ বছর পূর্তিতে)    </td>  <td> {{$data->Resign_Date}}   </td> </tr> 
                     <tr> <td>   চাকুরী করেন কি না   </td>  <td>  {{$data->Job}}  </td> </tr> 
                     <tr> <td> চাকুরীর যে প্রতিষ্ঠানে করেন  </td>  <td> {{$data->Job_Status}}   </td> </tr> 
                     <tr> <td>  ধর্ম </td>  <td>  {{$data->Report_Sent_By}}  </td> </tr> 
 
                     
                 
              
                  
                 
                 
                    
                
                    @endforeach
                 
                
                
               
  
                
                
                
                
             
          
        </table>
  
         
    </div>
  @endsection
     
                 
           
                

