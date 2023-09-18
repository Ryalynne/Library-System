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
    <table id="customers">
        @php
            $batchSize = 100; // Set the batch size
            $totalBooks = count($qrCodesAndBooks);
            $qrCodesPerRow = 5; // Number of QR codes per row
            $totalRows = ceil($totalBooks / $qrCodesPerRow);
        @endphp

        @if ($totalBooks > 0)
            @for ($row = 0; $row < $totalRows; $row++)
                <tr>
                    @for ($col = 0; $col < $qrCodesPerRow; $col++)
                        @php
                            $index = $row * $qrCodesPerRow + $col;
                            if ($index >= $totalBooks) {
                                break;
                            }
                            $book = $qrCodesAndBooks[$index]['book'];
                            $qrcode = $qrCodesAndBooks[$index]['qrcode'];
                        @endphp
                        <td>
                            <div class="book-item">
                                <img src="data:image/png;base64, {!! $qrcode !!}">
                                <div>{{ $book->accession }}</div>
                            </div>
                        </td>
                    @endfor
                </tr>
            @endfor
        @else
            <tr>
                <td>NO QR FOUND</td>
            </tr>
        @endif
    </table>
</body>

</html>
