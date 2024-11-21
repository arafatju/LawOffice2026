
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
 
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' বাজেট এর তথ্য নিবন্ধন   করুন ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetform') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="code11" class="col-md-4 col-form-label text-md-end">{{ __('কোড ') }}</label>

                            <div class="col-md-6">
                            <select id="code11" class="form-control @error('code11') is-invalid @enderror" name="code11"  required  autofocus>
                               
                                @foreach( $draft as $data) 
        
                               
                               <option>{{ $data->name }}({{ $data->code }})   </option>
                                
                               @endforeach
                                @error('code11')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('অর্থবছর ২০২৩-২৪') }}</label>

                            <div class="col-md-6">
                                <input id="allotment" type="text" class="form-control @error('allotment') is-invalid @enderror" name="allotment" value="{{ old('allotment') }}" required autocomplete="allotment" autofocus>

                                @error('allotment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="allotment2" class="col-md-4 col-form-label text-md-end">{{ __('অর্থবছর ২৪২৪-২৫ ') }}</label>

                            <div class="col-md-6">
                            <input id="allotment2" type="text" class="form-control @error('allotment2') is-invalid @enderror" name="allotment2" value="{{ old('allotment2') }}" required  autofocus>

                             
                                
                                @error('allotment2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="financial2324" class="col-md-4 col-form-label text-md-end">{{ __('চাহিদাকৃত  অর্থ  ') }}</label>

                            <div class="col-md-6">
                                <input id="financial2324" type="text" class="form-control @error('allotment2') is-invalid @enderror" name="financial2324" value="{{ old('financial2324') }}" required autocomplete="financial2324">

                                @error('financial2324')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      
                       
                        <div class="row mb-3">
                            <label for="opinion" class="col-md-4 col-form-label text-md-end">{{ __(' মন্তব্য ') }}</label>

                            <div class="col-md-6">
                                <input id="opinion" type="text" class="form-control @error('opinion') is-invalid @enderror" name="opinion" required autocomplete="opinion">

                                @error('password')
                    <span class="text-danger">{{ $message }}</span>
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








 










 
