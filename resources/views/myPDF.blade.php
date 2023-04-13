<div class="container-center">
<center><h1>QR CODE</h1></center>
<br>     
 
      <div class="container">
        <div class="row">
          <div class="col">
          @for($i = 0; $i < $book->numberofcopies(); $i++) 
            {{$book->booktitle}}
          </div>
          <div class="col">
            <img src="data:image/png;base64, {!! $qrcode !!}">
          </div>
          @endfor 
        </div>
      </div>
     
</div>





