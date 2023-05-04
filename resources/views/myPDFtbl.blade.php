<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <br>
</head>
<center>
   <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
   <h3>BMA LIBRARY BOOK LIST</h3>
</center>

<body>
    <div class="container-center">
        <table class="table table-bordered myTable">
            <thead>
                <tr class="bg-success text-white">
                    <th>QR CODE</th>
                    <th>ISBN</th>
                    <th>BOOK TITLE</th>
                    <th>AUTHOR/S</th>
                    <th>DATE PUBLISH</th>
                    <th>PUBLISHER</th>
                    <th>GENRE</th>
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
                            {{ $book->isbn }}
                        </td>
                        <td>
                            {{ $book->booktitle }}
                        </td>
                        <td>
                            {{ $book->author }}
                        </td>
                        <td>
                            {{ $book->datepublish }}
                        </td>
                        <td >
                            {{ $book->publisher }}
                        </td>
                        <td>
                            {{ $book->genre }}
                        </td>
                        <td>
                            {{ date('Y-m-d', strtotime($book->created_at)) }}
                        </td>
                    </tr>
            </tbody>
            @endforeach
        </table>
        </div>
</body>

</html>

<style>
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
    h3{
        color: #20462c;
    }
</style>
