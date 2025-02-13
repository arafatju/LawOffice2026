
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
 
<div class="row justify-content-center mt-4 mb-4 py-4">
    <div class="col-md-10 mb-4"> 
        <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
                <!-- Header Text -->
                <div class="header">
                    <div >পূর্বের কর্মস্থল সম্পর্কে</div>
                </div>
                
                <!-- Button -->
                <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWorkModal">
                    Add Previous District(s)
                </button>       
                </div>
            </div>



             

                    
    
          <div class="card-body">
            
            


          <table class="table table-bordered table-striped">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Serial</th>
                                            <th>জেলা</th>
                                            <th>পদবী  </th>
                                            <th> আদালত/দপ্তর  </th>
                                            <th>যোগদানের তারিখ  </th>
                                            <th>অবমুক্তির তারিখ   </th>
                                            <th>জিওর তারিখ </th>
                                            <th> স্মারক নাম্বার   </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($draft2 as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->district}}</td>
                                            <td>{{$data->designation}}</td>
                                            <td>{{$data->office}}</td>
                                            <td>{{$data->start}}</td>
                                            <td>{{$data->end}}</td>
                                            <td>{{$data->GO_Date}}</td>
                                            <td>{{$data->sarok}}</td>
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

                    <div class="mb-3">
                        <label for="designation1" class=" form-label  ">{{ __('পদবী') }}</label>
                        <input type="text" id="designation1" class="form-control @error('designation1') is-invalid @enderror" name="designation1"  required   >

                    </div>   
                        
                    <div class="mb-3">
                        <label for="office1" class=" form-label  ">{{ __('  আদালত/দপ্তর ') }}</label>
                        <input type="text" id="office1" class="form-control @error('office1') is-invalid @enderror" name="office1"  required   >
                        
                    </div>

                    <div class="mb-3">
                        <label for="join1" class=" form-label  ">{{ __(' যোগদানের তারিখ ') }}</label>
                        <input type="text" id="join1" class="form-control @error('join1') is-invalid @enderror" name="join1"  required   >
                        
                    </div>
                    <div class="mb-3">
                        <label for="go_date" class=" form-label  ">{{ __(' জিওর তারিখ  ') }}</label>
                        <input type="text" id="go_date" class="form-control @error('go_date') is-invalid @enderror" name="go_date"      >
                        
                    </div>
                    <div class="mb-3">
                        <label for="release1" class=" form-label  ">{{ __(' অবমুক্তির তারিখ  ') }}</label>
                        <input type="text" id="release1" class="form-control @error('release1') is-invalid @enderror" name="release1"  required   >
                        
                    </div>
                    <div class="mb-3">
                        <label for="sarok" class=" form-label  ">{{ __('  স্মারক নাম্বার  ') }}</label>
                        <input type="text" id="sarok" class="form-control @error('release1') is-invalid @enderror" name="sarok"      >
                        
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
        flatpickr('#join1', {
            enableTime: false, // Optional, depending on whether you need time selection
            dateFormat: 'd-m-Y', // Format for DD-MM-YYYY
        });
        flatpickr('#go_date', {
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











 










 
