

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

    <!-- Fonts -->
 
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


  

  
  
</head>
  

<style>
            body {
                font-family: 'Nikosh';
                font-size:20px;

            }
        </style>

<div class="mujib"> <img src="{{asset('mujib.png')}}"  style="width:50px;height:50px;"/>  </div> 

<div class="golden"> <img src="{{asset('golden.png')}}"  style="width:50px;height:50px;"/>  </div>
    
    <div class="greet">
<h4 align="center"><img src="{{asset('gov.png')}}"  style="width:20px;height:20px;"/> গণপ্রজাতন্ত্রী বাংলাদেশ সরকার </h4> <h1 align="center"> আইন,বিচার ও সংসদ বিষয়ক মন্ত্রণালয়  </h1> 
    <h2 align="center"> আইন ও বিচার বিভাগ  </h2>
    <h4 align="center"> সারাদেশের বিবাহ নিবন্ধকগণের ডিজিটাল ডাটাবেইস  </h4>  
</div> 
<style>
        /* Modify the background color */
         
        .navbar-custom {
            background-color: purple;
        }
        /* Modify brand and text color */
         
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-text {
            color: white;
        }
    </style>
<body style="margin-bottom:5%;">
<nav class="navbar navbar-custom navbar-expand-sm navbar-light " style="height:50px;">
    <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"> </span> </button>

    <div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav navbar-brand    w-100" style="padding-left:24%;   ">
        <li class="nav-item active ">
        <a href="{{route('hhome')}}" class="nav-link navbar-brand">বিবাহ নিবন্ধকগণের তথ্য</a>
        </li>
        <li class="nav-item active">
        <a href="{{route('onu')}}" class="nav-link navbar-brand"> তথ্য অনুসন্ধান</a>
        </li>
        
        <li class="nav-item active">
        <a href="{{route('stat')}}" class="nav-link navbar-brand">এক নজরে সারা দেশ</a>
        </li>
        <li class="nav-item active">
        <a href="{{route('motamot')}}" class="nav-link navbar-brand">মতামত এবং পরামর্শ</a>
        </li>
        </ul>
        </div>
        </nav>
  
 
        <div class="container ">
            @yield('content')
        </div>
       
    </body>
</html>



