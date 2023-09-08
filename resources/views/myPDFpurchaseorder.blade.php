<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        hr {
            display: block;
            width: 20%;
            border-top: 0px solid #000000;
            margin: 1em 0;
            padding: 0;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border: 1px solid #727272;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            border: 1px solid #727272;
            background-color: #20462c;
            color: white;
        }

        h3 {
            color: #20462c;
        }

        @media screen and (max-width: 768px) {
            table {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
            <h3>PUCHASE ORDER</h3>
            <div class="transaction">
                @if ($transaction)
                    <p>TRANSACTION: {{ $transaction->transaction}}</p>
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
           
        </div> <br>
        <div class="table-container">
            <table id="purchaseTable" class="table table-bordered">
                <thead>
                    <tr class="bg-success text-white">
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
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                            <td>{{ $item->purchase->title }}</td>
                            <td>{{ $item->purchase->quantity }}</td>
                            <td>{{ $item->purchase->unitprice }}</td>
                            <td>{{ $item->computetotalprice($item->purchase->quantity, $item->purchase->unitprice) }}
                            </td>
                            {{-- <td>{{ $item->computetotalprice->unitprice }}</td> --}}
                        </tr>
                        @php
                            $totalAmount += $item->computetotalprice($item->purchase->quantity, $item->purchase->unitprice); // Add the total price to the total amount
                        @endphp
                    @endforeach
                    <tr>
                        <th>TOTAL AMOUNT</th>
                        <td colspan="3">{{ $totalAmount }}</td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="footer-row">
            <span>Date of Delivery: {{ date('Y-m-d') }}</span>
            <br>
        </div>
        <div class="footer-row">
            <span>Prepared by: <u>{{ auth()->user()->name }} </u></span>
            <br>
            <span
                class="position">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Department Head</span>
        </div>
        <div class="footer-row">
            <span>Noted by:</span>
            <br>
            <span
                class="position">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Librarian</span>
        </div>

        <div class="footer-row">
            <span>Approved by:</span>
            <br>
            <span
                class="position">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Director</span>
        </div>
    </div>
</body>

</html>
