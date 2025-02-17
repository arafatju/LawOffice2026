@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
@php
$controller = app(App\Http\Controllers\ConverterController::class);

@endphp
  <style>
        .accordion-button {
    background-color: navy; /* Blue background */
    color: white; /* White text */
    border: none;
    transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
}

.accordion-button:hover {
    background-color: royalblue; /* Lighter blue for hover */
    color: white; /* Keep text white */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow on hover */
}

.accordion-item {
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* Light shadow around the accordion item */
    border-radius: 4px; /* Slightly rounded corners */
    margin-bottom: 10px; /* Space between accordion items */
}

.accordion-item:hover {
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
}


        /* Active accordion header */
        .accordion-button:not(.collapsed) {
            background-color: #0056b3; /* Darker blue */
            color: #fff;
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.125);
        }

        /* Accordion body customization */
        .accordion-body {
            background-color: #f8f9fa; /* Light gray background */
            color: #212529; /* Default text color */
        }
    </style>
<div class="row justify-content-center m-4 p-2">
<div class="d-flex justify-content-end">
    <a href={{route('all_info')}}> 
        <button class="btn btn-sm btn-primary">Print</button>
    </a>
    </div>
        <div class="accordion " id="accordionExample">
        <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="headingThree">
                    <button 
                        class="accordion-button collapsed fs-3" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseSeven" 
                        aria-expanded="false" 
                        aria-controls="collapseSeven">
                        ব্যক্তিগত তথ্যাদি   
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                            
                                <div class="row mb-3">
                                    <div class="d-flex justify-content-center">
                                        <!-- Image Preview -->
                                        <img id="profilePreview" 
                                         src="{{  asset('upload/pictures/'.Auth::user()->avatar) }}"  
                                         alt="Profile Picture" 
                                         class="rounded-circle shadow" 
                                         style="width: 170px; height: 150px; object-fit: cover; cursor: pointer; border: 3px solid #ddd;">
                                    </div>
                                </div>
                             
                              <div class="row mb-3">
                                  <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('নাম  ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value=" {{Auth::user()->name }}"  readonly required autocomplete="serviceid" autofocus>
      
                                  </div>
                              </div>
      
                              <div class="row mb-3">
                                  <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('মোবাইল  ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="{{ Auth::user()->mobile }}" readonly required autocomplete="gradation" autofocus>
       
                                  </div>
                              </div>
                              
                              
                              <div class="row mb-3">
                                  <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('   জন্ম তারিখ   ') }}</label>
      
                                  <div class="col-md-6">
                                  <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ $job_related_info->dob }}" required readonly autofocus>
      
                                   
                                      
                                      
                                  
      
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __(' নিজ জেলা') }}</label>
                                   
                                      
                                 
                                  <div class="col-md-6">
                                      <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$job_related_info->home_district}}" required  readonly autocomplete="retired">
      
                                      
                                  </div>
                                 
                              </div>
                          
                              <div class="row mb-3">
                            <label for="marital_status" class="col-md-4 col-form-label text-md-end">{{ __('বৈবাহিক অবস্থা ') }}</label>

                            <div class="col-md-6">
                            <input id="retir11ed" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$job_related_info->marital_status}}" required  readonly autocomplete="retired">


                            </div>
                            
                        </div>
                             
                          
                             </div>
                             <div class="card-footer text-center">
                                <a href="{{ route('contactinfo' ) }}" class="btn btn-primary">Edit</a>

                              </div>
                          </div> 
                   
                    </div>
                </div>
            </div>
            <!-- Accordion Item 1 -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="headingOne">
                    <button 
                        class="accordion-button fs-3" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseOne" 
                        aria-expanded="false" 
                        aria-controls="collapseOne">
                        চাকুরী সম্পর্কিত  
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse  " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
                          <div class="card-body">
                          
                            <div class="row mb-3">
                                <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('সার্ভিস আইডি ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value="{{ $job_related_info->serviceid}} "  readonly required autocomplete="serviceid" autofocus>
    
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('গ্রেডেশন নং(২০২৪ সনের গেজেট প্রজ্ঞাপন মতে)') }}</label>
    
                                <div class="col-md-6">
                                    <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="{{ $job_related_info->gradation}}" readonly required autocomplete="gradation" autofocus>
     
                                </div>
                            </div>
                            
                            
                            <div class="row mb-3">
                                <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  চাকুরীর প্রথম  যোগদানের তারিখ ') }}</label>
    
                                <div class="col-md-6">
                                <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ $job_related_info->join }}" required readonly autofocus>
    
                                 
                                    
                                    
                                
    
                                </div>
                            </div>
                            
                            
                        
                        
                        
                           </div>
                           <div class="card-footer text-center">
                            <a href="{{ route('jobinfo' ) }}" class="btn btn-primary">Edit</a>
                           </div>
                        </div> 
                     </div>
                </div>
            </div>

            <!-- Accordion Item 2 -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="headingTwo">
                    <button 
                        class="accordion-button collapsed fs-3" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseTwo" 
                        aria-expanded="false" 
                        aria-controls="collapseTwo">
                        স্বামী/স্ত্রী সম্পর্কিত তথ্যাদি 
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
 
                            <div class="card-body">
                            
                               
                              @foreach ($wife as $wife1 )
                              <div class="row mb-3">
                                  <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('স্বামী / স্ত্রীর নাম') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="{{$wife1->wifename}}" readonly required autocomplete="gradation" autofocus>
       
                                  </div>
                              </div>
                              
                              
                              <div class="row mb-3">
                                  <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  পেশা') }}</label>
      
                                  <div class="col-md-6">
                                  <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ $wife1->profession }}" required readonly autofocus>
      
                                   
                                      
                                      
                                  
      
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('পদবী ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$wife1->designation}}" required  readonly autocomplete="retired">
      
                                      
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('কর্মস্থল/অবস্থানের(জেলা) ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$wife1->wifeworkplace}}" required  readonly autocomplete="retired">
    
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('নিজ জেলা ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$wife1->wifehomedistrict}}" required  readonly autocomplete="retired">
    
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __(' সন্তান সংখ্যা  ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$wife1->kids_number}}" required  readonly autocomplete="retired">
    
                                    
                                </div>
                            </div>
                            @endforeach
                          
                             </div>
                             <div class="card-footer text-center">
                                <a href="{{ route('spouse' ) }}" class="btn btn-primary">Edit</a>
                             </div>
                          </div> 






                     </div>
                </div>
            </div>

            <!-- Accordion Item 3 -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="headingThree">
                    <button 
                        class="accordion-button collapsed fs-3" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseThree" 
                        aria-expanded="false" 
                        aria-controls="collapseThree">
                         সন্তান  সম্পর্কিত তথ্যাদি 
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
 
                        <div class="card">
                            <div class="card-body ">
                               <div class="table-responsive"> 
                                <table class="table table-bordered table-striped">
                                    <thead class="table-success">
                                        <tr>
                                            <th>Serial</th>
                                            <th>নাম</th>
                                            <th>বয়স</th>
                                            <th>শ্রেণী</th>
                                            <th>শিক্ষা প্রতিষ্ঠানের নাম</th>
                                            <th>শিক্ষা প্রতিষ্ঠানের অবস্থান</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($child11 as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->age}}</td>
                                            <td>{{$data->educationtype}}</td>
                                            <td>{{$data->educationname}}</td>
                                            <td>{{$data->educationlocation}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                          
                             </div>
                             <div class="card-footer text-center">
                                <a href="{{ route('child12' ) }}" class="btn btn-primary">Edit</a>
                             </div>
                          </div> 
 
 
 
                    </div>
                </div>
            </div>
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="headingThree">
                    <button 
                        class="accordion-button collapsed fs-3" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseFour" 
                        aria-expanded="false" 
                        aria-controls="collapseFour">
                        বর্তমান কর্মস্থল সম্পর্কিত  
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                              @foreach ($working_present as $working1)
                                  
                             
                              <div class="row mb-3">
                                  <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('জেলা ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value=" {{$working1->district}}"  readonly required autocomplete="serviceid" autofocus>
      
                                  </div>
                              </div>
      
                              <div class="row mb-3">
                                  <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('পদবী') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="{{$working1->designation}}" readonly required autocomplete="gradation" autofocus>
       
                                  </div>
                              </div>
                              
                              
                              <div class="row mb-3">
                                  <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  আদালত/ দপ্তর  ') }}</label>
      
                                  <div class="col-md-6">
                                  <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ $working1->office }}" required readonly autofocus>
      
                                   
                                      
                                      
                                  
      
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __(' যোগদানের তারিখ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$working1->start}}" required  readonly autocomplete="retired">
      
                                      
                                  </div>
                              </div>
                          
                              <div class="row mb-3">
                                <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('  জিওর তারিখ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$working1->GO_Date}}" required  readonly autocomplete="retired">
    
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('  স্মারক নাম্বার ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$working1->sarok}}" required  readonly autocomplete="retired">
    
                                    
                                </div>
                            </div>
                            @endforeach
                             </div>
                             <div class="card-footer text-center">
                                <a href="{{ route('workplace' ) }}" class="btn btn-primary">Edit</a>

                              </div>
                          </div> 
                   
                    </div>
                </div>
            </div>
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="headingThree">
                    <button 
                        class="accordion-button collapsed fs-3" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseFive" 
                        aria-expanded="false" 
                        aria-controls="collapseFive">
                        পূর্বের কর্মস্থল সম্পর্কে 
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
 
                        <div class="card">
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
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($working_before as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->district}}</td>
                                            <td>{{$data->designation}}</td>
                                            <td>{{$data->office}}</td>
                                            <td>{{$data->start}}</td>
                                            <td>{{$data->end}}</td>
                                            <td>{{$data->GO_Date}}</td>
                                            <td>{{$data->sarok}}</td>
                                             
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                 


                                 
      
                               
                              
                               
                              
                               
                          
                          
                          
                          
                             </div>
                             <div class="card-footer text-center">
                                <a href="{{ route('distbefore' ) }}" class="btn btn-primary">Edit</a>
                             </div>
                          </div> 
                    </div>
                </div>
            </div>

            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="headingThree">
                    <button 
                        class="accordion-button collapsed fs-3" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseSix" 
                        aria-expanded="false" 
                        aria-controls="collapseSix">
                        বদলী কেন ও পছন্দের জেলা সম্পর্কিত   
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                              @foreach ($transfer as $working1)
                                  
                             
                              <div class="row mb-3">
                                  <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('কেন বদলী চান   ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value=" {{$working1->reason}}"  readonly required autocomplete="serviceid" autofocus>
      
                                  </div>
                              </div>
      
                              <div class="row mb-3">
                                  <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('পছন্দকৃত জেলা') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="{{$working1->district}}" readonly required autocomplete="gradation" autofocus>
       
                                  </div>
                              </div>
                              
                              
                             
                              
                               
                          
                              
                            
                            @endforeach
                             </div>
                             <div class="card-footer text-center">
                                <a href="{{ route('transferme' ) }}" class="btn btn-primary">Edit</a>

                              </div>
                          </div> 
                   
                    </div>
                </div>
            </div>

            


        </div>
    </div>

    @endsection
