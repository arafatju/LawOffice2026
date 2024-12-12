
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
 
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' যোগাযোগ তথ্য  ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('contactinfo11') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('নাম ') }}</label>

                          
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('financial2324') is-invalid @enderror" name="name" value="{{$name}} "   required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                             
                            
                        </div>

                        <div class="row mb-3">
                            <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('মোবাইল') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{$mobile}} "   required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('  ইমেইল ') }}</label>

                            <div class="col-md-6">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$email}} " required  autofocus>

                             
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="home_district" class="col-md-4 col-form-label text-md-end">{{ __('নিজ জেলা') }}</label>

                            <div class="col-md-6">
                            <input id="home_district" type="text" class="form-control @error('home_district') is-invalid @enderror" name="home_district" value="{{$home->home_district}} " required  autofocus>

                             
                                
                                @error('home_district')
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








 










 
