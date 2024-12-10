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
            width: 100%;
            max-width: 100%; /* Ensure the table does not overflow the page width */
            border-collapse: collapse;
            table-layout: fixed; /* Fix the table layout */
        }

        th, td {
            border: 1px solid #000;
            padding: 0px;
            text-align: center;
            word-wrap: break-word; /* Allow words to break and wrap in the cell */
            overflow: hidden;
            text-overflow: ellipsis; /* Add ellipsis for overflowing text */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td {
            max-width: 80px; /* Limit the maximum width of each column */
        }

        /* For controlling page breaks when printing */
        @media print {
            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
    </style>
</head>
<h1>বাংলা ভাষায় ডকুমেন্ট</h1>
    <p>এটি একটি উদাহরণ পিডিএফ যেখানে নিকোশ ফন্ট ব্যবহৃত হয়েছে।</p>
<body>
    <table>
        <thead>
            <tr>
                <th>Serial বাংলা ভাষায় ডকুমেন্ট</th>
                <th>Name</th>
                <th>Home District</th>
                <th>Sevice ID</th>
                <th>Gradation</th>
                <th>Designation</th>
                <th>Working Station</th>
                <th>Court/Institute</th>
                <th>Date of Joining at Current Post </th>
                <th>Marital Status</th>
                <th>Spouse Name </th>
                <th>Spouse Designation </th>
                <th>Spouse Workplace</th>
                <th>Spouse Home District</th>
                <th>Children Details </th>
                <th>Offier's Previous Distrcits</th>
                <th>Preferred Districts </th>
                <th>Reasons for transfers </th>
                <th>Duration at Station </th>
                 
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->id }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
