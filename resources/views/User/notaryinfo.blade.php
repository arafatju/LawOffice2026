@extends('common.notary2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-gear me-2"></i>Create Notary Information
                    </h5>
                    <a href="#" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>Back to List
                    </a>
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
                    
                    <form method="POST" action="{{ route('personal11') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="applicationid" class="col-md-4 col-form-label">Application ID <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input id="applicationid" type="text" class="form-control @error('applicationid') is-invalid @enderror" name="applicationid" value="{{ old('applicationid') }}" required>
                                @error('applicationid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="barnumber" class="col-md-4 col-form-label">Bar Number</label>
                            <div class="col-md-8">
                                <input id="barnumber" type="text" class="form-control @error('barnumber') is-invalid @enderror" name="barnumber" value="{{ old('barnumber') }}">
                                @error('barnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="bardate" class="col-md-4 col-form-label">Bar Date</label>
                            <div class="col-md-8">
                                <input id="bardate" type="text" class="form-control datepicker @error('bardate') is-invalid @enderror" name="bardate" value="{{ old('bardate') }}" autocomplete="off">
                                @error('bardate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="lawnumber" class="col-md-4 col-form-label">Law Number</label>
                            <div class="col-md-8">
                                <input id="lawnumber" type="text" class="form-control @error('lawnumber') is-invalid @enderror" name="lawnumber" value="{{ old('lawnumber') }}">
                                @error('lawnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="lawdate" class="col-md-4 col-form-label">Law Date</label>
                            <div class="col-md-8">
                                <input id="lawdate" type="text" class="form-control datepicker @error('lawdate') is-invalid @enderror" name="lawdate" value="{{ old('lawdate') }}" autocomplete="off">
                                @error('lawdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="exp" class="col-md-4 col-form-label">Expiration Date</label>
                            <div class="col-md-8">
                                <input id="exp" type="text" class="form-control datepicker @error('exp') is-invalid @enderror" name="exp" value="{{ old('exp') }}" autocomplete="off">
                                @error('exp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="notarysarok" class="col-md-4 col-form-label">Notary Status OK</label>
                            <div class="col-md-8 mt-2">
                                <div class="form-check">
                                    <input id="notarysarok" type="checkbox" class="form-check-input @error('notarysarok') is-invalid @enderror" name="notarysarok" value="1" {{ old('notarysarok') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="notarysarok">Yes</label>
                                </div>
                                @error('notarysarok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="natarydate" class="col-md-4 col-form-label">Notary Date</label>
                            <div class="col-md-8">
                                <input id="natarydate" type="text" class="form-control datepicker @error('natarydate') is-invalid @enderror" name="natarydate" value="{{ old('natarydate') }}" autocomplete="off">
                                @error('natarydate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="area" class="col-md-4 col-form-label">Area</label>
                            <div class="col-md-8">
                                <input id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area') }}">
                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="renewdate" class="col-md-4 col-form-label">Renew Date</label>
                            <div class="col-md-8">
                                <input id="renewdate" type="text" class="form-control datepicker @error('renewdate') is-invalid @enderror" name="renewdate" value="{{ old('renewdate') }}" autocomplete="off">
                                @error('renewdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="lastrenewdate" class="col-md-4 col-form-label">Last Renew Date</label>
                            <div class="col-md-8">
                                <input id="lastrenewdate" type="text" class="form-control datepicker @error('lastrenewdate') is-invalid @enderror" name="lastrenewdate" value="{{ old('lastrenewdate') }}" autocomplete="off">
                                @error('lastrenewdate')
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