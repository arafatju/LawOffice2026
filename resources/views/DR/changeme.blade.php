
@extends('common.appinfo')
 
 
  
  
  
      
 
  
 @section('content')


 
        <div class="card w-75 text-center mx-auto " style="margin-top:7%;" >
            <div class="card-header">
            তথ্য সংশোধন  
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('draftdetails') }}">
                    @csrf 
                    <input type="hidden" class="form-control " name="colname" value="{{$kk}}">
                    
                    <input type="hidden" class="form-control " name="colheading" value="{{$id2}}">
                       
                <table class="table">
                <thead>
                <tr>
                    <th colspan="2">
                    বিবাহ নিবন্ধগনের তথ্য সংশোধন আবেদন
                    </th>
                </tr>
                </thead>
                
                <tr>
                
                 <td>  বর্তমান তথ্য ({{$id2}} )
                </td>
                @foreach($person as $pp)
                <td>{{ $pp->$kk}}
                </td>
                <input type="hidden" class="form-control " name="bortoman" value="{{$pp->$kk}}">

                 @endforeach
                </tr>
                <tr>
                <td>সংশোধিত তথ্য 
                </td>
                <td> <input   type="text" class="form-control " name="changed"  >

                </td>
                </tr>
                </table>
           
            </div>
            <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
             </div>
</form>
        </div>
    

 @endsection