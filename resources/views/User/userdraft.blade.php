

<!DOCTYPE html>
<html lang="en">
<head>
    
<link rel="shortcut icon" href="{{asset('gov.png')}}">    
  <title> বাজেট ব্যবস্থাপনা সিস্টেম   </title>
 
  


  
   <link rel="stylesheet" href="{{asset('smart.css')}}">  
      
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

 
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
     <!-- Styles -->
      <!-- Toastr CSS -->
      
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    



  
  
</head>
  

<style>
            body {
                font-family: 'Nikosh';
                font-size:20px;
                padding-bottom:12%;
            }
        </style>

   
    <div class="greet">
<h4 align="center"><img src="{{asset('gov.png')}}"  style="width:20px;height:20px;"/> গণপ্রজাতন্ত্রী বাংলাদেশ সরকার </h4> <h1 align="center"> আইন,বিচার ও সংসদ বিষয়ক মন্ত্রণালয়  </h1> 
    <h2 align="center"> আইন ও বিচার বিভাগ  </h2>
    <h4 align="center"> বাজেট ব্যবস্থাপনা সিস্টেম   </h4>  
    <h4 align="center"> {{Auth::user()->Designation}},{{Auth::user()->District}}  </h4> 
</div> 

<style>
        /* Modify the background color */
        .navbar-toggler-icon {
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0, 255, 0, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
        .navbar-custom {
            background-color: #191970;
        }
        /* Modify brand and text color */
         
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-text {
            color: white;
        }
    </style>

<body style="margin-bottom:2%;">
 
 
<nav class="navbar navbar-custom navbar-expand-sm navbar-light  " style="height:50px;z-index:1">
    <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"> </span> </button>

    <div class="collapse navbar-collapse " id="navbarNav" style="background-color: #191970;">
    <ul class="navbar-nav navbar-brand    w-100" style="padding-left:24%;   ">
        <li class="nav-item active ">
            <a href="{{route('userone11')}}" class="nav-link navbar-brand">Home  </a>
        </li>
        <li class="nav-item active">
        <a href="{{route('userdraftbudget')}}" class="nav-link navbar-brand"> Draft Information </a>
        </li>
        
        <li class="nav-item active">
        <a href="#" class="nav-link navbar-brand">Settings </a>
        </li>
        <li class="nav-item active mt-1">
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
        Logout
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>
        </li>
        </ul>
        </div>
</nav>
 
 
<div class="container mt-5">
    <table class="table table-bordered mb-5">
    <thead>
            <tr>
                <th colspan="8">
               Budget  info 
                </th>
            </tr>
            </thead>  
    <thead>
            <tr class="table-success">
            <th scope="col">Serial </th>
            <th scope="col"> কোড      </th>

                <th scope="col">অর্থবছর ২০২৩-২৪  </th>
                <th scope="col">বরাদ্দকৃত অর্থ</th>
                <th scope="col"> অর্থবছর ২৪২৪-২৫  </th>
                
                <th scope="col">বরাদ্দকৃত অর্থ </th>
                <th scope="col">মন্তব্য  </th>
                <th scope="col">Status  </th>
                <th scope="col">ID   </th>
                <th scope="col">Action   </th>
            </tr>
        </thead>
        <tbody>
            @foreach($draftdata as $data)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td> {{ $data->code11 }} </td>

                <td> {{ $data->financial2324 }} </td>
                <td>{{ $data->allotment }}</td>
                <td>{{ $data->financial2425 }}</td>
                <td>{{ $data->allotment2 }}</td>
                <td>{{ $data->opinion }}</td>
                <td>{{ $data->status }}</td>
                <td>{{ $data->applicationid }}</td>
                <td>
                     <div class="row  "> 
                    <div class="col-auto"> 
                        <a href="{{ route('budgetstatus', ['id' => $data->applicationid]) }}">
                        <img src="{{ asset('send.png') }}" alt="Image" width="20" height="20">
                    </a>
                </div> 
                <div class="col-auto"> 
                    <a href="{{route('userbudgetdel',['id'=>encrypt($data->applicationid)])}}">
                        <img src="{{ asset('delete.png') }}" alt="Image" width="20" height="20">
                    </a>
                </div> 
                 
                </div>
                </td>                     
            </tr>
            @endforeach
        </tbody>
    </table>
     
    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {!! $draftdata->links() !!}
    </div>
</div>   
    </body>
    <div style="position:absolute ;bottom:0px;width:100%;text-align:center;background:#191970">
  <p style="font-size:15px;color:white;"> কপিরাইট &copy;আইসিটি সেল , আইন  ও বিচার বিভাগ  কতৃক সর্বস্বত্ব সংরক্ষিত ,     
  কারিগরি সহায়তায় আরাফাত উর রহমান , সহকারী প্রোগ্রামার আইন ও বিচার বিভাগ  </p>
</div>
</html>












 










 
