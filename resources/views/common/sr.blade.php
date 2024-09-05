<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{asset('gov.png')}}">    
    <title>  বিবাহ নিবন্ধক গণের তথ্য  </title>
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
    <h4 align="center"> সারাদেশের বিবাহ নিবন্ধকগণের ডিজিটাল ডাটাবেইস  </h4>  
</div>

<nav class="navbar navbar-custom navbar-expand-sm navbar-light" style="height:50px;z-index:1;width:100%">
    <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse w-100 " id="navbarNav" style="background-color: #191970;">
        <ul class="navbar-nav navbar-brand mx-auto p-2 w-100"  >
           
            <li class="nav-item active mt-1 mr-2 ">
                <a class="dropdown-item mr-3" href="{{ route('section7') }}"
                    >
                    হোম
                </a>
                 
            </li>
           
           
            <li class="nav-item active mt-1 ">
                <a class="dropdown-item mr-1" href="{{ route('editme') }}"
                    >
                    ব্যাক্তিগত তথ্য
                </a>
                 
            </li>
            
            <li class="nav-item active mt-1 ">
                <a class="dropdown-item mr-1" href="{{ route('srallpic') }}"
                    >
                    ছবি সংশোধন 
                </a>
                 
            </li>
	        <li class="nav-item active mt-1 ">
                <a class="dropdown-item mr-1" href="{{ route('additional') }}"
                    >
                    অতিরিক্ত দায়িত্ব 
                </a>
                 
            </li>
             
	
            
           
                
	      Log Out 
            <li class="nav-item active mt-1 ">
                <a class="dropdown-item mr-1" href="{{ route('deletesr') }}"
                    >
                    তথ্য মুছে ফেলুন 
                </a>
                 
            </li>
            <li class="nav-item active mt-1 ">
                <a class="dropdown-item mr-1" href="{{ route('newentry') }}"
                    >
                    নতুন নিয়োগ 
                                </a>
                 
            </li>
             
	
             
             
             
            
             
             
       
      
      
       
     
      
	
	 
    
    
    
     
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle navbar-brand" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Status
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('srloguser')}}"> লগ তথ্য </a></li>
            <li><a class="dropdown-item" href="{{route('adminstatus')}}"> বর্তমান তথ্য </a></li>
             
            
        </ul>
    </li>
     
            
            <li class="nav-item active mt-1">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    লগ আউট
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
