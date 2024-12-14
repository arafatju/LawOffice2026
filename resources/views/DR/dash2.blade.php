<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Transfer Management System</title>
    <!-- Only include DataTables CSS (Bootstrap already installed) -->
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Data sheet</h2>
        <table id="users-table" class="table table-bordered"style="font-size: 13px;">
            <thead>
              
                       
            <tr>
                    <th>ID</th>
                    <th>ব্যাক্তিগত</th>
                    <th>গ্রেডেশন</th>
                    
                    <th>বর্তমান কর্মস্থল</th>
                     
                    <th>  যোগদান তারিখ  </th> 
                    <th> বৈবাহিক </th> 
                    <th>সন্তানাদি </th> 
                    <th> পূর্বের জেলা </th> 
                    <th> মেয়াদ</th> 
                    
                </tr>
            </thead>
        </table>
    </div>
 
    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('datasheet') }}',
                
                columns: [
                    {data:'id',name:'id'},
                    { data: 'user_details', name: 'user_details' },
                    { data: 'gradation', name: 'gradation' },  
                   
                    { data: 'working_present', name: 'working_present' }, 
                    
                    { data: 'join_date', name: 'join_date' }, 
                    { data: 'marriage', name: 'marriage' }, 
                   
                    { data: 'child_info', name: 'child_info' }, 
                    { data: 'previous', name: 'previous' }, 
                    { data: 'last', name: 'last' }, 

                     
            
                ],
            });
        });
    </script>
</body>
</html>
