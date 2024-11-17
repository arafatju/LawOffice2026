<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{asset('gov.png')}}">    
    <title>  বাজেট ব্যবস্থাপনা সিস্টেম   </title>
    <link rel="stylesheet" href="{{asset('smart.css')}}">  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nikosh';
            font-size: 20px;
            padding-bottom: 12%;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0, 255, 0, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        .navbar-custom {
            background-color: #191970;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-text {
            color: white;
        }
    </style>
</head>

<body style="margin-bottom:2%;">

<div class="greet">
    <h4 align="center"><img src="{{asset('gov.png')}}" style="width:20px;height:20px;" /> গণপ্রজাতন্ত্রী বাংলাদেশ সরকার </h4> 
    <h1 align="center"> আইন,বিচার ও সংসদ বিষয়ক মন্ত্রণালয়  </h1> 
    <h2 align="center"> আইন ও বিচার বিভাগ  </h2>
    <h4 align="center"> বাজেট ব্যবস্থাপনা সিস্টেম   </h4>  
    <h4 align="center"> {{Auth::user()->Designation}},{{Auth::user()->District}}   </h4>
</div>

<nav class="navbar navbar-custom navbar-expand-sm navbar-light" style="height:50px;z-index:1">
    <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse w-100" id="navbarNav" style="background-color: #191970;">
        <ul class="navbar-nav navbar-brand mx-auto "  >
             
      

        <li class="nav-item active">
        <a href="{{ route('dash2') }}" class="nav-link navbar-brand"> Home </a>
        </li>


        <li class="nav-item active">
        <a href="#" class="nav-link navbar-brand"> Search</a>
        </li>

        <li class="nav-item active">
        <a href="#" class="nav-link navbar-brand"> Settings </a>
        </li>
       
        <li class="nav-item active">
        <a href="#" class="nav-link navbar-brand"> Status </a>
        </li>
            
	 
	 
	 
	
             
             
             
            
             
             
       
      
      
       
     
      
	
	 
     
    
    
     
    
     
            
            <li class="nav-item active mt-1">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

<div style="position:absolute; bottom:0px; width:100%; text-align:center; background:#191970">
    <p style="font-size:15px; color:white;"> কপিরাইট &copy;আইসিটি সেল , আইন ও বিচার বিভাগ  কতৃক সর্বস্বত্ব সংরক্ষিত , কারিগরি সহায়তায় আরাফাত উর রহমান , সহকারী প্রোগ্রামার আইন ও বিচার বিভাগ </p>
</div>

</body>
</html>
