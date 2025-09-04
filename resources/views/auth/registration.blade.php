@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' নিবন্ধন   করুন ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.custom') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('নাম') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         

                        
                         
                         
                        <div class="row mb-3">
                            <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('মোবাইল') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('ইমেইল এড্রেস ') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       <div class="row mb-3">
                            <label for="office" class="col-md-4 col-form-label text-md-end">{{ __('অফিস/দপ্তর') }}</label>

                            <div class="col-md-6">
                                <input id="office" type="text" class="form-control @error('office') is-invalid @enderror" name="office" value=" " required  >

                                @error('office')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="row mb-3">
                            <label for="designation" class="col-md-4 col-form-label text-md-end">{{ __('অফিস পদবি( PO to DS )') }}</label>

                            <div class="col-md-6">
                                <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value=" " required  >

                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      <div class="row mb-3">
                         <label for="designation2" class="col-md-4 col-form-label text-md-end">{{ __('পদবি ') }}</label>

                      <div class="col-md-6">
                       <select id="designation2" class="form-control @error('designation2') is-invalid @enderror" name="designation2" required>
                          <option >-- পদবি নির্বাচন করুন --</option> {{-- Optional: default empty --}}
                           <option >উপদেষ্টা মহোদয় </option>
                              <option >সচিব</option>
                              <option >অতিরিক্ত সচিব</option>
                               <option >যুগ্ন সচিব</option>
                               <option >উপ সচিব</option>
                               <option >সিনিয়র সহকারী সচিব</option>
                             <option >সহকারী সচিব</option>
            {{-- Add more options as needed --}}
                          </select>

                          @error('designation2')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                          </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('পাসওয়ার্ড') }}</label>

                            <div class="col-md-6 position-relative">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                <span class="position-absolute end-0 top-50 translate-middle-y me-4" onclick="togglePasswordVisibility('password', this)" style="cursor: pointer;">
            <i class="bi bi-eye"></i> <!-- Bootstrap eye icon -->
        </span>
                                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                             @enderror
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('পাসওয়ার্ড নিশ্চিত করন ') }}</label>

                            <div class="col-md-6 position-relative">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span class="position-absolute end-0 top-50 translate-middle-y me-4" onclick="togglePasswordVisibility('password-confirm', this)" style="cursor: pointer;">
            <i class="bi bi-eye"></i> <!-- Bootstrap eye icon -->
        </span>
                            </div>
                        </div>
                         
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    flatpickr("#join1", {
      dateFormat: "d/m/Y",  // Set the format to DD/MM/YYYY
    });
    flatpickr("#retired", {
    dateFormat: "d/m/Y",  // Set the format to DD/MM/YYYY
  });
  </script>
  <script>
    function togglePasswordVisibility(inputId, toggleIcon) {
        const inputField = document.getElementById(inputId);
        const icon = toggleIcon.querySelector('i');
        if (inputField.type === "password") {
            inputField.type = "text";
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            inputField.type = "password";
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
         
@endsection
