
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
 
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __('  বর্তমান কর্মস্থল হতে অবমুক্তি  ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('release11') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="go_date" class="col-md-4 col-form-label text-md-end">{{ __('অফিস আদেশের তারিখ ') }}</label>

                          
                                <div class="col-md-6">
                                    <input id="go_date" type="text" class="form-control @error('financial2324') is-invalid @enderror" name="go_date" value="  "   required autocomplete=" " autofocus>
    
                                    @error('go_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                             
                            
                        </div>

                        <div class="row mb-3">
                            <label for="sarok" class="col-md-4 col-form-label text-md-end">{{ __('স্মারক') }}</label>

                            <div class="col-md-6">
                                <input id="sarok" type="text" class="form-control @error('sarok') is-invalid @enderror" name="sarok" value="  "   required autocomplete=" " autofocus>

                                @error('sarok')
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('#go_date', {
            enableTime: false, // Optional, depending on whether you need time selection
            dateFormat: 'd-m-Y', // Format for DD-MM-YYYY
        });
    });
</script>   
@endsection








 










 
