@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
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
                          
                            <div class="row mb-3">
                                <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('সার্ভিস আইডি ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value=" "  readonly required autocomplete="serviceid" autofocus>
    
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('গ্রেডেশন লিস্ট') }}</label>
    
                                <div class="col-md-6">
                                    <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="" readonly required autocomplete="gradation" autofocus>
     
                                </div>
                            </div>
                            
                            
                            <div class="row mb-3">
                                <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  চাকুরীর প্রথম  নিয়োগের তারিখ ') }}</label>
    
                                <div class="col-md-6">
                                <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ old('join') }}" required readonly autofocus>
    
                                 
                                    
                                    
                                
    
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('অবসরের তারিখ ') }}</label>
    
                                <div class="col-md-6">
                                    <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="" required  readonly autocomplete="retired">
    
                                    
                                </div>
                            </div>
                        
                        
                        
                        
                           </div>
                           <div class="card-footer text-center">
                             <button class="btn btn-primary">Edit </button>
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
                        স্ত্রী ও সন্তান সম্পর্কিত তথ্যাদি 
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                            
                              <div class="row mb-3">
                                  <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('সার্ভিস আইডি ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value=" "  readonly required autocomplete="serviceid" autofocus>
      
                                  </div>
                              </div>
      
                              <div class="row mb-3">
                                  <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('গ্রেডেশন লিস্ট') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="" readonly required autocomplete="gradation" autofocus>
       
                                  </div>
                              </div>
                              
                              
                              <div class="row mb-3">
                                  <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  চাকুরীর প্রথম  নিয়োগের তারিখ ') }}</label>
      
                                  <div class="col-md-6">
                                  <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ old('join') }}" required readonly autofocus>
      
                                   
                                      
                                      
                                  
      
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('অবসরের তারিখ ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="" required  readonly autocomplete="retired">
      
                                      
                                  </div>
                              </div>
                          
                          
                          
                          
                             </div>
                             <div class="card-footer text-center">
                               <button class="btn btn-primary">Edit </button>
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
                        কর্মস্থল  সম্পর্কিত তথ্যাদি 
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
 
                        <div class="card">
                            <div class="card-body">
                            
                              <div class="row mb-3">
                                  <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('সার্ভিস আইডি ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value=" "  readonly required autocomplete="serviceid" autofocus>
      
                                  </div>
                              </div>
      
                              <div class="row mb-3">
                                  <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('গ্রেডেশন লিস্ট') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="" readonly required autocomplete="gradation" autofocus>
       
                                  </div>
                              </div>
                              
                              
                              <div class="row mb-3">
                                  <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  চাকুরীর প্রথম  নিয়োগের তারিখ ') }}</label>
      
                                  <div class="col-md-6">
                                  <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ old('join') }}" required readonly autofocus>
      
                                   
                                      
                                      
                                  
      
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('অবসরের তারিখ ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="" required  readonly autocomplete="retired">
      
                                      
                                  </div>
                              </div>
                          
                          
                          
                          
                             </div>
                             <div class="card-footer text-center">
                               <button class="btn btn-primary">Edit </button>
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
                        বদলী সম্পর্কিত  
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card">
                            <div class="card-body">
                            
                              <div class="row mb-3">
                                  <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('সার্ভিস আইডি ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value=" "  readonly required autocomplete="serviceid" autofocus>
      
                                  </div>
                              </div>
      
                              <div class="row mb-3">
                                  <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('গ্রেডেশন লিস্ট') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="" readonly required autocomplete="gradation" autofocus>
       
                                  </div>
                              </div>
                              
                              
                              <div class="row mb-3">
                                  <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  চাকুরীর প্রথম  নিয়োগের তারিখ ') }}</label>
      
                                  <div class="col-md-6">
                                  <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ old('join') }}" required readonly autofocus>
      
                                   
                                      
                                      
                                  
      
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('অবসরের তারিখ ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="" required  readonly autocomplete="retired">
      
                                      
                                  </div>
                              </div>
                          
                          
                          
                          
                             </div>
                             <div class="card-footer text-center">
                               <button class="btn btn-primary">Edit </button>
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
                        যোগাযোগ  
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
 
                        <div class="card">
                            <div class="card-body">
                            
                              <div class="row mb-3">
                                  <label for="serviceid" class="col-md-4 col-form-label text-md-end">{{ __('সার্ভিস আইডি ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="serviceid" type="text" class="form-control @error('serviceid') is-invalid @enderror" name="serviceid" value=" "  readonly required autocomplete="serviceid" autofocus>
      
                                  </div>
                              </div>
      
                              <div class="row mb-3">
                                  <label for="gradation" class="col-md-4 col-form-label text-md-end">{{ __('গ্রেডেশন লিস্ট') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="gradation" type="text" class="form-control @error('gradation') is-invalid @enderror" name="gradation" value="" readonly required autocomplete="gradation" autofocus>
       
                                  </div>
                              </div>
                              
                              
                              <div class="row mb-3">
                                  <label for="join" class="col-md-4 col-form-label text-md-end">{{ __('  চাকুরীর প্রথম  নিয়োগের তারিখ ') }}</label>
      
                                  <div class="col-md-6">
                                  <input id="join" type="text" class="form-control @error('join') is-invalid @enderror" name="join" value="{{ old('join') }}" required readonly autofocus>
      
                                   
                                      
                                      
                                  
      
                                  </div>
                              </div>
                              
                              <div class="row mb-3">
                                  <label for="retired" class="col-md-4 col-form-label text-md-end">{{ __('অবসরের তারিখ ') }}</label>
      
                                  <div class="col-md-6">
                                      <input id="retired" type="text" class="form-control @error('retired') is-invalid @enderror" name="retired" value="" required  readonly autocomplete="retired">
      
                                      
                                  </div>
                              </div>
                          
                          
                          
                          
                             </div>
                             <div class="card-footer text-center">
                               <button class="btn btn-primary">Edit </button>
                             </div>
                          </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
