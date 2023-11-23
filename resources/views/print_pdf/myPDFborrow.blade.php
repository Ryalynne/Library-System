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

        #my-table {
            border-collapse: collapse;
        }

        #my-table td {
            border: none;
            padding: 0;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
            <h3>BORROWED BOOK</h3>
            <div class="transaction">
                @if ($transaction)
                    <p>TRANSACTION: {{ $transaction }}</p>
                @else
                    <p>No transaction found</p>
                @endif
            </div>
        </center>
        <p><b>FORM LIB-11</b></p>
        <span>Date Borrowed: {{ date('Y-m-d') }}</span>
        <br>
        <div>
            <p>Please be reminded that the following books/library resources are must not overdue:</p>
        </div>
        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-success text-white">
                        <th>TITLE</th>
                        <th>AUTHOR/S</th>
                        <th>DEPARTMENT</th>
                        <th>COPYRIGHT</th>
                        <th>ACCESSION NO</th>
                        <th>CALL NO</th>
                        <th>SUBJECT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookList as $book)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->departments->departmentName ?? 'No Department' }}</td>
                            <td>{{ $book->copyright }}</td>
                            <td>{{ $book->accession }}</td>
                            <td>{{ $book->callnumber }}</td>
                            <td>{{ $book->subjects->subjectName ?? 'No Subject' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="notice">You are instructed to return the said book/s on time. Failure to comply will result in
            non-issuance of
            another book and a fine.</p>
        <br>
        <div class="footer-row">
            <span>DUE DATE: {{ $duedate }}</span>
            <br>
        </div>
        <br><br>
        <table id="my-table">
            <tbody>
                <tr>
                    <td> <span>PREPARED BY: </span>
                    </td>
                    <td> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            VERIFIED BY: </span>
                    </td>
                    <td> <span>RECEIVED BY: </span>
                    </td>
                </tr>
                <td><span>{{ auth()->user()->name }}</span>
                </td>
                <td><span>
                    </span></td>
                <td><span>{{ $borrowedby }}</span>
                </td>
            </tbody>
        </table>

    </div>
</body>

</html>
