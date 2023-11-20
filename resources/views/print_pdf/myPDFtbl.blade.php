<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #20462c;
            color: white;
        }
    </style>
</head>

<body>
    <center>
        <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
        <h3>LIBRARY BOOK LIST</h3>
    </center>
    <table id="customers">
        <tr>
            <th>ID</th>
            <th>TITLE</th>
            <th>AUTHOR</th>
            <th>DEPARTMENT</th>
            <th>COPYRIGHT</th>
            <th>ACCESSION NO.</th>
            <th>CALLNUMBER</th>
            <th>SUBJECT</th>
        </tr>
        @if (count($books))
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->departments->departmentName }}</td>
                    <td>{{ $book->copyright }}</td>
                    <td>{{ $book->accession }}</td>
                    <td>{{ $book->callnumber }}</td>
                    <td>{{ $book->subjects->subjectName }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>NO BOOK FOUND</td>
            </tr>
        @endif
    </table>
</body>

</html>
