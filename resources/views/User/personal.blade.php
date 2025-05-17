
@extends('common.notary2')
 
 
  
  
  
      
 
  
@section('content')



 
<div class="container mt-5">
     
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-person-circle text-success me-2"></i>ব্যাক্তিগত তথ্যাদি 
                    </h5>
                    
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error!</strong> Please check the form below for errors.<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
               

    <form action="{{ route('personal11') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Application ID</label>
            <input type="text" name="applicationid" class="form-control" value="{{ session('appid') }} "readonly>
        </div>

        

        <div class="mb-3">
            <label>নাম </label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label>পিতার নাম </label>
            <input type="text" name="father" class="form-control" value="{{ old('father') }}">
        </div>

        <div class="mb-3">
            <label> মাতার নাম</label>
            <input type="text" name="mother" class="form-control" value="{{ old('mother') }}">
        </div>

        <div class="mb-3">
            <label>জন্ম তারিখ     </label>
            <input type="text" name="dob" class="form-control datepicker @error('lastrenewdate') is-invalid @enderror" value="{{ old('dob') }}">
        </div>
        <div class="mb-3">
            <label>এন আই ডি </label>
            <input type="text" name="nid" class="form-control" value="{{ old('nid') }}">
        </div>
        <div class="mb-3">
            <label>মোবাইল</label>
            <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}">
        </div>
        <div class="mb-3">
            <label>ইমেইল</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        

       

        <div class="mb-3">
            <label>নিজ জেলা</label>
            <input type="text" name="district" class="form-control" value="{{ old('district') }}">
        </div>
        <div class="mb-3">
            <label>স্থায়ী ঠিকানা </label>
            <input type="text" name="permanent" class="form-control" value="{{ old('permanent') }}">
        </div>
        <div class="mb-3">
            <label>বর্তমান ঠিকানা</label>
            <input type="text" name="present" class="form-control" value="{{ old('present') }}">
        </div>

        

        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Save
                </button>
                <a href="{{ route('personal') }}" class="btn btn-secondary ms-1">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div> 
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize flatpickr for all date inputs
        flatpickr(".datepicker", {
            dateFormat: "Y-m-d",
            allowInput: true,
            altInput: true,
            altFormat: "F j, Y",
            placeholder: "Select date"
        });
    });
</script>
@endsection