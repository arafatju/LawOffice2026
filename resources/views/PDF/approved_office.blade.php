<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>User Transaction Details</title>
    <style>
        body {
            font-family: 'SolaimanLipi', 'nikosh', 'AdorshoLipi', sans-serif;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 15px;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 15px 0;
            color: #2c3e50;
        }
        
        .user-info {
            background-color: white;
            padding: 12px;
            margin: 15px 0;
            border: 2px solid #bdc3c7;
            text-align: center;
        }
        
        .user-detail {
            display: inline-block;
            margin: 0 20px;
            font-size: 14px;
            font-weight: bold;
        }
        
        .table-title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0 15px 0;
            color: white;
            background-color: #3498db;
            padding: 12px;
            border-radius: 5px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            border: 2px solid #2c3e50;
            font-size: 12px;
        }
        
        /* Force header row to be visible */
        .header-row {
            background-color: #3498db;
            color: white;
            font-weight: bold;
            border: 2px solid #2c3e50;
        }
        
        .header-row td {
            background-color: #3498db !important;
            color: white !important;
            font-weight: bold !important;
            padding: 12px 8px !important;
            text-align: center !important;
            border: 1px solid #2980b9 !important;
            font-size: 13px !important;
        }
        
        td {
            border: 1px solid #7f8c8d;
            padding: 10px 6px;
            text-align: center;
            font-size: 12px;
            vertical-align: middle;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:nth-child(odd) {
            background-color: #ffffff;
        }
        
        /* Column widths */
        .col-serial { width: 8%; }
        .col-product { width: 32%; text-align: left; padding-left: 10px; }
        .col-code { width: 12%; }
        .col-quantity { width: 10%; }
        .col-time { width: 19%; font-size: 11px; }
        
        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 14px;
            color: #2c3e50;
            border-top: 2px solid #2c3e50;
            padding-top: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Details </h1>
        
        <div class="user-info">
           
            <span class="user-detail">Username: {{ $user->name }}({{ $user->personalInfo->office ?? 'N/A' }}) </span>
            
        </div>
    </div>
    
    <div class="table-title">Accepted Transaction info </div>
    
    <table>
        <!-- Header as regular table row instead of thead -->
        <tr class="header-row">
            <td class="col-serial">Serial </td>
            <td class="col-product">Product Name</td>
            <td class="col-code">Product Code</td>
            <td class="col-quantity">Quantity</td>
            <td class="col-time">Application Time</td>
            <td class="col-time">Delivery Time</td>
        </tr>
        
        @foreach ($transactions as $i => $tran)
        <tr>
            <td class="col-serial">{{ $i+1 }}</td>
            <td class="col-product">{{ $tran->product->name ?? 'N/A' }}</td>
            <td class="col-code">{{ $tran->prcode }}</td>
            <td class="col-quantity">{{ $tran->number }}</td>
            <td class="col-time">
                {{ $tran->created_at->format('d-m-Y') }}<br>
                {{ $tran->created_at->format('h:i A') }}
            </td>
            <td class="col-time">
                {{ $tran->updated_at->format('d-m-Y') }}<br>
                {{ $tran->updated_at->format('h:i A') }}
            </td>
        </tr>
        @endforeach
    </table>
    
    <div class="footer">
        <p>Total Transaction : {{ count($transactions) }}  | Report  Created At: {{ now()->format('d-m-Y h:i A') }}</p>
    </div>
</body>
</html>