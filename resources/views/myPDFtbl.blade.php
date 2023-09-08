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
        <h3>BMA LIBRARY BOOK LIST</h3>
    </center>

    <table class="table table-bordered myTable">
        <thead>
            <tr class="bg-success text-white">
                <th>ID</th>
                <th style="max-width: 50%">TITLE</th>
                <th>AUTHOR/S</th>
                <th>DEPARTMENT</th>
                <th>COPYRIGHT</th>
                <th>ACCESSION NO.</th>
                <th>CALL NO.</th>
                <th>SUBJECT</th>
                <th>ADDED DATE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                    <td class="col-2">
                        {{ $book->id }}
                    </td>
                    <td>
                        {{ $book->title }}
                    </td>
                    <td>
                        {{ $book->author }}
                    </td>
                    <td>
                        {{ $book->department }}
                    </td>
                    <td>
                        {{ $book->copyright }}
                    </td>
                    <td>
                        {{ $book->accession }}
                    </td>
                    <td>
                        {{ $book->callnumber }}
                    </td>
                    <td>
                        {{ $book->subject }}
                    </td>
                    <td>
                        {{ date('Y-m-d', strtotime($book->created_at)) }}
                    </td>
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
