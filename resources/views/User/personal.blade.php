
@extends('common.notary2')
 
 
  
  
  
      
 
  
@section('content')



 
<div class="container mt-5">
    <h2>Submit Personal Info</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection