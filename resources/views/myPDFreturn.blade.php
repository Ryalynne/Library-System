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
        <h3>STUDENT RETURN BOOK</h3>
    </center>
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
                <th scope="col" class="text-center">PENALTY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookList as $book)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                    <td>{{ $book->transaction }}</td>
                    <td>{{ $book->book->title }}</td>
                    </td>
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
    <br>
    <div class="footer-row">
        <span>Date Printed: {{ date('Y-m-d') }}</span>
        <br>
    </div>
    <br>
    <div class="footer-row">
        <span>Prepared by: <u>{{ auth()->user()->name }}</u></span>
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
        <span>Return by: <u>{{ $name }} {{ $middle }} {{ $lastname }}</u></span>
        <br>
        <span
            class="position">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Borrower</span>
    </div>
    </div>
</body>

</html>

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
