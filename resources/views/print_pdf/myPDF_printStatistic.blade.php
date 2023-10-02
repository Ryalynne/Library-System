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
        <h3>STATISTICS OF BORROWED BOOK</h3>
    </center>
    <p>Date Start: {{$startingDate}}  Date End: {{$endDate}}</p>
    <table class="table table-bordered myTable">
        <thead>
            <tr class="bg-success text-white">
                <th style="max-width: 50%">DATE</th>
                <th>DAY</th>
                <th>BORROWED COUNT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($onlendCounts as $date => $count)
                <tr>
                    <td>{{ $date }}</td>
                    <td>{{ \Carbon\Carbon::parse($date)->format('l') }}</td>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
            <tr class="bg-danger text-white">
                <td colspan="2">Total:</td>
                <td>
                    @php
                        $totalCount = 0;
                        echo array_sum($onlendCounts) - $totalCount;
                    @endphp
                </td>
            </tr>
        </tbody>
    </table>

    <div style="display: flex; justify-content: space-between; margin-top: 20px;">
        <div>
            <span>Date Printed: </span>
            <span>{{ date('Y-m-d') }}</span>
        </div>
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
