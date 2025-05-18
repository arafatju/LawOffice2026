@extends('common.notary2')

@section('content')
<div class="container">
    <h2 class="mb-4">ডকুমেন্ট আপলোড  </h2>
    <p class="mb-4">ফাইল .jpg অথবা .jpeg অথবা .pdf  হতে হবে এবং ফাইলে সাইজ সর্বোচ্চ ১ মেগা   </p>

    {{-- Display validation errors --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('docunotary') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Application ID --}}
        <div class="row mb-3">
            <label for="applicationid" class="col-md-4 col-form-label">Application ID <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input id="applicationid" type="text" class="form-control @error('applicationid') is-invalid @enderror" name="applicationid" value="{{ session('appid') }}" readonly>
                @error('applicationid')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        {{-- Image --}}
        <div class="row mb-3">
            <label for="image" class="col-md-4 col-form-label">ছবি</label>
            <div class="col-md-8">
                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                @error('image')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        {{-- Signature --}}
        <div class="row mb-3">
            <label for="signature" class="col-md-4 col-form-label">  স্বাক্ষর</label>
            <div class="col-md-8">
                <input id="signature" type="file" class="form-control @error('signature') is-invalid @enderror" name="signature">
                @error('signature')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        {{-- Bar Certificate --}}
        <div class="row mb-3">
            <label for="barcertificate" class="col-md-4 col-form-label">বার কাউন্সিলের সার্টিফিকেট </label>
            <div class="col-md-8">
                <input id="barcertificate" type="file" class="form-control @error('barcertificate') is-invalid @enderror" name="barcertificate">
                @error('barcertificate')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        {{-- Notary Certificate --}}
        <div class="row mb-3">
            <label for="notarycertificate" class="col-md-4 col-form-label">নোটারই সার্টিফিকেট</label>
            <div class="col-md-8">
                <input id="notarycertificate" type="file" class="form-control @error('notarycertificate') is-invalid @enderror" name="notarycertificate">
                @error('notarycertificate')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        {{-- NID Certificate --}}
        <div class="row mb-3">
            <label for="nidcertificate" class="col-md-4 col-form-label">এন আই ডি   </label>
            <div class="col-md-8">
                <input id="nidcertificate" type="file" class="form-control @error('nidcertificate') is-invalid @enderror" name="nidcertificate">
                @error('nidcertificate')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        {{-- Submit --}}
        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Submit Application</button>
            </div>
        </div>
    </form>
</div>
@endsection
