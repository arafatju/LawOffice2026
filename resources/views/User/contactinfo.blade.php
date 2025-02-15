@extends('common.newuser')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-2 py-2">
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3>{{ __('ব্যক্তিগত তথ্যাদি') }}</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('contactinfo11') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile Picture Section -->
                       <div class="row mb-3">
    <div class="d-flex justify-content-center">
        <!-- Image Preview -->
        <img id="profilePreview" 
             src="{{ asset('j1.png') }}" 
             alt="Profile Picture" 
             class="rounded-circle shadow" 
             style="width: 170px; height: 150px; object-fit: cover; cursor: pointer; border: 3px solid #ddd;">
    </div>
</div>

<!-- File Input -->
<div class="row mb-3">
    <div class="col-md-6 offset-md-4">
        <input id="profile_picture" type="file" class="form-control @error('profile_picture') is-invalid @enderror" 
               name="profile_picture" accept="image/*">
        @error('profile_picture')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
                        <!-- Name Input -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('নাম ') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $name) }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Mobile Input -->
                        <div class="row mb-3">
                            <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('মোবাইল') }}</label>
                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile', $mobile) }}" required autocomplete="mobile" autofocus>
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="row mb-3">
                            <label for="dob" class="col-md-4 col-form-label text-md-end">{{ __('জন্ম তারিখ') }}</label>
                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required>
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Home District -->
                        <div class="row mb-3">
                            <label for="home_district" class="col-md-4 col-form-label text-md-end">{{ __('নিজ জেলা') }}</label>
                            <div class="col-md-6">
                                <select id="home_district" class="form-control @error('home_district') is-invalid @enderror" name="home_district" required>
                                    <option>ঢাকা</option>
                                    <option>গাজীপুর</option>
                                    <!-- Add other districts here -->
                                </select>
                                @error('home_district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Marital Status -->
                        <div class="row mb-3">
                            <label for="marital_status" class="col-md-4 col-form-label text-md-end">{{ __('বৈবাহিক অবস্থা') }}</label>
                            <div class="col-md-6">
                                <select id="marital_status" class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" required>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Divorced</option>
                                </select>
                                @error('marital_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save & Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('dob')) {
        flatpickr('#dob', {
            enableTime: false,
            dateFormat: 'd-m-Y',
        });
    }

    const profileInput = document.getElementById('profile_picture');
    const profilePreview = document.getElementById('profilePreview');

    if (profileInput && profilePreview) {
        profileInput.addEventListener('change', function(event) {
            console.log("File input changed!"); // Debugging
            const file = event.target.files[0];

            if (file) {
                console.log("File selected:", file.name); // Debugging
                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log("Image loaded, updating preview."); // Debugging
                    profilePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        console.log("profile_picture or profilePreview not found!"); // Debugging
    }
});
</script>