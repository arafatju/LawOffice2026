
@extends('appinfo')
 
 
  
  
  
      
 
  
 @section('content')

 
<div class="container mt-5">
<div class="d-flex justify-content-end p-1">
<a class="btn btn-outline-primary" role="button" href="{{route('dataone')}}"> ড্রাফট এডিট </a>
<a class="btn btn-outline-primary" role="button" href="{{route('showkazi')}}"> ড্রাফট ছবি  </a>
<a class="btn btn-outline-primary" role="button" href="{{route('chargedash')}}"> ড্রাফট অতিরক্ত দায়িত্ব   </a>

<a class="btn btn-outline-primary" role="button" href="{{route('deldashboard')}}"> ড্রাফট ডিলিট  </a>
<a class="btn btn-outline-primary" role="button" href="{{route('notundashboard')}}"> ড্রাফট নতুন নিয়োগ   </a>

</div>

<div class="d-flex justify-content-end p-1">


<a class="btn btn-outline-primary" role="button" href="{{route('notun')}}"> নতুন নিয়োগ </a>
<a class="btn btn-outline-primary" role="button"href="{{route('mamla')}}" > মামলা সঙ্ক্রান্ত তথ্যাদি  </a>
</div>
<div class="d-flex justify-content-end p-1">
<form action="{{route('thanakoi')}}" method="POST" accept-charset="UTF-8" role="form">
                             @csrf
@foreach ($upojela as $district1)   <select name="sector"  id="office" class="form-control ">
                                <option>  {{ $district1->B}} </option>
                                </select>
                              
                     @endforeach   
                     <input type="hidden" name="category" value="upojela"> 
                     <input class="btn btn-sm btn-primary  " type="submit" value="upojela"> 
</form>
<form action="{{route('thanakoi')}}" method="POST" accept-charset="UTF-8" role="form">
                             @csrf
@foreach ($pourosova as $district2)   <select name="sector"    class="form-control ">
                                <option>  {{ $district2->Y}} </option>
                                </select>
                              
                     @endforeach    
                     <input type="hidden" name="category" value="pourosova"> 
                     <input class="btn btn-sm btn-primary  " type="submit" value="pourosova"> 
</form>
<form action="{{route('thanakoi')}}" method="POST" accept-charset="UTF-8" role="form">
                             @csrf
@foreach ($city as $district3)   <select name="sector"  id="office" class="form-control ">
                                <option>  {{ $district3->Y}} </option>
                                </select>
                              
                     @endforeach    
                     <input type="hidden" name="category" value="citycorporation"> 
                     <input class="btn btn-sm btn-primary  " type="submit" value="citycorporation"> 
</form>
</div>

 
        <table class="table table-bordered mb-5">
        <thead>
                <tr>
                    <th colspan="10">
                    বিবাহ নিবন্ধগনের তথ্য সংশোধন আবেদন
                    </th>
                </tr>
                </thead> 
        
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
