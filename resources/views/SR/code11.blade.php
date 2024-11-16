@extends('common.sr')
 
 
  
  
  
      
 
  
 @section('content')



 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' অর্থনৈতিক কোড  এর তথ্য নিবন্ধন   করুন ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetcode') }}">
                        @csrf

                         

                        <div class="row mb-3">
                            <label for="code1" class="col-md-4 col-form-label text-md-end">{{ __('কোড' ) }}</label>

                            <div class="col-md-6">
                                <input id="code1" type="text" class="form-control @error('financial2324') is-invalid @enderror" name="code1" value="{{ old('code1') }}" required autocomplete="code1" autofocus>

                                @error('code1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('নাম') }}</label>

                            <div class="col-md-6">

                            <input id="name" type="text" class="form-control @error('allotment') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                               
                                   
                            @error('allotment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                                    



                            
                            </div>
                        </div>
                        
                        
                        
                        
                      
                       
                         

                         

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Draft') }}
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


