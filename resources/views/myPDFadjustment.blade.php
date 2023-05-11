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
                <th scope="col">QR CODE</th>
                <th scope="col">ISBN</th>
                <th scope="col">BOOK TITLE</th>
                <th scope="col">DATE OF ACTION</th>
                <th scope="col">ACTION PERFORM</th>
                <th scope="col">NUMBER ADJUSTED</th>
                <th scope="col">PERFORM BY</th>
                <th scope="col">COMMENT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adjustment as $adjust)
                <tr>
                    <td>{{ $adjust->bookid }}</td>
                    <td>{{ $adjust->book->isbn }}</td>
                    <td>{{ $adjust->book->booktitle }}</td>
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
