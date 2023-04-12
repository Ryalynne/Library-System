<div class="container">
<center><h1>QR CODE</h1></center>
<table class="table table-bordered myTable">
  <tbody>
    @for ($i = 0; $i < $book->numberofcopies(); $i++)
    <tr>
      <div><img src="data:image/png;base64, {!! $qrcode !!}"> </div>
      <div>{{$book->booktitle}}</div>
    </tr>
    @endfor
  </tbody>
</table> 
</div>





