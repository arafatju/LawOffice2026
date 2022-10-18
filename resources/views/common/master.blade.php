

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
                padding-bottom:12%;
            }
        </style>

<div class="mujib "> <img src="{{asset('mujib.png')}}"  style="width:20px;height:20px;"/>  </div> 

<div class="golden "> <img src="{{asset('golden.png')}}"  style="width:20px;height:20px;"/>  </div>
    
    <div class="greet">
<h4 align="center"><img src="{{asset('gov.png')}}"  style="width:20px;height:20px;"/> গণপ্রজাতন্ত্রী বাংলাদেশ সরকার </h4> <h1 align="center"> আইন,বিচার ও সংসদ বিষয়ক মন্ত্রণালয়  </h1> 
    <h2 align="center"> আইন ও বিচার বিভাগ  </h2>
    <h4 align="center"> সারাদেশের বিবাহ নিবন্ধকগণের ডিজিটাল ডাটাবেইস  </h4>  
</div> 

<style>
        /* Modify the background color */
         
        .navbar-custom {
            background-color: #191970;
        }
        /* Modify brand and text color */
         
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-text {
            color: white;
        }
    </style>
 
<body style="margin-bottom:5%;">
<div class="scrollmenu">
<a href="{{route('hhome')}}">বিবাহ নিবন্ধকগণের তথ্য</a>
  <a href="{{route('onu')}}">তথ্য অনুসন্ধান</a>
  <a href="{{route('stat')}}">এক নজরে সারা দেশ</a>
  <a href="{{route('motamot')}}">মতামত এবং পরামর্শ</a>
  <a href="#" onclick="printDiv()"> প্রিন্ট 
    
    
  </a>
</div>

 
        <div class="container ">
            @yield('content')
        </div>
        <div class="footer  ">
  <p style="font-size:15px;"> কপিরাইট &copy;আইসিটি সেল , আইন  ও বিচার বিভাগ  কতৃক সর্বস্বত্ব সংরক্ষিত ,     
  কারিগরি সহায়তায় আরাফাত উর রহমান , সহকারী প্রোগ্রামার আইন ও বিচার বিভাগ  </p>
</div>
    </body>
   
</html>



