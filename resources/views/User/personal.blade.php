
@extends('common.notary2')
 
 
  
  
  
      
 
  
@section('content')



 
<div class="container mt-5">
     
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-gear me-2"></i>Submit Personal Info
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
            <input type="text" name="applicationid" class="form-control" value="{{ old('applicationid') }}">
        </div>

        <div class="mb-3">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}">
        </div>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label>Father's Name</label>
            <input type="text" name="father" class="form-control" value="{{ old('father') }}">
        </div>

        <div class="mb-3">
            <label>Mother's Name</label>
            <input type="text" name="mother" class="form-control" value="{{ old('mother') }}">
        </div>

        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
        </div>

        <div class="mb-3">
            <label>Permanent Address</label>
            <input type="text" name="permanent" class="form-control" value="{{ old('permanent') }}">
        </div>

        <div class="mb-3">
            <label>National ID (NID)</label>
            <input type="text" name="nid" class="form-control" value="{{ old('nid') }}">
        </div>

        <div class="mb-3">
            <label>District</label>
            <input type="text" name="district" class="form-control" value="{{ old('district') }}">
        </div>

        <div class="mb-3">
            <label>Present Address</label>
            <input type="text" name="present" class="form-control" value="{{ old('present') }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
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

@endsection