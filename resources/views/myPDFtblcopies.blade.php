<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <br>
</head>
<center>
    <h1>BMA LIBRARY BOOK LIST AND COPIES</h1>
</center>
<table class="table table-bordered myTable">
    <thead>
        <tr class="bg-success text-white">
            <th scope="col" class="text-center">QR CODE</th>
            <th scope="col" class="text-center">ISBN</th>
            <th scope="col" class="text-center">BOOK TITLE</th>
            <th scope="col" class="text-center">AUTHOR/S</th>
            <th scope="col" class="text-center">DATE PUBLISH</th>
            <th scope="col" class="text-center">PUBLISHER</th>
            <th scope="col" class="text-center">GENRE</th>
            <th scope="col" class="text-center">COPIES</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                <td scope="row">
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
                <td>
                    {{ $book->publisher }}
                </td>
                <td>
                    {{ $book->genre }}
                </td>
                <td class="px-6 py-3">
                    {{ $book->numberofcopies() }}
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
        background-color: #1f9d60;
        color: white;
    }
</style>
