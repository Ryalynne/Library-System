<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRINT RETURN HISTORY</title>
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
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
    <center>
        <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
        <h3>RETURN HISTORY</h3>
    </center>
    <div class="table-container">
        <table class="table table-bordered">
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
                    <th scope="col">NAME OF BORROWER</th>
                    <th scope="col">DATE BORROWED</th>
                    <th scope="col">DUE DATE</th>
                    <th scope="col">DATE RETURNED</th>
                    <th scope="col">OVERDUE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($return as $item)
                <tr>
                    <td>{{ $item->transaction }}</td>
                    <td>{{ $item->book->id }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->book->author }}</td>
                    <td>{{ $item->book->department }}</td>
                    <td>{{ $item->book->copyright }}</td>
                    <td>{{ $item->book->accession }}</td>
                    <td>{{ $item->book->callnumber }}</td>
                    <td>{{ $item->book->subject }}</td>
                    <td>{{ ($studentName = $item->student_list($item->borrower)) ?: ($staffName = $item->staff_list($item->borrower)) ?: 'no info' }}
                    </td>
                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->duedate }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                    <td>{{ $item->returnpenalty($item->duedate,$item->updated_at) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="display: flex; justify-content: space-between; margin-top: 20px;">
        <div>
            <span>Date Printed: </span>
            <span>{{ date('Y-m-d') }}</span>
        </div>
        <div>
            <span>Prepared by: </span>
            <span><u>{{ auth()->user()->name }}</u></span>
        </div>
    </div>
</body>

</html>
