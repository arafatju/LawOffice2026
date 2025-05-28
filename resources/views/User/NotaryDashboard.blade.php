
@extends('common.notary2')
 
 
  
  
  
      
 
  
@section('content')




<h2>ড্যাশবোর্ড  </h2>
<div class="row mt-4">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-info">License Status</h5>
                <p class="card-text h6"> 
                  @if ($info->status== 'Published')  
                    @if  ($notary->isExpired())
                    Expired 
            
                    @else
                   Valid
                    @endif 
                 @else
                         N/A
            @endif</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-bold fw-bold text-success">সর্বশেষ নবায়ন তারিখ     </h5>
                <p class="card-text h6">{{ \Carbon\Carbon::parse($notary->lastrenewdate)->format('F j, Y') }} </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-primary">পরবর্তী নবায়ন তারিখ</h5>
                <p class="card-text h6">{{ \Carbon\Carbon::parse($notary->renewdate)->format('F j, Y') }} </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bold text-danger">     মেয়াদ বাকি আছে </h5>
                <p class="card-text h6"> 

                    @php
                $days = $notary->getDaysUntilExpiry();
            @endphp

            @if (is_null($days))
                Unknown
            @elseif ($days < 0)
                Expired {{ abs($days) }} days ago
            @elseif ($days == 0)
                Expires Today
            @else
                {{ $days }} days left
            @endif
                </p>
            </div>
        </div>
    </div>
</div>
 
<table class="table table-border ">
    <tr class="bg-primary text-white">
        <th>id</th> 
    
        <th> Date </th> 
        <th> Status </th> 
        <th> Action </th>
    </tr>
     <tr>
        <td> {{$info-> id}}</td> 
        <td> {{$info->created_at}}</td>
         <td>
            {{$info->status}}
         </td> 
        <td>
                    @if ($info->status === 'Draft')
            <a href="{{ route('personal11', $info->applicationid) }}" 
            class="btn btn-primary" 
            onclick="event.preventDefault(); doubleConfirm('{{ route('sendto111', $info->applicationid) }}');">
            Send
            </a>
            @else Sent
        @endif

                         
    </tr>
     
</table>

<script>
    function doubleConfirm(url) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to send this?Did you check all the information Properly?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, continue',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Final Confirmation',
                    text: "You can not edit after sending.  Proceed?",
                    
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, send it',
                    cancelButtonText: 'Back'
                }).then((result2) => {
                    if (result2.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }
        });
    }
    </script>
    
@endsection

