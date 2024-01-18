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
        {{-- Display the QR code using the base64-encoded string --}}
        <img src="data:image/svg+xml;base64, {!! $qrcode !!}" alt="QR Code" id="qrcode">
        <p>{{$book->accession}}</p>
    </div>
    <p class="modal-book-title text-center"></p>
    <div class="text-center mt-2">
        <button class="btn btn-success bg-success border-success mx-2 rounded" onclick="downloadImage()">DOWNLOAD</button>
    </div>

    <script>
        function downloadImage() {
            var img = document.getElementById('qrcode');

            // Create a canvas to draw the image
            var canvas = document.createElement('canvas');
            canvas.width = img.width;
            canvas.height = img.height;
            var ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0);

            // Convert the canvas to a data URL
            var dataURL = canvas.toDataURL('image/png');

            // Create a temporary link element
            var downloadLink = document.createElement('a');
            downloadLink.href = dataURL;
            downloadLink.download = '{{$book->accession}}.png';

            // Append the link to the document
            document.body.appendChild(downloadLink);

            // Trigger a click on the link to start the download
            downloadLink.click();

            // Remove the temporary link element
            document.body.removeChild(downloadLink);

            alert('Image downloaded!');
        }
    </script>
</body>

</html>
