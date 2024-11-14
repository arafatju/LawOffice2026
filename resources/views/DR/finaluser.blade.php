@extends('common.dr')


@section('content')

 
<div class="container mt-5">
   <table class="table table-bordered mb-5">
   <thead>
           <tr>
               <th colspan="8">
              User  info 
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
                       <a href="{{ route('userstatus22', ['id' => $data->id]) }}">
                       <img src="{{ asset('accept.png') }}" alt="Image" width="20" height="20">
                   </a>
               </div> 
               <div class="col-auto"> 
                   <a href="{{route('overalldel',['name'=>'users','id'=>encrypt($data->id)])}}">
                       <img src="{{ asset('delete.png') }}" alt="Image" width="20" height="20">
                   </a>
               </div> 
               <div class="col-auto"> 
                   <a href="#">
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