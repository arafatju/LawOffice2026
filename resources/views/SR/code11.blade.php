@extends('common.sr')
 
 
  
  
  
      
 
  
 @section('content')



 <div class="container mb-2">
    <div class="row justify-content-center ">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' Office  এর তথ্য নিবন্ধন   করুন ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetcode') }}">
                        @csrf

                         

                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('নাম') }}</label>

                            <div class="col-md-6">

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required  autofocus>
                               <input type="hidden" name="code_status" value="economy" id="code_status">
                                   
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                                    



                            
                            </div>
                        </div>
                        
                        
                        
                        
                      
                       
                         

                         

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' জেলা নিবন্ধন   করুন ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetcode') }}">
                        @csrf

                         

                         
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('নাম') }}</label>

                            <div class="col-md-6">

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required  autofocus>
                            <input type="hidden" name="code_status" value="district" id="code_status">
                                   
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                                    



                            
                            </div>
                        </div>
                        
                        
                        
                        
                      
                       
                         

                         

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header text-center"><h3>{{ __(' পদবী নিবন্ধন   করুন ') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('budgetcode') }}">
                        @csrf

                         

                         
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('নাম') }}</label>

                            <div class="col-md-6">

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required  autofocus>
                            <input type="hidden" name="code_status" value="designation" id="code_status">
                                   
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                                    



                            
                            </div>
                        </div>
                        
                        
                        
                        
                      
                       
                         

                         

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     
        <table class="table table-bordered mb-5">
    <thead>
            <tr>
                <th colspan="4">
              Economical Code Listed
                </th>
            </tr>
            </thead>  
    <thead>
            <tr class="table-success">
            <th scope="col">Serial </th>
            <th scope="col"> নাম      </th>
            
                <th scope="col">Code   </th>
                <th scope="col"> Type      </th>
                <th scope="col">Action  </th>
                
            </tr>
        </thead>
        <tbody>
            @foreach( $draft as $data)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td> {{ $data->name }} </td>

                <td> {{ $data->code }} </td>
                <td> {{ $data->status }} </td>
              
                <td>
                     <div class="row  "> 
                    
                <div class="col-auto"> 
                    <a href="{{route('srdel',['name'=>'codetable','id'=>encrypt($data->id)])}}">
                        <img src="{{ asset('delete.png') }}" alt="Image" width="20" height="20">
                    </a>
                </div> 
                 
                </div>
                </td>                     
            </tr>
            @endforeach
        </tbody>
    </table>
      
</div>   







 @endsection


