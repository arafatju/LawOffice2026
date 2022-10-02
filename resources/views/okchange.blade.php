
@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
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
                    <td>  <a class="btn btn-primary" role="button" href="{{route('editchange',encrypt($data->H))}}"> তথ্য সংশোধন </a>
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
