<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100%;
            height: auto;
        }

        h3 {
            color: #20462c;
            margin-top: 20px;
        }

        .transaction {
            text-align: center;
            margin-bottom: 20px;
        }

        .transaction p {
            margin: 0;
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
            text-align: center;
            padding: 8px;
            border: 1px solid #727272;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #20462c;
            color: white;
        }

        p.notice {
            margin-top: 20px;
            text-align: center;
        }

        .footer-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .footer-row div {
            text-align: center;
        }

        .footer-row span {
            font-weight: bold;
        }

        .position {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="image/bmaheader.png" alt="">
            <h3>STUDENT BORROWED BOOK</h3>
        </div>
        <div class="transaction">
            @if ($transaction)
                <p>TRANSACTION: {{ $transaction }}</p>
            @else
                <p>No transaction found</p>
            @endif
        </div>
        <div>
            <p>Please be reminded that the following books/library resources are overdue:</p>
        </div>
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-success text-white">
                        <th>TITLE</th>
                        <th>AUTHOR/S</th>
                        <th>COPYRIGHT</th>
                        <th>BORROWED DATE</th>
                        <th>DUE DATE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookList as $book)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->copyright }}</td>
                            <td>{{ date('Y-m-d', strtotime(now())) }}</td>
                            <td>{{ date('Y-m-d', strtotime('+3 days', strtotime(now()))) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="notice">You are instructed to return the said book/s. Failure to comply will result in non-issuance of
            another book and a fine.</p>
        <div class="footer-row">
            <span>Date Printed: {{ date('Y-m-d') }}</span>
            <br>
        </div>
        <div class="footer-row">
            <span>Prepared by: {{ auth()->user()->name }}</span>
            <br>
            <span
                class="position">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Librarian</span>
        </div>
        <div class="footer-row">
            <span>Verified by: ____________</span>
            <br>
            <span
                class="position">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School
                Director</span>
        </div>
        <div class="footer-row">
            <span>Received by: {{ $name }} {{ $middle }} {{ $lastname }}</span>
            <br>
            <span
                class="position">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Borrower</span>
        </div>
    </div>
</body>

</html>
