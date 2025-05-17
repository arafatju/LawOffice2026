
@extends('common.notary2')

@section('content')
 
<div class="container mt-5">
     
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class=" bi bi-mortarboard text-primary me-2"></i>Education info
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
 
       
        <div class="row mb-3">
            <label for="applicationid" class="col-md-4 col-form-label">Application ID <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input id="applicationid" type="text" class="form-control @error('applicationid') is-invalid @enderror" name="applicationid" value="{{ session('appid') }}" readonly>
                @error('applicationid')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="sscpass" class="col-md-4 col-form-label">এস সি পাসের সন  <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input id="sscpass" type="text" class="form-control @error('sscpass') is-invalid @enderror" name="sscpass" value="{{ old('sscpass') }}" required>
                @error('sscpass')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="hscpass" class="col-md-4 col-form-label">এইচ এস সি পাসের সন <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input id="hscpass" type="text" class="form-control @error('hscpass') is-invalid @enderror" name="hscpass" value="{{ old('hscpass') }}" required>
                @error('hscpass')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="edu1" class="col-md-4 col-form-label">সম্মান/স্নাতক পাসের সন  <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input id="edu1" type="text" class="form-control @error('edu1') is-invalid @enderror" name="edu1" value="{{ old('edu1') }}" required>
                @error('edu1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="edu2" class="col-md-4 col-form-label">স্নাতকোত্তর পাসের সন   </label>
            <div class="col-md-8">
                <input id="edu2" type="text" class="form-control @error('edu2') is-invalid @enderror" name="edu2" value="{{ old('edu2') }}"  >
                @error('edu2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Save
                </button>
                <a href="{{ route('notaryinfo') }}" class="btn btn-secondary ms-1">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </div>
    </form>

@endsection