@extends('common.dr')
 
 
  
  
  
      
 
  
 @section('content')
 <div class="container mt-5">
  
 <div class="d-flex justify-content-end align-items-center gap-3">
  <!-- District Dropdown -->
 
  <div>
    <form method="POST" action="{{ route('finalstage1123') }}">
      @csrf
   Designation
    <select class="form-select" id="designation" name="designation">
      
      
      @foreach( $draft1 as $data)
                               
      <option>{{$data->name}}</option>
      @endforeach 
      
    </select>
  </div>
  <div>
   District 
    <select class="form-select" id="district">
   
      @foreach( $draft2 as $data)
                               
      <option>{{$data->name}}</option>
      @endforeach 
    </select>
  </div>

  <!-- Code Dropdown -->
  <div class="row">
    Code
    <select class="form-select" id="code"name="code">
    
      @foreach( $draft3 as $data)
                               
      <option>{{$data->name}}</option>
      @endforeach 
    </select>
  </div>

  <!-- Search Button -->
  <button type="submit" class="btn btn-primary">
    {{ __('Search') }}
</button>
</form> 
</div>

 <table class="table table-bordered mb-5">
    <thead>
            <tr>
                <th colspan="8">
                Accepted Applications
                </th>
            </tr>
            </thead>  
    <thead>
            <tr class="table-success">
            <th scope="col">Serial </th>
            <th scope="col"> কোড      </th>

                <th scope="col">অর্থবছর ২০২৩-২৪  </th>
                <th scope="col">বরাদ্দকৃত অর্থ</th>
                <th scope="col"> অর্থবছর ২৪২৪-২৫  </th>
                
                <th scope="col">বরাদ্দকৃত অর্থ </th>
                <th scope="col">চাহিদাকৃত অর্থ   </th>
                <th scope="col">Status  </th>
                <th scope="col">ID   </th>
                <th scope="col">Action   </th>
            </tr>
        </thead>
        <tbody>
            @foreach($draftdata as $data)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td> {{ $data->code11 }} </td>

                <td> {{ $data->financial2324 }} </td>
                <td>{{ $data->allotment }}</td>
                <td>{{ $data->financial2425 }}</td>
                <td>{{ $data->allotment2 }}</td>
                <td>{{ $data->allotment3 }}</td>
                <td>{{ $data->status }}</td>
                <td>{{ $data->applicationid }}</td>
                <td>
                     <div class="row  "> 
                    <div class="col-auto"> 


                        
                        <a href="{{ route('acceptfinal', ['id' => $data->applicationid]) }}">
                        <img src="{{ asset('view.png') }}" alt="Image" width="20" height="20">
                    </a>
                </div> 
                 
                 
                </div>
                </td>                     
            </tr>
            @endforeach
        </tbody>
    </table>
     
    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {!! $draftdata->links() !!}
    </div>

    
</div> 
 @endsection