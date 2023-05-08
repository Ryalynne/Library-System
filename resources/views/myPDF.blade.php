<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GENERATE QR CODE</title>
    <br>
</head>

<body>
    <center>
        <h1>QR CODE GENERATOR</h1>
        @if (5 <= $book->numberofcopies())
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 5)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 10)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 15)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 20)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 25)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 30)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 35)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 40)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 45)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 50)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 55)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 60)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 65)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 70)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 75)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 80)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 85)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 90)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 95)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
        @if ($book->numberofcopies() > 100)
            <div class="row">
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
                <div class="column"><img src="data:image/png;base64, {!! $qrcode !!}"></div>
            </div>
            <div class="row">
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
                <div class="column">{{ $book->booktitle }}</div>
            </div>
        @endif
</body>

</html>
<style>
    * {
        box-sizing: border-box;
    }

    /* Create four equal columns that floats next to each other */
    .column {
        float: left;
        width: 18%;
        padding: 5px;
        /* height: 100px; */
        /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
