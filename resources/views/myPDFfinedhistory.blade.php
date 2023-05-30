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
    </center>
    <table class="table table-bordered myTable">
        <thead>
            <tr class="bg-success text-white">
                <th scope="col">Transaction</th>
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
                    <td>{{ $item->transaction }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->student->first_name }} {{ $item->student->middle_name }} {{ $item->student->last_name }}
                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->duedate }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                    <td>{{ $item->returnpenalty($item->duedate, $item->updated_at) }}</td>
                </tr>
        </tbody>
        @endforeach
    </table>
</body>
<div style="display: flex; justify-content: space-between; margin-top: 20px;">
    <div>
        <span>Date Printed: </span>
        <span><u>{{ date('Y-m-d') }}</u></span>
    </div>
    <br>
    <div>
        <span>Prepared by: </span>
        <span contenteditable="true"> <u>{{ auth()->user()->name }} </u></span>
    </div>
</div>
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
