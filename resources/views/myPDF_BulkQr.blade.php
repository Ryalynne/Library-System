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
            border: 1px solid black;
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
            background-color: #04AA6D;
            color: white;
        }

        .book-item {
            text-align: center;
        }

        .book-item img {
            max-width: 100%;
            height: auto;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <h1>QR CODE</h1>
    <table id="customers">
        @if (count($qrCodesAndBooks))
            @foreach ($qrCodesAndBooks as $book)
                @for ($i = 1; $i <= $book['book']->numberofcopies(); $i++)
                    @if (($i - 1) % 5 == 0)
                        <tr>
                    @endif
                    <td>
                        <div class="book-item">
                            <img src="data:image/png;base64, {!! $book['qrcode'] !!}">
                            <div>{{ $book['book']->accession }}</div>
                        </div>
                    </td>
                    @if ($i % 5 == 0 || $i == $book['book']->numberofcopies())
                        </tr>
                    @endif
                @endfor
            @endforeach
        @else
            <tr>
                <td>NO QR FOUND</td>
            </tr>
        @endif
    </table>
</body>
</html>
