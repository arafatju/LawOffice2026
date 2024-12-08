
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
<div class="row justify-content-center mt-2">
        
             
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' বর্তমান কর্মস্থল সম্পর্কে তথ্যাদি  ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetform') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="code11" class="col-md-4 col-form-label text-md-end">{{ __('জেলা  ') }}</label>

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
                            <label for="financial2324" class="col-md-4 col-form-label text-md-end">{{ __('পদবী ') }}</label>

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
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('  অফিস ') }}</label>

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
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('  যোগদানের তারিখ  ') }}</label>

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
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('  অফিস আদেশের তারিখ  ') }}</label>

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
                            <label for="allotment" class="col-md-4 col-form-label text-md-end">{{ __('  স্মারক নাম্বার   ') }}</label>

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

<div class="row justify-content-center mt-4">
    <div class="col-md-8"> 
        <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-end">
             <a href="{{ route('finalstage1122') }}" class="btn btn-primary">Add</a>
       
              </div>
              <div class="header">
                <div class="col-6"><h1> পূর্বের কর্মস্থল সম্পর্কে </h1> </div>
            </div>

            </div> 

                    
    
          <div class="card-body">
            
            
            <div class="table-header row table-success">
                <div class="col">Serial</div>
                <div class="col">জেলা</div>
                <div class="col">পদবী </div>
                <div class="col">অফিস</div>
                <div class="col">যোগদানের তারিখ </div>
                <div class="col">অবমুক্তির তারিখ  </div>
                <div class="col">অফিস আদেশের তারিখ </div>
                <div class="col">স্মারক নাম্বার </div>
                <div class="col">Action</div>
            </div>
        
            <div class="table-body">
                @foreach($draft2 as $data)
                <div class="row">
                    <div class="col">{{$loop->iteration}}</div>
                    <div class="col">{{$data->name}}</div>
                    <div class="col">{{$data->age}}</div>
                    <div class="col">{{$data->educationtype}}</div>
                    <div class="col">{{$data->educationname}}</div>
                    <div class="col">{{$data->educationlocation}}</div>
                    
                    <div class="col">
                        <div class="row">
                             
                            <div class="col-auto">
                                <a href="{{route('budgetback11',['id'=>encrypt($data->applicationid)])}}">
                                    <img src="{{ asset('delete.png') }}" alt="Back" width="20" height="20">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div> 
        </div>
    </div>
    </div>

</div>
@endsection











 










 
