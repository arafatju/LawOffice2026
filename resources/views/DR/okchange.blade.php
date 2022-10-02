
@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
<div class="d-flex justify-content-end p-1">
<a class="btn btn-outline-primary" role="button" href="{{route('finalchange')}}"> নতুন নিয়োগ </a>
<a class="btn btn-outline-primary" role="button" href="{{route('finalchange')}}"> মামলা সঙ্ক্রান্ত তথ্যাদি  </a>
    
</div>
 
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                <th scope="col">Serial </th>

                    <th scope="col">অধিক্ষেত্র </th>
                    <th scope="col">নাম </th>
                    <th scope="col">পিতার নাম </th>
                    <th scope="col">মাতার নাম </th>
                    <th scope="col">এন আই  ডি </th>
                    <th scope="col">Action  </th>
                    <th scope="col">Action  </th>
                    <th scope="col">Action  </th>
                    <th scope="col">Action  </th>
                </tr>
            </thead>
            <tbody>
                @foreach($person as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td> {{ $data->A }} </td>
                    <td>{{ $data->D }}</td>
                    <td>{{ $data->E }}</td>
                    <td>{{ $data->F }}</td>
                    <td>{{ $data->G }}</td>
                    <td>  <a class="btn btn-outline-secondary" role="button" href="{{route('editchange',encrypt($data->H))}}"> তথ্য সংশোধন </a>
 </td>
 <td>  <a class="btn btn-outline-danger" role="button" href="{{route('delchange',encrypt($data->H))}}"> Delete </a>
 </td>
 <td>  <a class="btn btn-outline-info" role="button" href="{{route('addlcharge',encrypt($data->H))}}"> অতিরিক্ত দায়িত্ব  </a>
 </td>
 <td>  <a class="btn btn-outline-dark" role="button" href="{{route('picturekazi',encrypt($data->H))}}"> ছবি সংযোজন  </a>
 </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $person->links() !!}
        </div>
    </div>
  @endsection
