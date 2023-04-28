<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <br>
</head>
<center>
   <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
   <h3>BMA LIBRARY ACTION LIST</h3>
</center>
<table class="table table-bordered myTable">
    <thead>
        <tr class="bg-success text-white">
            <th scope="col" class="text-center">QR CODE</th>
            <th scope="col" class="text-center">ISBN</th>
            <th scope="col" class="text-center">BOOK TITLE</th>
            <th scope="col" class="text-center">DATE OF ACTION</th>
            <th scope="col" class="text-center">ACTION PERFORM</th>
            <th scope="col" class="text-center">PERFORM BY</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                <td scope="row">
                    {{ $book->id}}
                </td>
                <td>
                    {{ $book->book->isbn }}
                </td>
                <td>
                    {{ $book->book->booktitle }}
                </td>
                <td>
                    {{date('Y-m-d', strtotime($book->created_at))}}
                </td>
                <td>
                    {{ $book->action}}
                </td>
                <td>
                    {{ $book->performby }}
                </td>
            </tr>
    </tbody>
    @endforeach
</table>

<body>

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
