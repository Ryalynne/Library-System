@extends('layouts.app')

@section('content')
    <br>
    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-success">Books Management</li>
                <li class="breadcrumb-item text-success" aria-current="page">Books Issued / Returned</li>
                <li class="breadcrumb-item active text-success" aria-current="page">Books Issued</li>
            </ol>
        </nav>
    </div>
    <br>
    <div class="container text-center">
        <div class="row align-items-start">   
            <div class="col">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2> BOOKS INFORMATION</h2>
                    </div>
                </div>
                <br>      
                <div class="container text-start">
                    <center>
                    <img src="https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png" class="img-thumbnail w-50" alt="...">
                    </center>
                    <div class="mb-3">
                        <label class="form-label">STUDENT ID</label>
                        <input type="text" class="form-control studid"  name="studid" :value="old('studid')">
                    </div>
                    <div class="mb-3">
                        <label for="booktitle" class="form-label">FULL NAME</label>
                        <input style="text-transform:uppercase" type="text" class="form-control full-name" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="booktitle" class="form-label">CLASS</label>
                        <input style="text-transform:uppercase" type="text" class="form-control class" disabled>
                    </div>
                    <div class="row justify-content-start">                       
                        <div class="col">
                            <button type="button" class="btn btn-danger  w-100 btn-lg">Return Book</button>
                        </div>                     
                        <div class="col">                        
                          <button type="button" class="btn btn-success  w-100 btn-lg">Lend Books</button>
                        </div>                                  
                    </div>
                </div>  
              
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2>Book Borrowed</h2>
                    </div>
                </div>
                <br>

                <div class="p-2">
                    <div class="input-group">
                        <input type="search" class="form-control rounded myInput" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" />
                    </div>
                </div>

                <div class="container">
                    <table class="table table-bordered">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>BOOK TITLE</th>
                                <th>DATE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <br>

                <br>
                       
            </div>  
        </div>
    </div>
    <br><br>
@section('script')
    <script>     
    $(".bookid").on("keyup", function() {
            var id = $(this).val().toLowerCase();
            if (id == "") {               
                $('.book-title').val("")
                $('.book-author').val("")
                $('.book-datepublish').val("")
                $('.book-isbn').val("")
                $('.book-genre').val("")
                $('.book-publisher').val("")
                $('.book-addeddate').val("")
            } 
            else {
                $.get("/book/" + id, function(data, status) {
                    $('.book-title').val(data.book.booktitle)
                    $('.book-author').val(data.book.author)
                    $('.book-datepublish').val(data.book.datepublish)
                    $('.book-isbn').val(data.book.isbn)
                    $('.book-genre').val(data.book.genre)
                    $('.book-publisher').val(data.book.publisher)
                    $('.book-addeddate').val(data.book.addeddate)
                });
            }
        });
        $('.bookid').on('keyup', function() {
            var id = $(this).val().toLowerCase();
            if (id == "") {
                $('.copy-copies').val("")
            } else {
                $.get("/copy/" + id, function(data, status) {
                    $('.copy-copies').val(data.copy)
                });
            }
        });
        $('.studid').on('keyup', function() {
            var id = $(this).val().toLowerCase();
            if (id == "") {            
                $('.full-name').val("")
                $('.class').val("")
            } else {
                $.get("/student/" + id, function(data, status) {
                    $('.full-name').val(data.student.name +" " + data.student.middle +", "+ data.student.lastname);
                    $('.class').val(data.student.class);    
                     
                });           
            }
        });   
   </script>
@endsection
@endsection