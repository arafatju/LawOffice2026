
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
<div class="row justify-content-center mt-2">
        
             
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' বর্তমান কর্মস্থল সম্পর্কে তথ্যাদি  ') }}</h3></div>
                 
                 
                 
                <div class="card-body">
                    <form method="POST" action="{{ route('workingpresent') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="district" class="col-md-4 col-form-label text-md-end">{{ __('জেলা  ') }}</label>

                            <div class="col-md-6">
                                <input id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value=" "   required autocomplete="district" autofocus>

                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <label for="designation" class="col-md-4 col-form-label text-md-end">{{ __('পদবী ') }}</label>

                            <div class="col-md-6">
                                <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value=" "   required autocomplete="designation" autofocus>

                                @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="office" class="col-md-4 col-form-label text-md-end">{{ __('  অফিস ') }}</label>

                            <div class="col-md-6">
                            <input id="office" type="text" class="form-control @error('office') is-invalid @enderror" name="office" value=" " required  autofocus>

                             
                                
                                @error('office')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="start" class="col-md-4 col-form-label text-md-end">{{ __('  যোগদানের তারিখ  ') }}</label>

                            <div class="col-md-6">
                            <input id="start" type="text" class="form-control @error('start') is-invalid @enderror" name="start" value=" " required  autofocus>

                             
                                
                                @error('allotment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="GO_Date" class="col-md-4 col-form-label text-md-end">{{ __('  অফিস আদেশের তারিখ  ') }}</label>

                            <div class="col-md-6">
                            <input id="GO_Date" type="text" class="form-control @error('GO_Date') is-invalid @enderror" name="GO_Date" value=" " required  autofocus>

                             
                                
                                @error('GO_Date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                         
                        <div class="row mb-3">
                            <label for="sarok" class="col-md-4 col-form-label text-md-end">{{ __('  স্মারক নাম্বার   ') }}</label>

                            <div class="col-md-6">
                            <input id="sarok" type="text" class="form-control @error('sarok') is-invalid @enderror" name="sarok" value=" " required  autofocus>

                             
                                
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

<div class="row justify-content-center mt-4">
    <div class="col-md-8"> 
        <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorkModal">
                    Add Previous Working Information
                </button>       
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

<!-- Modal Structure -->
<div class="modal fade" id="addWorkModal" tabindex="-1" aria-labelledby="addChildModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('workingbefore') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addChildModalLabel">Add   Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                     
                    <div class="mb-3">
                        <label for="district1" class="form-label">District</label>
                        <input type="text" name="district1" class="form-control" id="district1" required>
                    </div>
                    <div class="mb-3">
                        <label for="designation1" class="form-label">Designation</label>
                        <input type="text" name="designation1" class="form-control" id="designation1" required>
                    </div>
                    <div class="mb-3">
                        <label for="office1" class="form-label">Office</label>
                        <input type="text" name="office1" class="form-control" id="office1">
                    </div>
                    <div class="mb-3">
                        <label for="join1" class="form-label">Joining Date</label>
                        <input type="text" name="join1" class="form-control" id="join1">
                    </div>
                    <div class="mb-3">
                        <label for="release1" class="form-label">Release Date</label>
                        <input type="text" name="release1" class="form-control" id="release1">
                    </div>
                    <div class="mb-3">
                        <label for="go_date" class="form-label">GO Date</label>
                        <input type="text" name="go_date" class="form-control" id="go_date">
                    </div>
                    <div class="mb-3">
                        <label for="sarok" class="form-label">Sarok Number</label>
                        <input type="text" name="sarok" class="form-control" id="sarok">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('#start', {
            enableTime: false, // Optional, depending on whether you need time selection
            dateFormat: 'd-m-Y', // Format for DD-MM-YYYY
        });
        flatpickr('#GO_Date', {
            enableTime: false, // Optional, depending on whether you need time selection
            dateFormat: 'd-m-Y', // Format for DD-MM-YYYY
        });
        flatpickr('#go_date', {
            enableTime: false, // Optional, depending on whether you need time selection
            dateFormat: 'd-m-Y', // Format for DD-MM-YYYY
        });
        flatpickr('#join1', {
            enableTime: false, // Optional, depending on whether you need time selection
            dateFormat: 'd-m-Y', // Format for DD-MM-YYYY
        });
        flatpickr('#release1', {
            enableTime: false, // Optional, depending on whether you need time selection
            dateFormat: 'd-m-Y', // Format for DD-MM-YYYY
        });
    });
</script>
@endsection











 










 
