<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOK QR</title>
    <br>
</head>

<body>
    <center> <h1>QR CODE GENERATOR</h1></center>
    <br>
    <div class="book-container">
        @for ($i = 1; $i <= $book->numberofcopies(); $i++)
          <div class="book-item">
            <img src="data:image/png;base64, {!! $qrcode !!}">
            <div>{{ $book->title }}</div>
          </div>
        @endfor
      </div>

</body>

</html>
<style>
  .book-container {
    display: flex;
    flex-wrap: wrap;
  }

  .book-item {
    display: inline-block;
    margin-right: 50px;
    text-align: center;
  }

  .book-item img {
    max-width: 100%;
    height: auto;
  }
</style>
