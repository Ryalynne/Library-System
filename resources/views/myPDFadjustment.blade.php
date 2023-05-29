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
        <h3>BOOK ADJUSTMENT</h3>
    </center>
    <table class="table table-bordered myTable">
        <thead>
            <tr class="bg-success text-white">
                <th scope="col">ID</th>
                <th scope="col">TITLE</th>
                <th scope="col">AUTHOR/S</th>
                <th scope="col">COPYRIGHT</th>
                <th scope="col">ACCESSION NO</th>
                <th scope="col">DATE OF ACTION</th>
                <th scope="col">ACTION</th>
                <th scope="col">ADJUSTED</th>
                <th scope="col">PERFORM BY</th>
                <th scope="col">COMMENT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adjustment as $adjust)
                <tr>
                    <td>{{ $adjust->book->id }}</td>
                    <td>{{ $adjust->book->title }}</td>
                    <td>{{ $adjust->book->author }}</td>
                    <td>{{ $adjust->book->copyright }}</td>
                    <td>{{ $adjust->book->accession }}</td>
                    <td>{{ date('Y-m-d', strtotime($adjust->created_at)) }}</td>
                    <td>{{ $adjust->action }}</td>
                    <td>{{ $adjust->number_adjust }}</td>
                    <td>{{ $adjust->performby }}</td>
                    <td>{{ $adjust->comment }}</td>
                </tr>
            @endforeach
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
