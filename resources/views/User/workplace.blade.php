
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
<div class="row justify-content-center mt-2">
        
             
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __('অফিসারের বর্তমান কর্মস্থল সম্পর্কে তথ্যাদি  ') }}</h3></div>
                 
                 
                 
                <div class="card-body">
                    <form method="POST" action="{{ route('workingpresent') }}">
                        @csrf
                                                    
                        
                        <div class="row mb-3">
                            <label for="district" class="col-md-4 col-form-label text-md-end">{{ __('জেলা') }}</label>

                            <div class="col-md-6">
                            
                            <select id="district" class="form-control @error('district') is-invalid @enderror" name="district"  required  autofocus>
                               
                                   
                                
                                   
        
                               
                               <option>ঢাকা</option>
                               <option>গাজীপুর</option>
                               <option>নারায়ণগঞ্জ</option>
                               <option>নরসিংদী</option>
                               <option>কিশোরগঞ্জ</option>
                               <option>ফরিদপুর</option>
                               <option>গোপালগঞ্জ</option>
                               <option>মাদারীপুর</option>
                               <option>মানিকগঞ্জ</option>
                               <option>মুন্সিগঞ্জ</option>
                               <option>রাজবাড়ী</option>
                               <option>শরীয়তপুর</option>
                               <option>টাঙ্গাইল</option>
                               <option>জামালপুর</option>
                               <option>ময়মনসিংহ</option>
                               <option>নেত্রকোণা</option>
                               <option>শেরপুর</option>
                               <option>হবিগঞ্জ</option>
                               <option>মৌলভীবাজার</option>
                               <option>সুনামগঞ্জ</option>
                               <option>সিলেট</option>
                               <option>বগুড়া</option>
                               <option>চাঁপাইনবাবগঞ্জ</option>
                               <option>জয়পুরহাট</option>
                               <option>নওগাঁ</option>
                               <option>নাটোর</option>
                               <option>পাবনা</option>
                               <option>রাজশাহী</option>
                               <option>সিরাজগঞ্জ</option>
                               <option>দিনাজপুর</option>
                               <option>গাইবান্ধা</option>
                               <option>কুড়িগ্রাম</option>
                               <option>লালমনিরহাট</option>
                               <option>নীলফামারী</option>
                               <option>পঞ্চগড়</option>
                               <option>রংপুর</option>
                               <option>ঠাকুরগাঁও</option>
                               <option>বান্দরবান</option>
                               <option>ব্রাহ্মণবাড়িয়া</option>
                               <option>চাঁদপুর</option>
                               <option>চট্টগ্রাম</option>
                               <option>কুমিল্লা</option>
                               <option>কক্সবাজার</option>
                               <option>ফেনী</option>
                               <option>খাগড়াছড়ি</option>
                               <option>লক্ষ্মীপুর</option>
                               <option>নোয়াখালী</option>
                               <option>রাঙ্গামাটি</option>
                               <option>বরগুনা</option>
                               <option>বরিশাল</option>
                               <option>ঝালকাঠি</option>
                               <option>পিরোজপুর</option>
                               <option>পটুয়াখালী</option>
                               <option>ভোলা</option>
                               <option>বাগেরহাট</option>
                               <option>চুয়াডাঙ্গা</option>
                               <option>যশোর</option>
                               <option>ঝিনাইদহ</option>
                               <option>খুলনা</option>
                               <option>কুষ্টিয়া</option>
                               <option>মাগুরা </option>
                               <option>মেহেরপুর </option>
                               <option>নড়াইল</option>
                               <option>সাতক্ষীরা</option>
                                
                                 
                                
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>

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
                            <label for="GO_Date" class="col-md-4 col-form-label text-md-end">{{ __('  জিওর তারিখ  ') }}</label>

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
    <div class="col-md-10"> 
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
            
            


          <table class="table table-bordered table-striped">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Serial</th>
                                            <th>জেলা</th>
                                            
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($draft2 as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->district}}</td>
                                             
                                            <td> 
                                              <a href="{{route('delete112',['id'=>encrypt($data->id)])}}">
                                                <img src="{{ asset('delete.png') }}" alt="Back" width="20" height="20">
                                              </a>
                                             </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
      
            
        
            
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
                            <label for="district1" class=" form-label  ">{{ __('জেলা') }}</label>
                            
                            
                            <select id="district1" class="form-control @error('district1') is-invalid @enderror" name="district1"  required  autofocus>
                               
                                   
                                
                                   
        
                               
                               <option>ঢাকা</option>
                               <option>গাজীপুর</option>
                               <option>নারায়ণগঞ্জ</option>
                               <option>নরসিংদী</option>
                               <option>কিশোরগঞ্জ</option>
                               <option>ফরিদপুর</option>
                               <option>গোপালগঞ্জ</option>
                               <option>মাদারীপুর</option>
                               <option>মানিকগঞ্জ</option>
                               <option>মুন্সিগঞ্জ</option>
                               <option>রাজবাড়ী</option>
                               <option>শরীয়তপুর</option>
                               <option>টাঙ্গাইল</option>
                               <option>জামালপুর</option>
                               <option>ময়মনসিংহ</option>
                               <option>নেত্রকোণা</option>
                               <option>শেরপুর</option>
                               <option>হবিগঞ্জ</option>
                               <option>মৌলভীবাজার</option>
                               <option>সুনামগঞ্জ</option>
                               <option>সিলেট</option>
                               <option>বগুড়া</option>
                               <option>চাঁপাইনবাবগঞ্জ</option>
                               <option>জয়পুরহাট</option>
                               <option>নওগাঁ</option>
                               <option>নাটোর</option>
                               <option>পাবনা</option>
                               <option>রাজশাহী</option>
                               <option>সিরাজগঞ্জ</option>
                               <option>দিনাজপুর</option>
                               <option>গাইবান্ধা</option>
                               <option>কুড়িগ্রাম</option>
                               <option>লালমনিরহাট</option>
                               <option>নীলফামারী</option>
                               <option>পঞ্চগড়</option>
                               <option>রংপুর</option>
                               <option>ঠাকুরগাঁও</option>
                               <option>বান্দরবান</option>
                               <option>ব্রাহ্মণবাড়িয়া</option>
                               <option>চাঁদপুর</option>
                               <option>চট্টগ্রাম</option>
                               <option>কুমিল্লা</option>
                               <option>কক্সবাজার</option>
                               <option>ফেনী</option>
                               <option>খাগড়াছড়ি</option>
                               <option>লক্ষ্মীপুর</option>
                               <option>নোয়াখালী</option>
                               <option>রাঙ্গামাটি</option>
                               <option>বরগুনা</option>
                               <option>বরিশাল</option>
                               <option>ঝালকাঠি</option>
                               <option>পিরোজপুর</option>
                               <option>পটুয়াখালী</option>
                               <option>ভোলা</option>
                               <option>বাগেরহাট</option>
                               <option>চুয়াডাঙ্গা</option>
                               <option>যশোর</option>
                               <option>ঝিনাইদহ</option>
                               <option>খুলনা</option>
                               <option>কুষ্টিয়া</option>
                               <option>মাগুরা </option>
                               <option>মেহেরপুর </option>
                               <option>নড়াইল</option>
                               <option>সাতক্ষীরা</option>
                                
                                 
                                
                                @error('district1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>

                            
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











 










 
