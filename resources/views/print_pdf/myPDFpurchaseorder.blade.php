<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        h3 {
            color: #20462c;
        }

        .transaction p {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .bordertbl th,
        .bordertbl td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #20462c;
            color: white;
        }

        .footer-row {
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <img src="image/bmaheader.png" width="100%" alt="">
            <h3>REQUISITION FORM</h3>
            <div class="transaction">
                @if ($transaction)
                    <p>TRANSACTION: {{ $transaction->transaction }}</p>
                @else
                    <p>No transaction found</p>
                @endif
            </div>
        </center>
        <p><b>FORM LIB-06</b></p>
        <div>
            <p>Vendor Name: {{ $vendor }}</p>
        </div>
        <div>
            <span>Date of Order: {{ date('Y-m-d') }}</span>
        </div>
        <table class="bordertbl">
            <thead>
                <tr>
                    <th>TITLE</th>
                    <th>QUANTITY</th>
                    <th>UNIT PRICE</th>
                    <th>TOTAL PRICE</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmount = 0; // Initialize the total amount variable
                @endphp
                @foreach ($bookdata as $item)
                    <tr>
                        <td>{{ $item->purchase->title }}</td>
                        <td>{{ $item->purchase->quantity }}</td>
                        <td>{{ $item->purchase->unitprice }}</td>
                        <td>{{ $item->computetotalprice($item->purchase->quantity, $item->purchase->unitprice) }}</td>
                    </tr>
                    @php
                        $totalAmount += $item->computetotalprice($item->purchase->quantity, $item->purchase->unitprice); // Add the total price to the total amount
                    @endphp
                @endforeach
                <tr>
                    <td colspan="3">TOTAL AMOUNT</td>
                    <td>{{ $totalAmount }}</td>
                </tr>
            </tbody>
        </table>
        <div class="footer-row">
            <span>Date of Delivery: {{ date('Y-m-d') }}</span>
        </div>
        <table>
            <tbody>
                <tr>
                    <td>Prepared by: ______________________________</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Noted by: ______________________________</td>
                    <td>Approved by: ____________________</td>
                </tr>
                <tr>
                    <td>Department Head</td>
                    <td>Librarian</td>
                    <td>School Director</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
