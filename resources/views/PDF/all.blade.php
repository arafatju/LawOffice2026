<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table View</title>
    <style>
            body {
            
            font-family: 'nikosh', sans-serif;
            font-size: 10px;
        }
        
        table {
        border-collapse: collapse;
        width: 80%;
        margin: auto;
    }
    caption {
        font-size: 1.5em;
        font-weight: bold;
        margin-bottom: 10px;
        margin-top: 10px;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    td:first-child {
    width: 40%;
}

td:nth-child(2) {
    width: 60%;
}
         
    </style>

</head>
 
<body>
<h1 style="text-align:center"> Oficers Transfer Database System </h1>
<h4 style="text-align:center;">USERID:    {{Auth::user()->userid}} </h4> 
    <table  >
        <caption>Personal Information</caption>
         

        <tbody>
           
                @foreach ($personal as $item)
                
                <tr><td>নামঃ </td>     <td> {{ $item->name }}</td></tr> 
                <tr> <td>ইমেইল এড্রেসঃ </td>         <td>{{ $item->email }}</td></tr> 
                
                <tr> <td>মোবাইলঃ </td>       <td>{{ $item->mobile }}</td></tr> 

                    <tr><td> সার্ভিস আইডিঃ</td>         <td>{{ $item->serviceid }}</td></tr> 
                        <tr> <td>গ্রেডেশন নং: </td>  <td>{{ $item->gradation }}</td></tr> 
                            <tr> <td>বৈবাহিক অবস্থাঃ </td>  <td>{{ $item->marital_status }}</td></tr> 
                                <tr> <td>প্রথম যোগদান: </td>  <td>{{ $item->join }}</td></tr> 
                                    <tr> <td>জন্ম তারিখঃ </td>  <td>{{ $item->dob }}</td></tr> 

                                        <tr><td>অফিসারের নিজ জেলাঃ </td>   <td>{{ $item->home_district }}</td></tr> 
                    @endforeach

                    
           
        </tbody>
    </table>
    <table>
        <caption>Wife  Information</caption>
         

        <tbody>
          
          
           
        
          
          
                @foreach ($wife as $item)
                 <tr><td>নামঃ </td>     <td> {{ $item->wifename }}</td></tr> 
                <tr> <td>  পেশাঃ  </td>         <td>{{ $item->profession }}</td></tr> 
                <tr> <td>  পদবীঃ  </td>       <td>{{ $item->designation }}</td></tr> 
                <tr> <td>    কর্মস্থল জেলাঃ </td>       <td>{{ $item->wifeworkplace }}</td></tr> 

                    <tr><td>   নিজ জেলাঃ </td>         <td>{{ $item->wifehomedistrict }}</td></tr> 
                        <tr> <td>  সন্তান সংখ্যাঃ </td>  <td>{{ $item->kids_number }}</td></tr> 
                              
                    @endforeach

                    
           
        </tbody>
    </table>
    <table class="table table-bordered table-striped">
        <caption>Child Information  </caption> 
         
                                    <thead class="table-success">
                                        <tr>
                                            <th>Serial</th>
                                            <th>নাম</th>
                                            <th>বয়স</th>
                                            <th>শ্রেণী</th>
                                            <th>শিক্ষা প্রতিষ্ঠানের নাম</th>
                                            <th>শিক্ষা প্রতিষ্ঠানের অবস্থান</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                           @foreach($child11 as $data)
                                             <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->age}}</td>
                                            <td>{{$data->educationtype}}</td>
                                            <td>{{$data->educationname}}</td>
                                            <td>{{$data->educationlocation}}</td>
                                             
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
    <table>
        <caption>Present Workstation</caption>
         

        <tbody>
           
                @foreach ($office_now as $item)
                 
                <tr><td>জেলাঃ </td>     <td> {{ $item->district }}</td></tr> 
                <tr> <td>পদবী  </td>         <td>{{ $item->designation }}</td></tr> 
                <tr> <td>আদালত/দপ্তর  </td>       <td>{{ $item->office }}</td></tr> 
                <tr> <td>যোগদানের তারিখ   </td>       <td>{{ $item->start }}</td></tr> 

                    <tr><td> জিওর তারিখ </td>         <td>{{ $item->GO_Date }}</td></tr> 
                        <tr> <td>স্মারক নাম্বার </td>  <td>{{ $item->sarok }}</td></tr> 
                            
                    @endforeach

                    
           
        </tbody>
    </table>
    <pagebreak />
    <table style="margin-top:20px;padding:10px ;   ">
        <caption style="margin-top:20px;padding:10px">Previous Workstation</caption>
         

        <tbody>
           
                
                 
                <tr><td>জেলাঃ </td>     <td>    {{ $office_before->pluck('district')->implode(', ') }}  </td></tr> 
                             

                    
           
        </tbody>
    </table>
    <table>
        <caption>Transfer Reason / Preferred district</caption>
         

        <tbody>
           
                @foreach ($transfer as $item)
                
                <tr><td>কেন বদলী চাই   </td>     <td> {{ $item->reason }}</td></tr> 
                <tr><td> পছন্দের জেলা  </td>     <td> {{ $item->district }}</td></tr> 
                             @endforeach

                    
           
        </tbody>
    </table>
</body>
</html>
