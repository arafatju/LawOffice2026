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
                            <label for="designation" class="col-md-4 col-form-label text-md-end">{{ __('পদবী') }}</label>

                            <div class="col-md-6">

                                <select id="designation" class="form-control @error('designation') is-invalid @enderror" name="designation"  required  autofocus>
                               
                                   
        
                                    @foreach( $draft1 as $data)
                                    <option>{{$data->name}}   </option>
                                    
                                    @endforeach
                                    <option>অন্যান্য</option> 
                                    @error('designation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </select>




                            
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="district" class="col-md-4 col-form-label text-md-end">{{ __('জেলা') }}</label>

                            <div class="col-md-6">
                            
                            <select id="district" class="form-control @error('district') is-invalid @enderror" name="district"  required  autofocus>
                               
                                   
                                
                                   
        
                               
                               <option>ঢাকা</option>
                               <option>গাজীপুর</option>
                               <option>নারায়ণগঞ্জ</option>
                               <option>নরসিংদী</option>
                               <option>কিশোরগঞ্জ</option>
                               <option>ফরিদপুর</option>
                               <option>গোপালগঞ্জ</option>
                               <option>মাদারীপুর</option>
                               <option>মানিকগঞ্জ</option>
                               <option>মুন্সিগঞ্জ</option>
                               <option>রাজবাড়ী</option>
                               <option>শরীয়তপুর</option>
                               <option>টাঙ্গাইল</option>
                               <option>জামালপুর</option>
                               <option>ময়মনসিংহ</option>
                               <option>নেত্রকোণা</option>
                               <option>শেরপুর</option>
                               <option>হবিগঞ্জ</option>
                               <option>মৌলভীবাজার</option>
                               <option>সুনামগঞ্জ</option>
                               <option>সিলেট</option>
                               <option>বগুড়া</option>
                               <option>চাঁপাইনবাবগঞ্জ</option>
                               <option>জয়পুরহাট</option>
                               <option>নওগাঁ</option>
                               <option>নাটোর</option>
                               <option>পাবনা</option>
                               <option>রাজশাহী</option>
                               <option>সিরাজগঞ্জ</option>
                               <option>দিনাজপুর</option>
                               <option>গাইবান্ধা</option>
                               <option>কুড়িগ্রাম</option>
                               <option>লালমনিরহাট</option>
                               <option>নীলফামারী</option>
                               <option>পঞ্চগড়</option>
                               <option>রংপুর</option>
                               <option>ঠাকুরগাঁও</option>
                               <option>বান্দরবান</option>
                               <option>ব্রাহ্মণবাড়িয়া</option>
                               <option>চাঁদপুর</option>
                               <option>চট্টগ্রাম</option>
                               <option>কুমিল্লা</option>
                               <option>কক্সবাজার</option>
                               <option>ফেনী</option>
                               <option>খাগড়াছড়ি</option>
                               <option>লক্ষ্মীপুর</option>
                               <option>নোয়াখালী</option>
                               <option>রাঙ্গামাটি</option>
                               <option>বরগুনা</option>
                               <option>বরিশাল</option>
                               <option>ঝালকাঠি</option>
                               <option>পিরোজপুর</option>
                               <option>পটুয়াখালী</option>
                               <option>ভোলা</option>
                               <option>বাগেরহাট</option>
                               <option>চুয়াডাঙ্গা</option>
                               <option>যশোর</option>
                               <option>ঝিনাইদহ</option>
                               <option>খুলনা</option>
                               <option>কুষ্টিয়া</option>
                               <option>মাগুরা </option>
                               <option>মেহেরপুর </option>
                               <option>নড়াইল</option>
                               <option>সাতক্ষীরা</option>
                                
                                 
                                
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="office" class="col-md-4 col-form-label text-md-end">{{ __('দপ্তর') }}</label>

                            <div class="col-md-6">
                            
                            <select id="office" class="form-control @error('office') is-invalid @enderror" name="office"  required  autofocus>
                               
                                   
                                @foreach( $draft3  as $data)
                               
                                <option>{{$data->name}}</option>
                                @endforeach 
                                 <option>অন্যান্য</option> 
                                
                                @error('office')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('সার্ভিস আইডি') }}</label>

                            <div class="col-md-6">
                                <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value="{{ old('serviceid') }}" required autocomplete="serviceid">

                                @error('serviceid')
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
