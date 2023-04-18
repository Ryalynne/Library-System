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
                                    {{-- <form action="{{ route('borrowpage') }}" method="get"> --}}
                                    <input type="text" class="form-control bookid" id="exampleInputEmail1"
                                        data-student="{{ $student ? $student->id : '' }}">
                                    <div class="form-text">Scan QR Here...</div>
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered" id="tbl">
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
                    <button type="button" class="btn btn-success  w-50 btn-lg">Borrow Books</button></a>
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
                                        <tr>
                                            <th scope="row">
                                                {{ $book->id }}
                                            </th>
                                            <td>
                                                {{ $book->isbn }}
                                            </td>
                                            <td>
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
                                            <td>
                                                @if (request()->input('student'))
                                                    {{ $book->getstatus(request()->input('student')) }}
                                                    @if (empty($book->getstatus(request()->input('student'))))
                                                        Available
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success edit-button btn-sm btn-circle"
                                                    data-bs-target="#staticBackdrop">
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
        $(".bookid").on("keyup", function() {
            var id = $(this).val().toLowerCase();
            let studentId = $(this).data('student')
            if (id == "") {
                $('.book-title').val("")
                $('.book-author').val("")
                $('.book-datepublish').val("")
                $('.book-isbn').val("")
                $('.book-genre').val("")
                $('.book-publisher').val("")
                $('.book-addeddate').val("")
            } else {
                $.get("/book/" + id + "/" + studentId, function(data, status) {

                    if (data.book.bookstatus == "onlend") {
                        console.log('onlend');
                        $('.bookid').val("");
                    } else {
                        var tr = document.createElement('tr');
                        var td1 = tr.appendChild(document.createElement('td'));
                        var td2 = tr.appendChild(document.createElement('td'));
                        var td3 = tr.appendChild(document.createElement('td'));

                        td1.innerHTML = data.book.isbn;
                        td2.innerHTML = data.book.booktitle;
                        td3.innerHTML =
                            '<input type="button" name="up" value="Remove" class="btn btn-success">';
                        document.getElementById("tbl").appendChild(tr);
                        $('.bookid').val("");
                    }
                });
            }
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
    </script>
@endsection
@endsection
