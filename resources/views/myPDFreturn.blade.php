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
        <h3>STUDENT RETURN BOOK</h3>
      </center>
    <table class="table table-bordered myTable">
        <thead>
            <tr class="bg-success text-white">
                <th scope="col" class="text-center">ISBN</th>
                <th scope="col" class="text-center">BOOK TITLE</th>
                <th scope="col" class="text-center">AUTHOR/S</th>
                <th scope="col" class="text-center">DATE PUBLISH</th>
                <th scope="col" class="text-center">PUBLISHER</th>
                <th scope="col" class="text-center">GENRE</th>
                <th scope="col" class="text-center">BORROW DATE</th>
                <th scope="col" class="text-center">DUE DATE</th>
                <th scope="col" class="text-center">PENALTY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookList as $book)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                    <td>{{$book->book->isbn}}</td>
                    </td>
                    <td>
                        {{ $book->book->booktitle }}
                    </td>
                    <td>
                        {{ $book->book->author}}
                    </td>
                     <td>
                        {{ $book->book->datepublish }}
                    </td>
                  <td>
                        {{ $book->book->publisher }}
                    </td>
                    <td>
                        {{ $book->book->genre }}
                    </td>
                    <td>
                        {{ date('Y-m-d', strtotime($book->created_at)) }} 
                    </td>
                    <td>
                         {{$book->duedate}}
                    </td> 
                    <td>
                        {{ $book->penalty($book->duedate) }}
                   </td>  
                </tr>
        </tbody>
        @endforeach
    </table>
    <footer>
        <hr>
        <h5>Signature over Printed Name</h5>
    </footer>
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
    h3{
        color: #20462c;
    }
</style>
