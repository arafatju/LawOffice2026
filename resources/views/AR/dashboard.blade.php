@extends('common.appinfoar')
 
 
  
  
  
      
 
  
 @section('content')

 <div class="row mt-4"style="padding: 2rem 2rem;">
    <div class="col ">
        <div class="card  text-center text-white" style="background-color:#CD6155;padding:2rem 0 rem;">
             
            <div class="card-body">
            তথ্য সংশোধন 
            </div>
            <div class="card-footer">
              <a class="btn btn-dark" role="button" href="{{route('lastedit')}}">Click</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card   text-center text-white" style="background-color:green;" >
            
            <div class="card-body">
            তথ্য মুছুন 

            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('lastdelete')}}">Click</a>

            </div>
        </div>
    </div>
    <div class="col">
        <div class="card  text-center" style="background-color:Olive;color:white;">
            
            <div class="card-body">
            অতিরিক্ত দায়িত্ব 
            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('lastcharge')}}">Click</a>
 
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card  text-center" style="background-color:purple;color:white;">
             
            <div class="card-body">
           
            নতুন নিয়োগ  
            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('lastentry')}}">Click</a>

             </div>
        </div>
    </div>

 
  
<div class="col">
        <div class="card  text-center" style="background-color:purple;color:white;">
           
          
            
            <div class="card-body">
            Pending ব্যবহারকারী  ইনফো  

            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('userinfo')}}">Click</a>

             </div>
        </div>
    

</div> 
<div class="col">
        <div class="card  text-center" style="background-color:purple;color:white;">
           
          
            
            <div class="card-body">
          Active  ব্যবহারকারী  ইনফো  

            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('pendinguser')}}">Click</a>

             </div>
        </div>
    

</div> 
<div class="col">
        <div class="card  text-center" style="background-color:purple;color:white;">
           
          
            
            <div class="card-body">
            লগ  ইনফো  

            </div>
            <div class="card-footer">
            <a class="btn btn-dark" role="button" href="{{route('loguser')}}">Click</a>

             </div>
        </div>
    

</div>
<div class="col">
       <div class="card  text-center" style="background-color:royalblue;color:white;">
           
          
            
           <div class="card-body">
          Status 

           </div>
           <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{route('admin2status')}}">Click</a>

            </div>
       </div>


</div>

<div class="col">
       <div class="card  text-center" style="background-color:royalblue;color:white;">
           
          
            
           <div class="card-body">
          Picture info 

           </div>
           <div class="card-footer">
           <a class="btn btn-dark" role="button" href="{{route('allpic')}}">Click</a>

            </div>
       </div>


</div>
</div>
<div class="row  justify-content-center align-items-center " >

<div class="col-md-6 col-md-offset-4 ">
        <div class="card   text-left" >
            <div class="card-header">
            নির্দেশনবলী
            </div>
            <div class="card-body">
          <div class="row"> <h5>১। ড্রাফট এ ক্লিক করলে আপনার সম্পুরন জেলার তথ্য পাবেন  </h5>  </div>
          <div class="row"> <h5> ২। সেখান থেকে সংশোধন ডিলিট ছবি সংযজন অতিরিক্ত  দায়িত্ব প্রদান ইত্যাদি অপশন পাবেন </h5> </br> </div>
          <div class="row"> <h5> ৩।  যে কোন সংশোধনের সময় সবার আগে আপনাকে ড্রাফট করতে হবে । </h5> </br> </div> 
          <div class="row"> <h5> ৪।  এরপরে সেন্ড বাটনে ক্লিক করলে সেটা বিচার শাখা ৭ এ যাবে  </h5> </br> </div>  
          <div class="row"> <h5> ৫।  কারও পাসওয়ার্ড ভুলে গেলে নতুন করে নিবন্ধন করবেন এবং আমাকে জানাবেন । বের হওয়ার আগে অবশ্যই লগআউট করবেন । যদি কেও ভুলে জান সে ক্ষেত্রে পিসি রিস্টার্ট দিয়ে ১০ মিনিট পরে খুলবেন   </h5> </br> </div>   
            </div>
             
        </div>
    </div>

</div> 
 @endsection