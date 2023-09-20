<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRINT ONLEND HISTORY</title>
</head>

<body>
    <center>
        <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
        <h3>ONLEND BOOK</h3>
    </center>
    <table class="table table-bordered myTable">
        <thead>
            <tr class="bg-success text-white">
                <th scope="col">TRANSACTION</th>
                <th scope="col">ID</th>
                <th scope="col">TITLE</th>
                <th scope="col">AUTHOR/S</th>
                <th scope="col">DEPARTMENT</th>
                <th scope="col">COPYRIGHT</th>
                <th scope="col">ACCESSION NO</th>
                <th scope="col">CALL NO</th>
                <th scope="col">SUBJECT</th>
                <th scope="col">BORROWER NAME</th>
                <th scope="col">DATE BORROWED</th>
                <th scope="col">DUE DATE</th>
                <th scope="col">OVERDUE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrow as $item)
                <tr class="tr">
                    <td>{{ $item->transaction }}</td>
                    <td>{{ $item->book->id }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->book->author }}</td>
                    <td>{{ $item->book->department }}</td>
                    <td>{{ $item->book->copyright }}</td>
                    <td>{{ $item->book->accession }}</td>
                    <td>{{ $item->book->callnumber }}</td>
                    <td>{{ $item->book->subject }}</td>
                    <td>{{ $item->borrower}}</td>
                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->duedate }} </td>
                    <td>{{ $item->penalty($item->duedate) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="display: flex; justify-content: space-between; margin-top: 20px;">
        <div>
            <span>Date Printed: </span>
            <span>{{ date('Y-m-d') }}</span>
        </div>
        <br>
        <div>
            <span>Prepared by: </span>
            <span contenteditable="true" style="border-bottom: 1px solid #727272;">{{ auth()->user()->name }}</span>
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
