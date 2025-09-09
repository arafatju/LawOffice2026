<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Product Details</title>
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
            background-color: #ecf0f1;
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
        
        /* Updated header row styling - white background, black text */
        .header-row {
            background-color: white;
            color: black;
            font-weight: bold;
            border: 2px solid #2c3e50;
        }
        
        .header-row td {
            background-color: white !important;
            color: black !important;
            font-weight: bold !important;
            padding: 12px 8px !important;
            text-align: center !important;
            border: 1px solid #2c3e50 !important;
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
        .col-product { width: 20%; text-align: left; padding-left: 10px; }
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
        <h1>Transaction Details</h1>
        <p>Office: {{ $office }}</p>
        <p> Month: {{ $month }}, Year: {{ $year }}</p>
        <p>Report Date: {{ now()->format('d-m-Y') }}</p>
    </div>

    <div class="table-title">Transaction info</div>

    <table>
        <!-- Header with white background and black text -->
        <tr class="header-row">
            <td class="col-serial">Serial</td>
            <td class="col-product">Product Name</td>
            <td class="col-code">Product Code</td>
            <td class="col-code">Product Category</td>
            <td class="col-quantity">Quantity</td>
            <td class="col-time"> Applied </td>
            <td class="col-time">Delivered </td>
        </tr>
        
        @foreach ($transactions as $tran)
        <tr>
            <td class="col-serial">{{ $loop->iteration }}</td>
            <td class="col-product">{{ $tran->product->name ?? 'N/A' }}</td>
            <td class="col-code">{{ $tran->product->prcode ?? 'N/A' }}</td>
            <td class="col-category">{{ $tran->product->category ?? 'N/A' }}</td>
            <td class="col-quantity">{{ $tran->number }}</td>
            <td class="col-time">
                {{ $tran->created_at->format('j F Y') }}<br>
                {{ $tran->created_at->format('g.i a') }}
            </td>
            
            <td class="col-time">
                {{ $tran->updated_at->format('j F Y') }}<br>
                {{ $tran->updated_at->format('g.i a') }}
            </td>
            
        </tr>
        @endforeach
    </table>
    
    <div class="footer">
        <p>Total Transactions: {{ count($transactions) }} | Report Created At: {{ now()->format('d-m-Y h:i A') }}</p>
    </div>
</body>
</html>