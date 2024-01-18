<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>{{ $book->title }}</p>
    <div class="text-center">
        <img src="data:image/svg+xml;base64, {!! $qrcode !!}" alt="QR Code" id="qrcode">
        <p>{{ $book->accession }}</p>
    </div>
    <p class="modal-book-title text-center"></p>
    <div class="text-center mt-2">
        <button class="btn btn-success bg-success border-success mx-2 rounded"
            onclick="downloadImage()">DOWNLOAD</button>
    </div>

    <script>
        function downloadImage() {
            var img = document.getElementById('qrcode');
            var canvas = document.createElement('canvas');
            canvas.width = img.width;
            canvas.height = img.height + 20;
            var ctx = canvas.getContext('2d');

            ctx.fillStyle = '#fff';
            ctx.fillRect(0, img.height, canvas.width, 20);

            ctx.drawImage(img, 0, 0);

            ctx.font = '10px Arial';
            ctx.fillStyle = '#000';
            ctx.textAlign = 'center';
            ctx.fillText('{{ $book->accession }}', canvas.width / 2, img.height + 16);

            var dataURL = canvas.toDataURL('image/png');
            var downloadLink = document.createElement('a');
            downloadLink.href = dataURL;
            downloadLink.download = '{{ $book->accession }}.png';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
            alert('Image downloaded!');
        }
    </script>
</body>

</html>
