<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRINT ACTION LIST</title>
    <br>
</head>

<body>
    <center>
        <img src="image/bmaheader.png" width="100%" alt="" class="d-inline-block align-middle mr-2">
        <h3>BOOK ACTION HISTORY</h3>
    </center>
    <table class="table table-bordered myTable">
        <thead>
            <tr class="bg-success text-white">
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">TITLE</th>
                <th scope="col" class="text-center">AUTHOR/S</th>
                <th scope="col" class="text-center">DEPARTMENT</th>
                <th scope="col" class="text-center">COPYRIGHT</th>
                <th scope="col" class="text-center">ACCESSION NO</th>
                <th scope="col" class="text-center">CALL NO</th>
                <th scope="col" class="text-center">SUBJECT</th>
                <th scope="col" class="text-center">DATE OF ACTION</th>
                <th scope="col" class="text-center">ACTION PERFORM</th>
                <th scope="col" class="text-center">PERFORM BY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                    <td scope="row">
                        {{ $book->book->id }}
                    </td>
                    <td>
                        {{ $book->book->title }}
                    </td>
                    <td>
                        {{ $book->book->author }}
                    </td>
                    <td>
                        {{ $book->book->departments->departmentName ?? 'No Department' }}</td>
                    <td>
                        {{ $book->book->copyright }}
                    </td>
                    <td>
                        {{ $book->book->accession }}
                    </td>
                    <td>
                        {{ $book->book->callnumber }}
                    </td>
                    <td>
                        {{ $book->book->subjects->subjectName ?? 'No Subject' }}</td>
                    <td>
                        {{ date('Y-m-d', strtotime($book->created_at)) }}
                    </td>
                    <td>
                        {{ $book->action }}
                    </td>
                    <td>
                        {{ $book->performby }}
                    </td>
                </tr>
        </tbody>
        @endforeach
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
