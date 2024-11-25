@extends('common.dr')
@include('sweetalert::alert')

@section('content')

 
<div class="container mt-5">
    <div class="d-flex justify-content-end m-2">
        <a href="{{ route('showinactive') }}" class="btn m-2 btn-primary">Inactive User </a>
 
            
       </div>  
   <table class="table table-bordered mb-5">
   <thead>
           <tr>
               <th colspan="8">
            Active  User  info 
               </th>
           </tr>
           </thead>  
   <thead>
           <tr class="table-success">
           <th scope="col">Serial </th>
           <th scope="col"> নাম      </th>

               <th scope="col">পদবী  </th>
               <th scope="col">জেলা</th>
               <th scope="col"> মোবাইল   </th>
               
               <th scope="col">ইমেইল  </th>
               <th scope="col">Action  </th>
               
           </tr>
       </thead>
       <tbody>
           @foreach($draftdata as $data)
           <tr>
               <th scope="row">{{$loop->iteration}}</th>
               <td> {{ $data->name }} </td>

               <td> {{ $data->Designation }} </td>
               <td>{{ $data->District }}</td>
               <td>{{ $data->mobile }}</td>
               <td>{{ $data->email }}</td>
             
               <td>
                    <div class="row  "> 
                   <div class="col-auto"> 

                       

                   
                        <a href="{{ route('inactiveuserlist',['id'=>$data->email]) }}">
                            <img src="{{ asset('images.jpeg') }}"   alt="Image" width="20" height="20">
                        </a>
                     
               </div> 
               <div class="col-auto"> 


                <form id="user12Form" action="{{ route('overalldel11',['name'=>'users','id'=>($data->id)]) }}" method="GET">
                    @csrf
                    @method('DELETE')
                    <a href="#">
                        <img src="{{ asset('delete.png') }}" onclick="confirmAction(event, 'user12Form')" alt="Image" width="20" height="20">
                    </a>
                </form>
                    
               </div> 
               <div class="col-auto"> 
                   <a href="#">
                       <img src="{{ asset('log.png') }}" alt="Image" width="20" height="20">
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