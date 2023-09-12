{{-- <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOK QR</title>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto;
            grid-gap: auto;
            background-color: #ffffff;
            padding: 10px;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            padding: 1px;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <center>
        <h1>QR CODE GENERATOR</h1>
    </center>
    <br>
    {{-- <div class="book-container">
        @foreach ($qrCodesAndBooks as $data)
            @for ($i = 1; $i <= $data['book']->numberofcopies(); $i++)
                <div class="book-item">
                    <img src="data:image/png;base64, {!! $data['qrcode'] !!}">
                    <div>{{ $data['book']->accession }}</div>
                </div>
            @endfor
        @endforeach
    </div> 

    <div class="grid-container">
        @foreach ($qrCodesAndBooks as $data)
            @for ($i = 1; $i <= $data['book']->numberofcopies(); $i++)
                <div class="grid-item">
                    <img src="data:image/png;base64, {!! $data['qrcode'] !!}">
                    {{-- <div>{{ $data['book']->accession }}</div> 
                </div>
                <div class="grid-item">
                    {{ $data['book']->accession }}
                </div>
            @endfor
        @endforeach
    </div>
</body>

</html> --}}


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOK QR</title>
    <br>
</head>

<body>
    <center>
        <h1>QR CODE</h1>

        <br>
        <div class="book-container">
            @foreach ($qrCodesAndBooks as $data)
                @for ($i = 1; $i <= $data['book']->numberofcopies(); $i++)
                    <div class="book-item">
                        <img src="data:image/png;base64, {!! $data['qrcode'] !!}">
                        <div>{{ $data['book']->accession }}</div>
                    </div>
                @endfor
            @endforeach
        </div>
    </center>
</body>

</html>
<style>
    .book-container {
        display: flex;
        flex-wrap: wrap;
    }

    .book-item {
        display: inline-block;
        margin-right: 5px;
        margin-left: 5px;
        margin-bottom: 10px;
        text-align: center;
    }

    .book-item img {
        max-width: 180px;
        height: auto;
    }
</style>
