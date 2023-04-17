<div class="container-center">
    <center>
        <h1>QR CODE</h1>
    </center>
    <br>
    @for ($i = 0; $i < $book->numberofcopies(); $i++)
        <div class="col">
            {{ $book->booktitle }}
        </div>
        <div class="col">
            <img src="data:image/png;base64, {!! $qrcode !!}">
        </div>
    @endfor
</div>
