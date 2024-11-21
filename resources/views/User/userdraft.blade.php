
@extends('common.newuser')
 
 
  
  
  
      
 
  
@section('content')
 
 
<div class="container mt-5">
    <table class="table table-bordered mb-5">
    <thead>
            <tr>
                <th colspan="8">
               Budget  info 
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
                <th scope="col">চাহিদাকৃত অর্থ  </th>
                 
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

                          
    
                        <a href="{{ route('budgetstatus', ['id' => $data->applicationid]) }}">
                        <img src="{{ asset('send.png') }}" alt="Image" width="20" height="20">
                    </a>
                </div> 
                <div class="col-auto"> 
                    <a href="{{route('userbudgetdel',['id'=>encrypt($data->applicationid)])}}">
                        <img src="{{ asset('delete.png') }}" alt="Image" width="20" height="20">
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

    <script>
        function confirmAction(event, formId) {
            event.preventDefault(); // Prevent default form submission
    
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
</div>   
@endsection











 










 
