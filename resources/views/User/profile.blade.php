@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
@php
$controller = app(App\Http\Controllers\ConverterController::class);

@endphp
 
<div class="row justify-content-center m-4 p-2">
        <div class="accordion " id="accordionExample">

            <!-- Accordion Item 1 -->
            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="headingOne">
                    <button 
                        class="accordion-button fs-3" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseOne" 
                        aria-expanded="true" 
                        aria-controls="collapseOne">
                        চাকুরী   
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
                          <div class="card-body">
                          @foreach($job_related_info as $job)
                            <div class="row mb-3">
                                <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('সার্ভিস আইডি ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value="{{ $job->serviceid}} "  readonly required autocomplete="serviceid" autofocus>
    
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('গ্রেডেশন লিস্ট') }}</label>
    
                                <div class="col-md-6">
                                    <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="{{ $job->gradation}}" readonly required autocomplete="gradation" autofocus>
     
                                </div>
                            </div>
                            
                            
                            <div class="row mb-3">
                                <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  চাকুরীর প্রথম  নিয়োগের তারিখ ') }}</label>
    
                                <div class="col-md-6">
                                <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ $job->join }}" required readonly autofocus>
    
                                 
                                    
                                    
                                
    
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('অবসরের তারিখ ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$job->retired}}" required  readonly autocomplete="retired">
    
                                    
                                </div>
                            </div>
                        
                         @endforeach
                        
                        
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
                        স্ত্রী সম্পর্কিত তথ্যাদি 
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
 
                            <div class="card-body">
                            
                              <div class="row mb-3">
                                  <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __(' বৈবাহিক অবস্থা ') }}</label>
                                 
                                  <div class="col-md-6">
                                    @foreach ($job_related_info as $job1 )
                                        
                                   
                                      <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value="{{$job1->marital_status}} "  readonly required autocomplete="serviceid" autofocus>
                                      @endforeach
                                  </div>
                              </div>
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
                                <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('কর্মস্থল(জেলা) ') }}</label>
    
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
                            <div class="card-body">
                            
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
                             <div class="card-footer text-center">
                                <a href="{{ route('spouse' ) }}" class="btn btn-primary">Edit</a>
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
                                  <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  অফিস ') }}</label>
      
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
                                <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('  অফিস আদেশের তারিখ') }}</label>
    
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

                                <a href="{{ route('releasefromcurrent' ) }}" class="btn btn-primary">Release</a>
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
                                            <th>পদবী</th>
                                            <th>অফিস</th>
                                            <th>যোগদানের তারিখ</th>
                                            <th>অবমুক্তির তারিখ </th>
                                            <th>অফিস আদেশের তারিখ</th>
                                            <th>স্মারক নাম্বার</th>
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
                        data-bs-target="#collapseSix" 
                        aria-expanded="false" 
                        aria-controls="collapseSix">
                        বদলী   
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

            <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="headingThree">
                    <button 
                        class="accordion-button collapsed fs-3" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapseSeven" 
                        aria-expanded="false" 
                        aria-controls="collapseSeven">
                        যোগাযোগ  
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                            
                                  
                             
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
                                  <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  ইমেইল  ') }}</label>
      
                                  <div class="col-md-6">
                                  <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ Auth::user()->email }}" required readonly autofocus>
      
                                   
                                      
                                      
                                  
      
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __(' নিজ জেলা') }}</label>
                                  @foreach ($job_related_info as $kk)
                                      
                                 
                                  <div class="col-md-6">
                                      <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="{{$kk->home_district}}" required  readonly autocomplete="retired">
      
                                      
                                  </div>
                                  @endforeach
                              </div>
                          
                               
                             
                          
                             </div>
                             <div class="card-footer text-center">
                                <a href="{{ route('contactinfo' ) }}" class="btn btn-primary">Edit</a>

                              </div>
                          </div> 
                   
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
