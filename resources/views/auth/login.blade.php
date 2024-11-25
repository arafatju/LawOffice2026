<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     
    <title> Welcome to Login     </title>

 
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <link href="{{ asset('signin.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>


    @include('sweetalert::alert')
   

 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    
   </head>
  <body class="text-center">
    
<main class="form-signin">
    <form method="POST" action="{{ route('login.custom') }}">
        @csrf
      
    <img class="mb-4" src="{{asset('gov.png')}}" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Law and Justice Division</h1>
    <h1 class="h3 mb-3 fw-normal">Please sign in </h1>

    <div class="form-floating">
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

       <label for="email">Email address</label>
      @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    </div>
    <div class="form-floating">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
      <label for="password">Password</label>
      @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    </div>
    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.sitekey') }}"></div>
    <div class="form-floating">
         
        {!! NoCaptcha::renderJs() !!}
        {!! NoCaptcha::display() !!}
        @error('g-recaptcha-response')
  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </div>
    
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
  </form>
  <div class="form-floating">
    <a   href="{{ route('registration') }}">{{ __('Register') }}</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2021–2023</p>
    <p class="mt-5 mb-3 text-muted">Technical Consultancy,Arafat Ur Rahman</p>

  </div>
</main>


    
  </body>
</html>
