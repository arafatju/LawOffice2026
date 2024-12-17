

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
              //    
                       
            <tr>
                    <th>ID</th>
                    <th>নাম</th>
                    <th>নিজ জেলা</th>
                    <th>সার্ভিস আইডি</th>

                    <th>গ্রেডেশন</th>
                    
                    <th>পদবী</th>
                    <th> বর্তমান কর্মস্থল জেলা</th>
                    <th>বর্তমান অফিস </th>
                      
                    <th>  যোগদান তারিখ  </th> 
                    <th> বৈবাহিক অবস্থা </th> 
                    <th> নাম </th> 
                    <th> পেশা </th> 
                    <th> পদবী </th> 
                    <th> কর্মস্থল জেলা </th> 
                    <th>    নিজ জেলা </th> 
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
                ajax: '{{ route('datasheet2') }}',
 
                columns: [
                    {data:'id',name:'id'},
                    { data: 'username', name: 'username' },
                    { data: 'userhomedistrict', name: 'userhomedistrict' },
                    { data: 'userserviceid', name: 'useuserserviceidrname' },
                    { data: 'gradation', name: 'gradation' },  
                    
                    { data: 'userdesignation', name: 'userdesignation' }, 
                    { data: 'userworkdistrict', name: 'userworkdistrict' },
                    { data: 'useroffice', name: 'useroffice' }, 
                    
                  




                    { data: 'join_date', name: 'join_date' }, 
                    { data: 'usermaritalstatus', name: 'usermaritalstatus' }, 
                    { data: 'userwifename', name: 'userwifename' }, 
                    { data: 'userwifeprofession', name: 'userwifeprofession' }, 
                    { data: 'userwifedesignation', name: 'userwifedesignation' }, 
                    { data: 'userwifeworkplace', name: 'userwifeworkplace' }, 
                    { data: 'userwifehomeplace', name: 'userwifehomeplace' }, 

                    { data: 'child_info', name: 'child_info' }, 
                    { data: 'previous', name: 'previous' }, 
                    { data: 'last', name: 'last' }, 

                     
            
                ],
                
            });
        });
    </script>
</body>
</html>
