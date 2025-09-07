 @if(auth()->user()->role == 'usermonitor')


 @endif

@if(auth()->user()->role == 'userdataentry')
    
 <a href="{{route('datadash')}}" class="sidebar-link">
                <i class="bi bi-house-door"></i> Product Management
            </a>
            <a href="{{route('datapending')}}" class="sidebar-link">
                <i class="bi bi-people"></i> Pending Applications     
            </a>
            <a href="{{route('dataapproved')}}" class="sidebar-link">
                <i class="bi bi-people"></i> Approved  Applications       
            </a>
           
            
            <a href="{{route('dataprofile')}}" class="sidebar-link">
                <i class="bi bi-gear"></i> Profile  
            </a>
             
             
             
            <a href="{{route('signout')}}" class="sidebar-link">
                <i class="bi bi-box-arrow-right"></i> Logout 
            </a>
@endif 

@if(auth()->user()->role == 'useradmin')
    
 
@endif



@if(auth()->user()->role == 'userone')


@endif 

  
@if(auth()->user()->role == 'user')


@endif


  