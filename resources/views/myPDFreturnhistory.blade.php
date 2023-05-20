<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRINT RETURN HISTORY</title>
    <br>
</head>

<body>
    <center>
        <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
        <h3>PRINT RETURN HISTORY</h3>
    </center>
    <table class="table table-bordered myTable">
        <thead>
            <tr class="bg-success text-white">
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Author/s</th>
                <th scope="col">Name of Borrower</th>
                <th scope="col">Date Borrowed</th>
                <th scope="col">Due Date</th>
                <th scope="col">Returned</th>
                <th scope="col">Penalty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($return as $item)
                <tr>
                    <td>{{ $item->book->id }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->book->author }}</td>
                    <td>{{ $item->student->name }} {{ $item->student->middle }} {{ $item->student->lastname }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                    <td>{{ $item->duedate }}</td>
                    <td>{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                    <td>{{ $item->returnpenalty($item->duedate,$item->updated_at) }}</td>
                </tr>
            @endforeach
        </tbody>

        </tbody>
    </table>
</body>
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
        bottom: -60px;
        left: 0px;
        right: 0px;
        height: 120px;
        font-size: 20px !important;
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
</style>
