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
        <div class="row align-items-start ">
            <div class="col border-end">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2> BOOKS INFORMATION</h2>
                    </div>
                </div>
                <br>
                <div class="container text-start">
                    <center>
                        <img src="https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png"
                            class="img-thumbnail w-50" alt="...">
                    </center>
                    <div class="mb-3">
                        <label class="form-label">STUDENT ID</label>
                        {{-- <form action="{{ route('borrowpage') }}" method="get"> --}}
                        <input type="text" class="form-control studid" name="student" :value="old('student')"
                            value="{{ request()->input('student') ? $student->id : ' ' }}">
                        {{-- </form> --}}
                    </div>
                    <div class="mb-3">
                        <label for="booktitle" class="form-label">FULL NAME</label>
                        <input style="text-transform:uppercase" type="text" class="form-control full-name"
                            value="{{ request()->input('student') ? $student->name . ' ' . $student->middle . ' ' . $student->lastname : ' ' }}"
                            disabled>
                    </div>

                    <div class="mb-3">
                        <label for="booktitle" class="form-label">CLASS</label>
                        <input style="text-transform:uppercase" type="text" class="form-control class"
                            value="{{ request()->input('student') ? $student->class : ' ' }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2>BORROWED BOOK</h2>
                    </div>
                </div>
                <br>
                <div class="container text-center">
                    <div class="text-start">
                        <div class="row align-items-start">
                            <div class="col">
                                <button type="button" class="btn btn-success  w-50" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop" id="myBtn">
                                    Search Book
                                </button>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <input type="text" class="form-control bookid" id="exampleInputEmail1"
                                        data-student="{{ $student ? $student->id : '' }}">
                                    <div class="form-text">Scan QR Here...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered myTable" id="tbl">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>ISBN</th>
                            <th>BOOK TITLE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <br>
                <div class="text-end">
                    {{-- <form method="POST" action="{{ route('books.updatestatus') }}">
                        @csrf --}}
                    <button type="button" class="btn btn-success  w-50 btn-lg borrowbtn"
                        data-student="{{ $student ? $student->id : '' }}" data-token="{{ csrf_token() }}">Borrow
                        Books</button></a>
                    {{-- </form> --}}
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Search Bar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container">
                        <table class="table table-bordered">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>BOOK QR</th>
                                    <th>ISBN</th>
                                    <th>BOOK TITLE</th>
                                    <th>AUTHOR/S</th>
                                    <th>DATE PUBLISH</th>
                                    <th>PUBLISHER</th>
                                    <th>GENRE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    @if ($book->numberofcopies() > 0)
                                        <tr class="trtr">
                                            <th scope="row" class="getid">
                                                {{ $book->id }}
                                            </th>
                                            <td class="getisbn">
                                                {{ $book->isbn }}
                                            </td>
                                            <td class="getbooktitle">
                                                {{ $book->booktitle }}
                                            </td>
                                            <td>
                                                {{ $book->author }}
                                            </td>
                                            <td>
                                                {{ $book->datepublish }}
                                            </td>
                                            <td>
                                                {{ $book->genre }}
                                            </td>
                                            <td>
                                                {{ $book->genre }}
                                            </td>
                                            <td class="getstatus">
                                                @if (request()->input('student'))
                                                    {{ $book->getstatus(request()->input('student')) }}
                                                    @if (empty($book->getstatus(request()->input('student'))))
                                                        Available
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm btn-circle getdata">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                        <path
                                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                    </svg>
                                                </button>
                                            </td>
                                    @endif
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <br><br>
@section('script')
    <script>
        const bookdata = [];
        const bookList = [];

        $(".borrowbtn").on('click', function() {
            let studentId = $(this).data('student');
            let token = $(this).data('token');
            const formData = new FormData();
            formData.append('studentId', studentId);
            formData.append('bookList', bookList);
            formData.append('_token', token);

            if (bookList.length == 0) {
                alert('You need to add a book to the table to borrow!');
            } else {
                $.post('/book/borrow', {
                    'studentId': studentId,
                    'bookList': bookList,
                    '_token': token
                }, function(response) {
                    console.log(response);
                    alert('successfully borrowed');
                    location.reload();
                })
            }
        });

        var _changeInterval = null;
        $(".bookid").on("keyup", function() {

            let id = $(this).val().toLowerCase();

            let studentId = $(this).data('student');

            clearInterval(_changeInterval)
            _changeInterval = setInterval(function() {

                $.get("/bookstatus/" + id + "/" + studentId, function(data, status) {
                    try {
                        if (data.bookstatus.bookstatus == "onlend") {
                            console.log('onlend');
                            alert('The Book Already Borrowed')
                            $('.bookid').val("");
                        } else {
                            $.get("/book/" + id, function(data, status) {
                                if (!bookList.includes(data.book.id)) {
                                    bookList.push(data.book.id)
                                    bookdata.push(data.book.id)
                                    console.log(bookdata)
                                    if (data.book.id == null) {
                                        $('.bookid').val("");
                                    } else {
                                        var tr = document.createElement('tr');
                                        var td1 = tr.appendChild(document.createElement(
                                            'td'));
                                        var td2 = tr.appendChild(document.createElement(
                                            'td'));
                                        var td3 = tr.appendChild(document.createElement(
                                            'td'));
                                        td1.innerHTML = data.book.isbn;
                                        td2.innerHTML = data.book.booktitle;
                                        td3.innerHTML =
                                            '<button type="button" class="btn btn-success" onclick="deleteRow(this);">Remove</button>';
                                        document.getElementById("tbl").appendChild(tr);
                                        $('.bookid').val("");
                                        console.log('Available');
                                    }
                                } else {
                                    alert("The Book Already in the list");
                                    $('.bookid').val("");
                                }
                            });
                        }
                    } catch (error) {
                        $.get("/book/" + id, function(data, status) {
                            if (!bookList.includes(data.book.id)) {
                                bookList.push(data.book.id)
                                bookdata.push(data.book.id)
                                if (data.book.id == null) {
                                    $('.bookid').val("");
                                } else {
                                    var tr = document.createElement('tr');
                                    var td1 = tr.appendChild(document.createElement('td'));
                                    var td2 = tr.appendChild(document.createElement('td'));
                                    var td3 = tr.appendChild(document.createElement('td'));
                                    td1.innerHTML = data.book.isbn;
                                    td2.innerHTML = data.book.booktitle;
                                    td3.innerHTML =
                                        '<button type="button" class="btn btn-success" onclick="deleteRow(this);">Remove</button>';
                                    document.getElementById("tbl").appendChild(tr);
                                    $('.bookid').val("");
                                }
                            } else {
                                alert("The Book Already in the list");
                                $('.bookid').val("");
                            }
                        });
                    } finally {
                        $('.bookid').val("");
                    }
                });
                clearInterval(_changeInterval)
            }, 900);
        });

        $('.studid').on('keyup', function() {
            var id = $(this).val().toLowerCase();
            if (id == "") {
                $('.full-name').val("")
                $('.class').val("")
                document.location.href = "borrowpage";
                document.getElementById('myBtn').disabled = true;
            } else {
                $.get("/student/" + id, function(data, status) {

                    try {
                        if (id == data.student.id) {
                            document.location.href = "borrowpage" + '?student=' + data.student.id;
                            console.log('true');
                        }
                    } catch (err_value) {
                        document.location.href = "borrowpage";
                        console.log('false');
                    }

                });
            }
        });
        var $iddata = "";

        $(".getdata").on('click', function() {

            var $row = $(this).closest(".trtr");
            $iddata = $row.find(".getid").text();
            var $status = $row.find(".getstatus").text();

            $.get("/book/" + $iddata, function(data, status) {
                if ($status.includes("onlend")) {
                    alert('The Book Already Borrowed');
                } else if (!bookList.includes(data.book.id)) {
                    bookList.push(data.book.id)
                    var tr = document.createElement('tr');
                    var td1 = tr.appendChild(document.createElement(
                        'td'));
                    var td2 = tr.appendChild(document.createElement(
                        'td'));
                    var td3 = tr.appendChild(document.createElement(
                        'td'));
                    td1.innerHTML = data.book.isbn;
                    td2.innerHTML = data.book.booktitle;
                    td3.innerHTML =
                        '<button type="button" class="btn btn-success" onclick="deleteRow(this);">Remove</button>';
                    document.getElementById("tbl").appendChild(tr);
                    $('.bookid').val("");
                    alert('Added Successfully');
                } else {
                    alert('The Book Already in the list');
                }
            });
        });

        function deleteRow(el) {
            if (!confirm("Are you sure you want to remove this?")) return;
            var row = el.parentNode.parentNode.rowIndex;
            tbl.deleteRow(row);
            bookList.pop(row)
            // console.log(bookList);
        }
    </script>
@endsection
@endsection
