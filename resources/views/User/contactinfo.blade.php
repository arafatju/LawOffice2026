
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
 
 
<div class="container ">
    <div class="row justify-content-center ">
        <div class="col-md-10 mt-2 py-2">
            <div class="card mb-4 ">
                <div class="card-header text-center"><h3>{{ __(' ব্যাক্তিগত তথ্যাদি  ') }}</h3></div>

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
                            <label for="dob" class="col-md-4 col-form-label text-md-end">{{ __('  জন্ম তারিখ  ') }}</label>

                            <div class="col-md-6">
                            <input id="dob" type="text" class="form-control @error('dob') is-invalid @enderror" name="dob" value=" " required  autofocus>

                             
                                
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            

                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <label for="home_district" class=" col-md-4 col-form-label text-md-end  ">{{ __('নিজ জেলা') }}</label>
                            <div class="col-md-6">
                            
                            <select id="home_district" class="form-control @error('home_district') is-invalid @enderror" name="home_district"  required  autofocus>
                               
                                   
                                
                                   
        
                               
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
                                
                                 
                                
                                @error('home_district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
</div>
            
                            
                        </div>
                         
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
                                    {{ __('Save & Submit ') }}
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('#dob', {
            enableTime: false, // Optional, depending on whether you need time selection
            dateFormat: 'd-m-Y', // Format for DD-MM-YYYY
        });
    });
</script> 






 










 
