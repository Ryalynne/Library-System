<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <br>
</head>

<body>
    <center>
        <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
        <h2>STUDENT LOST OR DAMAGE BOOK</h2>
    </center>
    <p><b>FORM LIB-10</b></p>
    <table class="table table-bordered myTable">
        <thead>
            <tr class="bg-success text-white">
                <th scope="col" class="text-center">TRANSACTION</th>
                <th scope="col" class="text-center">TITLE</th>
                <th scope="col" class="text-center">AUTHOR/S</th>
                <th scope="col" class="text-center">COPYRIGHT</th>
                <th scope="col" class="text-center">ACCESSION NO</th>
                <th scope="col" class="text-center">BORROW DATE</th>
                <th scope="col" class="text-center">DUE DATE</th>
                <th scope="col" class="text-center">OVERDUE</th>
            </tr>
        </thead>
        @foreach ($bookList as $book)
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                    <td>{{ $book->transaction }}</td>
                    <td>{{ $book->book->title }}</td>
                    <td>
                        {{ $book->book->author }}
                    </td>
                    <td>
                        {{ $book->book->copyright }}
                    </td>
                    <td>
                        {{ $book->book->accession }}
                    </td>
                    <td>
                        {{ date('Y-m-d', strtotime($book->created_at)) }}
                    </td>
                    <td>
                        {{ $book->duedate }}
                    </td>
                    <td>
                        {{ $book->penalty($book->duedate) }}
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
    <p>AMOUNT:________</p>
    <p>
        <b>Cadet's Library card is withheld until presentation of this receipt from your office Is fully validated.</b>
    </p>
    <br>
    <div class="footer-row">
        <span>Date Printed: {{ date('Y-m-d') }}</span>
        <br>
    </div>
    <br><br>
    <table id="my-table">
        <tbody>
            <tr>
                <td> <span>Prepared by: </span>
                </td>
                <td> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Verified by: </span>
                </td>
                <td> <span>Received by: </span>
                </td>
            </tr>
            <td><span>{{ auth()->user()->name }}</span>
            </td>
            <td><span>
                </span></td>
            <td><span>{{ $student->first_name }}
                    {{ $student->middle_name }}
                    {{ $student->lastname }}</span>
            </td>
        </tbody>
    </table>
    </div>
</body>

</html>

<style>
    #my-table {
        border-collapse: collapse;
    }

    #my-table td {
        border: none;
        padding: 0;
        font-size: 16px;
    }

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
