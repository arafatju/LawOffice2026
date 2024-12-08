
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
 
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' যোগাযোগ তথ্য  ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetform') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="code11" class="col-md-4 col-form-label text-md-end">{{ __('নাম ') }}</label>

                          
                                <div class="col-md-6">
                                    <input id="financial2324" type="text" class="form-control @error('financial2324') is-invalid @enderror" name="financial2324" value="২০২৩-২৪" readonly required autocomplete="financial2324" autofocus>
    
                                    @error('financial2324')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                             
                            
                        </div>

                        <div class="row mb-3">
                            <label for="financial2324" class="col-md-4 col-form-label text-md-end">{{ __('মোবাইল') }}</label>

                            <div class="col-md-6">
                                <input id="financial2324" type="text" class="form-control @error('financial2324') is-invalid @enderror" name="financial2324" value="২০২৩-২৪" readonly required autocomplete="financial2324" autofocus>

                                @error('financial2324')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('  ইমেইল ') }}</label>

                            <div class="col-md-6">
                            <input id="allotment" type="text" class="form-control @error('allotment') is-invalid @enderror" name="allotment" value="{{ old('allotment') }}" required  autofocus>

                             
                                
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
                                    {{ __('Edit ') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


       
    </div> 

    

</div>

 
</div>    
     
@endsection








 










 
