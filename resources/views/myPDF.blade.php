<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>How to Generate QR Code Using Simple QRcode In Laravel 8</title>

</head>
<body>
    <table border="1" style="border-collapse: collapse;">
        <tr>   @for ($i = 0; $i < $book->numberofcopies(); $i++)
            <td> <img src="data:image/png;base64, {!! $qrcode !!}"></td>
            {{-- <td>  {{ $book->booktitle }}</td>     --}}
            @endfor
        </tr>  
    </table>
</body>
</html>
