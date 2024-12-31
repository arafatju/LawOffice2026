
@extends('common.test')
 
 
  
  
  
      
 
  
 @section('content')




<div class="bg-light flex-fill">
            <div class="p-2 d-md-none d-flex text-white bg-success">
                <a href="#" class="text-white" 
                   data-bs-toggle="offcanvas"
                   data-bs-target="#bdSidebar">
                    <i class="fa-solid fa-bars"></i>
                </a>
                <span class="ms-3">OTMS Dashboard</span>
            </div>
            <div class="p-4">
                <nav style="--bs-breadcrumb-divider:'>';font-size:14px">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="fa-solid fa-house"></i>
                        </li>
                        <li class="breadcrumb-item">Dashboard</li>
                         
                    </ol>
                </nav>

                <hr>
                
                <div class="row   justify-content-center">
                    
                        <div class="card w-25  bg-primary  text-center m-1" >
                                     <div class="card-header" > User </div>
            
                                    <div class="card-body rounded-md    ">
                                                <div class="mb-1"> 
                                                    End   User   <span class="notification-badge"> {{$number_end_user}}</span>
                                                </div>
                                                <div class="mb-1"> 
                                                    Admin   User   <span class="notification-badge"> {{$number_admin_user}}</span>
                                                </div>
                                                <div class="mb-1">
                                                Total  User   <span class="notification-badge"> {{$number_user}} </span>
                                                </div> 
                                                <div class="mb-1">
                                                  User Deleted  <span class="notification-badge"> {{$number_user_deleted}} </span>
                                                </div> 
                                       </div>
                
                       
                    </div>
                    
                                 <div class="card w-25  bg-primary  text-center m-1 " >
                                        <div class="card-header" > Password Changed </div>
            
                                        <div class="card-body rounded-md  ">
                                                    <div class="mb-1 mt-2"> 
                                                        Changed by User   <span class="notification-badge"> {{$password_changed_user }} </span>
                                                    </div>
                                                     <div class="mb-1">
                                                    Changed by    Admin    <span class="notification-badge"> {{$password_changed_admin}} </span>
                                                    </div> 
                                        </div>
                
                                
                            </div>
                            
                                <div class="card w-25  bg-primary  text-center m-1" >
                                     <div class="card-header" > Email Changed </div>
            
                                        <div class="card-body rounded-md  ">
                                                <div class="mb-1 mt-2"> 
                                                    Changed by Admin   <span class="notification-badge"> {{$email_changed_admin}} </span>
                                                </div>
                                           
                                        </div>
                
                                 
</div>      
       <div class="row justify-content-center" >
                        <div class="card w-25  bg-primary  text-center m-1" >
                                  <div class="card-header" > Log info </div>
            
                                    <div class="card-body rounded-md  ">
                                                <div class="mb-1 mt-2"> 
                                                   Total Logged in    <span class="notification-badge"> {{$total_logged}} </span>
                                                </div>
                                                <div class="mb-1 mt-2"> 
                                                   Admin Logged in    <span class="notification-badge"> {{$count11}} </span>
                                                </div>
                                                <div class="mb-1 mt-2"> 
                                                   User Logged in    <span class="notification-badge">  {{$total_logged-$count11}} </span>
                                                </div>
                                                <div class="mb-1 mt-2"> 
                                                     Logged by mobile    <span class="notification-badge"> {{$logged_by_mobile}} </span>
                                                </div>
                                                <div class="mb-1 mt-2"> 
                                                     Logged by Desktop    <span class="notification-badge"> {{$total_logged-$logged_by_mobile}} </span>
                                                </div>
                                           
                            </div>
</div>
                            <div class="card w-25  bg-primary  text-center m-1" >
                                       <div class="card-header" >  Special Code  </div>
            
                                      <div class="card-body rounded-md  ">
                                                <div class="mb-1 mt-2"> 
                                                    generated by Admin   <span class="notification-badge"> 1234 </span>
                                                </div>
                                                <div class="mb-1 mt-2"> 
                                                    Expired date  <span class="notification-badge"> 1234 </span>
                                                </div>
                                           
                                       </div>
                
                            </div>
                
                        </div>
                   
            </div>

        </div>
        @endsection