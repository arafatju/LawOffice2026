

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
 
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' বাজেট এর তথ্য নিবন্ধন   করুন ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetform') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="code11" class="col-md-4 col-form-label text-md-end">{{ __('কোড ') }}</label>

                            <div class="col-md-6">
                            <select id="code11" class="form-control @error('code11') is-invalid @enderror" name="code11"  required  autofocus>
                               
                                @foreach( $draft as $data) 
        
                               
                               <option>{{ $data->name }}({{ $data->code }})   </option>
                                
                               @endforeach
                                @error('code11')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="financial2324" class="col-md-4 col-form-label text-md-end">{{ __('অর্থবছর ২০২৩-২৪') }}</label>

                            <div class="col-md-6">
                                <input id="financial2324" type="text" class="form-control @error('financial2324') is-invalid @enderror" name="financial2324" value="{{ old('financial2324') }}" required autocomplete="financial2324" autofocus>

                                @error('financial2324')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('বরাদ্দকৃত অর্থ') }}</label>

                            <div class="col-md-6">

                            <input id="allotment" type="text" class="form-control @error('allotment') is-invalid @enderror" name="allotment" value="{{ old('allotment') }}" required autocomplete="allotment" autofocus>
                               
                                   
                            @error('allotment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                                    



                            
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="financial2425" class="col-md-4 col-form-label text-md-end">{{ __('অর্থবছর ২৪২৪-২৫ ') }}</label>

                            <div class="col-md-6">
                            <input id="financial2425" type="text" class="form-control @error('financial2425') is-invalid @enderror" name="financial2425" value="{{ old('financial2425') }}" required  autofocus>

                             
                                
                                @error('financial2425')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="allotment2" class="col-md-4 col-form-label text-md-end">{{ __('বরাদ্দকৃত অর্থ  ') }}</label>

                            <div class="col-md-6">
                                <input id="allotment2" type="text" class="form-control @error('allotment2') is-invalid @enderror" name="allotment2" value="{{ old('allotment2') }}" required autocomplete="allotment2">

                                @error('allotment2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      
                       
                        <div class="row mb-3">
                            <label for="opinion" class="col-md-4 col-form-label text-md-end">{{ __(' মন্তব্য ') }}</label>

                            <div class="col-md-6">
                                <input id="opinion" type="text" class="form-control @error('opinion') is-invalid @enderror" name="opinion" required autocomplete="opinion">

                                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                             @enderror
                                
                            </div>
                        </div>

                         

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Draft') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    
    </body>
    <div style="position:absolute ;bottom:0px;width:100%;text-align:center;background:#191970">
  <p style="font-size:15px;color:white;"> কপিরাইট &copy;আইসিটি সেল , আইন  ও বিচার বিভাগ  কতৃক সর্বস্বত্ব সংরক্ষিত ,     
  কারিগরি সহায়তায় আরাফাত উর রহমান , সহকারী প্রোগ্রামার আইন ও বিচার বিভাগ  </p>
</div>
</html>












 










 
