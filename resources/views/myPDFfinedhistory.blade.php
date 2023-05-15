<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRINT STUDENT LOST OR DAMAGE BOOK</title>
    <br>
</head>

<body>
    <center>
        <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
        <h3>STUDENT LOST OR DAMAGE BOOK</h3>
        <p>Printed at : {{ date('F d, Y') }} and Printed by : {{ auth()->user()->name }}</p>
    </center>
    <table class="table table-bordered myTable">
        <thead>
            <tr class="bg-success text-white">
                <th scope="col">Qr Code</th>
                <th scope="col">Book Title</th>
                <th scope="col">Name of Borrower</th>
                <th scope="col">Date Borrowed</th>
                <th scope="col">Due Date</th>
                <th scope="col">Book Fine</th>
                <th scope="col">Penalty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fine as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->book->booktitle }}</td>
                    <td>{{ $item->student->name }} {{ $item->student->middle }} {{ $item->student->lastname }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->duedate }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                    <td>{{ $item->returnpenalty($item->duedate, $item->updated_at) }}</td>
                </tr>
        </tbody>
        @endforeach
    </table>
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

    footer {
        position: fixed;
        bottom: -30px;
        left: 0px;
        right: 0px;
        height: 120px;
        font-size: 20px !important;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    p {
        font-size: 90%;
        color: #20462c;
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
</style>
