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
        width: 50%;
        margin: auto;
    }
    caption {
        font-size: 1.5em;
        font-weight: bold;
        margin-bottom: 10px;
    }
    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

         
    </style>
</head>
 
<body>
    <table>
        <caption>Personal Information</caption>
         

        <tbody>
           
                @foreach ($personal as $item)
                <tr>  <td>ID  </td> <td>{{ $item->id }}</td> </tr> 
                <tr><td>নামঃ </td>     <td> {{ $item->name }}</td></tr> 
                <tr> <td>ইমেইল এড্রেসঃ </td>         <td>{{ $item->email }}</td></tr> 
                <tr> <td>ইউজার আইডিঃ </td>       <td>{{ $item->userid }}</td></tr> 
                <tr> <td>মোবাইলঃ </td>       <td>{{ $item->mobile }}</td></tr> 

                    <tr><td> সার্ভিস আইডিঃ</td>         <td>{{ $item->serviceid }}</td></tr> 
                        <tr> <td>গ্রেডেশনঃ </td>  <td>{{ $item->gradation }}</td></tr> 
                            <tr> <td>বৈবাহিক অবস্থাঃ </td>  <td>{{ $item->marital_status }}</td></tr> 
                                <tr> <td>প্রথম নিয়োগঃ </td>  <td>{{ $item->join }}</td></tr> 
                                    <tr> <td>অবসরের তারিখঃ </td>  <td>{{ $item->retired }}</td></tr> 

                                        <tr><td>অফিসারের নিজ জেলাঃ </td>   <td>{{ $item->home_district }}</td></tr> 
                    @endforeach

                    
           
        </tbody>
    </table>
    <table>
        <caption>Wife  Information</caption>
         

        <tbody>
          
          
           
        
          
          
                @foreach ($wife as $item)
                 <tr><td>নামঃ </td>     <td> {{ $item->name }}</td></tr> 
                <tr> <td>  পেশাঃ  </td>         <td>{{ $item->profession }}</td></tr> 
                <tr> <td>  পদবীঃ  </td>       <td>{{ $item->designation }}</td></tr> 
                <tr> <td>    কর্মস্থল জেলাঃ </td>       <td>{{ $item->wifeworkplace }}</td></tr> 

                    <tr><td>   নিজ জেলাঃ </td>         <td>{{ $item->wifehomedistrict }}</td></tr> 
                        <tr> <td>  সন্তান সংখ্যাঃ </td>  <td>{{ $item->kids_number }}</td></tr> 
                              
                    @endforeach

                    
           
        </tbody>
    </table>
    <table>
        <caption>Child  Information</caption>
         

        <tbody>
           
                @foreach ($personal as $item)
                <tr>  <td>ID  </td> <td>{{ $item->id }}</td> </tr> 
                <tr><td>নামঃ </td>     <td> {{ $item->name }}</td></tr> 
                <tr> <td>ইমেইল এড্রেসঃ </td>         <td>{{ $item->email }}</td></tr> 
                <tr> <td>ইউজার আইডিঃ </td>       <td>{{ $item->userid }}</td></tr> 
                <tr> <td>মোবাইলঃ </td>       <td>{{ $item->mobile }}</td></tr> 

                    <tr><td> সার্ভিস আইডিঃ</td>         <td>{{ $item->serviceid }}</td></tr> 
                        <tr> <td>গ্রেডেশনঃ </td>  <td>{{ $item->gradation }}</td></tr> 
                            <tr> <td>বৈবাহিক অবস্থাঃ </td>  <td>{{ $item->marital_status }}</td></tr> 
                                <tr> <td>প্রথম নিয়োগঃ </td>  <td>{{ $item->join }}</td></tr> 
                                    <tr> <td>অবসরের তারিখঃ </td>  <td>{{ $item->retired }}</td></tr> 

                                        <tr><td>অফিসারের নিজ জেলাঃ </td>   <td>{{ $item->home_district }}</td></tr> 
                    @endforeach

                    
           
        </tbody>
    </table>
    <table>
        <caption>Present Workstation</caption>
         

        <tbody>
           
                @foreach ($personal as $item)
                <tr>  <td>ID  </td> <td>{{ $item->id }}</td> </tr> 
                <tr><td>নামঃ </td>     <td> {{ $item->name }}</td></tr> 
                <tr> <td>ইমেইল এড্রেসঃ </td>         <td>{{ $item->email }}</td></tr> 
                <tr> <td>ইউজার আইডিঃ </td>       <td>{{ $item->userid }}</td></tr> 
                <tr> <td>মোবাইলঃ </td>       <td>{{ $item->mobile }}</td></tr> 

                    <tr><td> সার্ভিস আইডিঃ</td>         <td>{{ $item->serviceid }}</td></tr> 
                        <tr> <td>গ্রেডেশনঃ </td>  <td>{{ $item->gradation }}</td></tr> 
                            <tr> <td>বৈবাহিক অবস্থাঃ </td>  <td>{{ $item->marital_status }}</td></tr> 
                                <tr> <td>প্রথম নিয়োগঃ </td>  <td>{{ $item->join }}</td></tr> 
                                    <tr> <td>অবসরের তারিখঃ </td>  <td>{{ $item->retired }}</td></tr> 

                                        <tr><td>অফিসারের নিজ জেলাঃ </td>   <td>{{ $item->home_district }}</td></tr> 
                    @endforeach

                    
           
        </tbody>
    </table>
    <table>
        <caption>Previous Workstation</caption>
         

        <tbody>
           
                @foreach ($personal as $item)
                <tr>  <td>ID  </td> <td>{{ $item->id }}</td> </tr> 
                <tr><td>নামঃ </td>     <td> {{ $item->name }}</td></tr> 
                             @endforeach

                    
           
        </tbody>
    </table>
    <table>
        <caption>Transfer Related</caption>
         

        <tbody>
           
                @foreach ($personal as $item)
                <tr>  <td>ID  </td> <td>{{ $item->id }}</td> </tr> 
                <tr><td>নামঃ </td>     <td> {{ $item->name }}</td></tr> 
                             @endforeach

                    
           
        </tbody>
    </table>
</body>
</html>
