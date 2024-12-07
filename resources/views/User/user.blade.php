
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


        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' চাকুরী সংক্রান্ত  ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetform') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="code11" class="col-md-4 col-form-label text-md-end">{{ __('সার্ভিস আইডি ') }}</label>

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
                            <label for="financial2324" class="col-md-4 col-form-label text-md-end">{{ __('গ্রেডেশন লিস্ট') }}</label>

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
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('  চাকুরীর প্রথম  নিয়োগের তারিখ ') }}</label>

                            <div class="col-md-6">
                            <input id="allotment" type="text" class="form-control @error('allotment') is-invalid @enderror" name="allotment" value="{{ old('allotment') }}" required  autofocus>

                             
                                
                                @error('allotment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="financial2425" class="col-md-4 col-form-label text-md-end">{{ __('অবসরের তারিখ ') }}</label>

                            <div class="col-md-6">
                                <input id="financial2425" type="text" class="form-control @error('financial2425') is-invalid @enderror" name="financial2425" value="২৪২৪-২৫" required readonly autocomplete="financial2425">

                                @error('financial2425')
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

    <div class="row justify-content-center mt-2">
        <div class="col-md-4  ">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' বৈবাহিক অবস্থা ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetform') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="code11" class="col-md-4 col-form-label text-md-end">{{ __('বৈবাহিক অবস্থা ') }}</label>

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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' স্বামী/স্ত্রী সম্পর্কে তথ্য ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetform') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="code11" class="col-md-4 col-form-label text-md-end">{{ __('নাম ') }}</label>

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
                            <label for="financial2324" class="col-md-4 col-form-label text-md-end">{{ __('পেশা') }}</label>

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
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('  পদবী ') }}</label>

                            <div class="col-md-6">
                            <input id="allotment" type="text" class="form-control @error('allotment') is-invalid @enderror" name="allotment" value="{{ old('allotment') }}" required  autofocus>

                             
                                
                                @error('allotment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('  কর্মস্থল ') }}</label>

                            <div class="col-md-6">
                            <input id="allotment" type="text" class="form-control @error('allotment') is-invalid @enderror" name="allotment" value="{{ old('allotment') }}" required  autofocus>

                             
                                
                                @error('allotment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('  জেলা ') }}</label>

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
     
@endsection








 










 
