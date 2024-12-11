
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
<div class="row justify-content-center mt-2">
        <div class="col-md-4  ">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' বৈবাহিক অবস্থা ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('married') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="marital_status" class="col-md-4 col-form-label text-md-end">{{ __('বৈবাহিক অবস্থা ') }}</label>

                            <div class="col-md-6">
                            <select id="marital_status" class="form-control @error('code11') is-invalid @enderror" name="marital_status"  required  autofocus>
                               
                                 
        
                                <option>Single</option> 
                               <option>Married</option>
                               <option>Divorced</option>
                              
                                @error('marital_status')
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
                                    {{ __('Save ') }}
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
                    <form method="POST" action="{{ route('husband') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="wifename" class="col-md-4 col-form-label text-md-end">{{ __(' নাম') }}</label>

                            <div class="col-md-6">
                                <input id="wifename" type="text" class="form-control @error('wifename') is-invalid @enderror" name="wifename" value=" "   required autocomplete="name" autofocus>

                                @error('wifename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="profession" class="col-md-4 col-form-label text-md-end">{{ __('পেশা ') }}</label>

                            <div class="col-md-6">
                            <select id="profession" class="form-control @error('profession') is-invalid @enderror" name="profession"  required  autofocus>
                               
                        
        
                               
                               <option>সরকারি চাকুরীজীবী    </option>
                                <option> বেসরকারি চাকুরীজীবী </option> 
                                <option>ব্যবসায়ী </option> 
                                
                                @error('profession')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </select>

                            </div>
                            
                        </div>

                        
                        
                        <div class="row mb-3">
                            <label for="designation" class="col-md-4 col-form-label text-md-end">{{ __('  পদবী ') }}</label>

                            <div class="col-md-6">
                            <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value=" " required  autofocus>

                             
                                
                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="wifeworkplace" class="col-md-4 col-form-label text-md-end">{{ __('  কর্মস্থল(জেলা) ') }}</label>

                            <div class="col-md-6">
                            <input id="wifeworkplace" type="text" class="form-control @error('wifeworkplace') is-invalid @enderror" name="wifeworkplace" value=" " required  autofocus>

                             
                                
                                @error('wifeworkplace')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="wifehomedistrict" class="col-md-4 col-form-label text-md-end">{{ __(' নিজ জেলা ') }}</label>

                            <div class="col-md-6">
                            <input id="wifehomedistrict" type="text" class="form-control @error('wifehomedistrict') is-invalid @enderror" name="wifehomedistrict" value=" " required  autofocus>

                             
                                
                                @error('wifehomedistrict')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kids_number" class="col-md-4 col-form-label text-md-end">{{ __(' সন্তান সংখ্যা ') }}</label>

                            <div class="col-md-6">
                            <input id="kids_number" type="text" class="form-control @error('kids_number') is-invalid @enderror" name="kids_number" value=" " required  autofocus>

                             
                                
                                @error('kids_number')
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addChildModal">
                    Add Child Information
                </button>       
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
                                <a href="{{route('budgetback11',['id'=>encrypt($data->id)])}}">
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


<!-- Trigger Button -->


<!-- Modal Structure -->
<div class="modal fade" id="addChildModal" tabindex="-1" aria-labelledby="addChildModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('child11') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addChildModalLabel">Add Child Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                     
                    <div class="mb-3">
                        <label for="name" class="form-label">Child Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" id="age" required>
                    </div>
                    <div class="mb-3">
                        <label for="educationtype" class="form-label">Education Type</label>
                        <input type="text" name="educationtype" class="form-control" id="educationtype">
                    </div>
                    <div class="mb-3">
                        <label for="educationlocation" class="form-label">Education Location(District)</label>
                        <input type="text" name="educationlocation" class="form-control" id="educationlocation">
                    </div>
                    <div class="mb-3">
                        <label for="educationname" class="form-label">Education Name</label>
                        <input type="text" name="educationname" class="form-control" id="educationname">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection











 










 
