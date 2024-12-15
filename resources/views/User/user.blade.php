
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
 
 
<div class="container">
    <div class="row justify-content-center">
         

        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' চাকুরী সংক্রান্ত  ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('chakuri') }}">
                        @csrf
                       @foreach ($draft as $data)
                           
                      
                        <div class="row mb-3">
                            <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('সার্ভিস আইডি ') }}</label>

                            <div class="col-md-6">
                                <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value="{{$data->serviceid}} "   required autocomplete="serviceid" autofocus>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('গ্রেডেশন লিস্ট') }}</label>

                            <div class="col-md-6">
                                <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="{{$data->gradation}}"  required autocomplete="gradation" autofocus>

                                @error('gradation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  চাকুরীর প্রথম  নিয়োগের তারিখ ') }}</label>

                            <div class="col-md-6">
                            <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value=" " required  autofocus>

                             
                                
                                @error('join')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('অবসরের তারিখ ') }}</label>

                            <div class="col-md-6">
                                <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value=" " required   autocomplete="retired">

                                @error('retired')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save ') }}
                                </button>
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
        flatpickr('#join', {
            enableTime: false, // Optional, depending on whether you need time selection
            dateFormat: 'd-m-Y', // Format for DD-MM-YYYY
        });
        flatpickr('#retired', {
            enableTime: false, // Optional, depending on whether you need time selection
            dateFormat: 'd-m-Y', // Format for DD-MM-YYYY
        });
    });
</script>
     
@endsection








 










 
