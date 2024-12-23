
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
 

<div class="row justify-content-center mt-2">
    <div class="col-md-10"> 
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <!-- Header Text -->
                <div class="header">
                    <div >সন্তান সম্পর্কিত</div>
                </div>
                
                <!-- Button -->
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addChildModal">
                        Add Child Information
                    </button>       
                </div>
            </div>

          
    
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
                                            <th> Action  </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           @foreach($draft2 as $data)
                                             <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->age}}</td>
                                            <td>{{$data->educationtype}}</td>
                                            <td>{{$data->educationname}}</td>
                                            <td>{{$data->educationlocation}}</td>
                                            <td> 
                                              <a href="{{route('delete111',['id'=>encrypt($data->id)])}}">
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
                        <label for="name" class="form-label">নাম</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">বয়স</label>
                        <input type="text" name="age" class="form-control" id="age" required>
                    </div>
                    <div class="mb-3">
                        <label for="educationtype" class="form-label">শ্রেণী</label>
                        <input type="text" name="educationtype" class="form-control" id="educationtype">
                    </div>
                    <div class="mb-3">
                        <label for="educationlocation" class="form-label">শিক্ষা প্রতিষ্ঠানের অবস্থান(জেলা)</label>
                        <input type="text" name="educationlocation" class="form-control" id="educationlocation">
                    </div>
                    <div class="mb-3">
                        <label for="educationname" class="form-label">শিক্ষা প্রতিষ্ঠানের নাম</label>
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











 










 
