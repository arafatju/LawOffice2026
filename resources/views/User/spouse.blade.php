
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
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

<div class="row justify-content-center mt-2">
    <div class="col-md-6"> 
        <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-end">
             <a href="{{ route('finalstage1122') }}" class="btn btn-primary">Add</a>
       
              </div>
              <div class="header">
                <div class="col-8">সন্তান সম্পর্কিত </div>
            </div>

            </div> 

          
    
          <div class="card-body">
            
            
            <div class="table-header row table-success">
                <div class="col">Serial</div>
                <div class="col">নাম</div>
                <div class="col">বয়স </div>
                <div class="col">শ্রেণী</div>
                <div class="col">শিক্ষা প্রতিষ্ঠানের নাম </div>
                <div class="col">শিক্ষা প্রতিষ্ঠানের   অবস্থান  </div>
                 
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











 










 
