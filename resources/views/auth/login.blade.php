<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <link href="{{ asset('signin.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>


    @include('sweetalert::alert')
   

 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }
        .content-box {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .two-sided-box {
            display: flex;
            flex-wrap: wrap;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .text-side, .login-side {
            flex: 1;
            min-width: 300px;
            padding: 30px;
        }
        .text-side {
            background-color: #e9ecef;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-side {
            background-color: #ffffff;
        }
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body  >
    
     
    <!-- Main Content -->
    <div class="content-box">
        <div class="two-sided-box">
            <!-- Text Side (Left) -->
            <div class="text-side">
                <h4>Welcome  to Notary Portal!</h4>
                <p>Please log in to access your account. If you don’t have an account yet, feel free to sign up or contact support for assistance.</p>
            </div>
            <!-- Login Side (Right) -->
            <div class="login-side">
                <h3 class="mb-4">Sign In</h3>
                <form method="POST" action="{{ route('login.custom') }}">
                    @csrf
                    <div class="form-floating mb-2">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value=" " required autocomplete="off"  >
                  
                         <label for="email">Email address</label>
                        @error('email')
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                  @enderror
                      </div>
                      <div class="form-floating mb-2">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
                        <label for="password">Password</label>
                        @error('password')
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                  @enderror
                      </div>
                    <div class="form-floating mb-1">
                        <div class="g-recaptcha" data-sitekey="6LeqwU0pAAAAAI6IQJo50uXcgk3dvjHLUCx565Cq"></div>
                  
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                         
                  
                           
                          @error('g-recaptcha-response')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror
                      </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="form-floating text-center">
                    <a   href="{{ route('registration') }}">{{ __('Register') }}</a>
                
                  </div> 
                  <div class="form-floating text-center">
                    <a   href="{{ route('forget11') }}">{{ __('Forget Password') }}</a>
                  </div> 
            </div>
        </div>
    </div>

    <!-- Footer 
    <div class="footer mx-auto">
        © 2025 ICT Cell,Law and Justice Divbision,MOLJPA | All Rights Reserved
    </div>-->
    <div class="form-floating">
        <p class="mt-5 mb-1 text-muted text-center">&copy;Law and Justice Division,MOLJPA</p>
        <p class="mt-1 text-muted text-center">Technical Consultancy,Arafat Ur Rahman,Assistant Programmer,MOLJPA</p>
    
      </div>
    <!-- Bootstrap JS (Optional, for interactive components) -->
 </body>

</html>
