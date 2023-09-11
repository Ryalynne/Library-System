@extends('layouts.app')
@section('content')
    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0 mt-4 mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-success">Book Management</li>
                <li class="breadcrumb-item text-success" aria-current="page">Borrow Book</li>
            </ol>
        </nav>

    </div>
    <div class="container text-center">
        <div class="card mt-3 mb-4">
            <div class="card-body bg-success text-white">
                <h2> BORROWER INFORMATION</h2>
            </div>
        </div>

        <center>
            <div class="image-container">
                @if (request()->input('data'))
                    <img src="{{ $value->profile_picture() }}" class="img-thumbnail img-fluid student-image w-25"
                        alt="No Image">
                @else
                    <img src="http://bma.edu.ph/img/student-picture/midship-man.jpg"
                        class="img-thumbnail img-fluid student-image w-25" alt="No Image">
                @endif
            </div>
        </center>

        @if (!$value && request()->input('data'))
            <span class="badge bg-danger w-100">No User Found.</span>
        @endif

        <form action="">
            <label class="form-label">ENTER ID: </label>
            <input type="text" class="form-control mb-4" name="data" :value="old('data')"
                value="{{ request()->input('data') }}">
        </form>

        <label class="form-label">FULL NAME: </label>
        <input type="text" class="form-control mb-4" :value="old('data')"
            value="{{ request()->input('data') ? ($value ? $value->last_name . ', ' . $value->first_name . ', ' . $value->middle_name : '') : '' }}"
            disabled>

        <label class="form-label">DESIGNATED: </label>
        <input type="text" class="form-control mb-4" :value="old('data')"
            value="{{ request()->input('data') ? ($value ? $designated : '') : '' }}" disabled>



        <div class="card mb-5">
            <div class="card-body bg-success text-white">
                <h2>BORROWING BOOK</h2>
            </div>
        </div>

        <div class="container text-center mb-5">
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
                            <input type="text" class="form-control bookid myInput" id="exampleInputEmail1"
                                data-user="{{ request()->input('data') }}">
                            <div class="form-text ">Scan QR Here...</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <table class="table table-responsive table-bordered table-striped myTable mb5" id="tbl">
            <thead class="bg-success text-white">
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>AUTHOR/S</th>
                    <th>DEPARTMENT</th>
                    <th>COPYRIGHT</th>
                    <th>ACCESSION NO</th>
                    <th>CALL NO</th>
                    <th>SUBJECT</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @if (request()->input('data'))
                @else
                    <td colspan="10">ENTER BORROWER ID FIRST</td>
                @endif
            </tbody>
        </table>

        {{-- <div class="text-end mb-5">
            <button type="button" class="btn btn-success  w-50 btn-lg borrowbtn"
                data-user="{{ $value ? $value->value : '' }}" data-token="{{ csrf_token() }}" data-bs-toggle="modal"
                data-bs-target="#tablemodal" id="bor">Borrow Books</button></a>
        </div> --}}

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
                        <div class="d-flex mb-1">
                            <div class="me-auto p-2">
                            </div>
                            <div class="p-2">
                                <div class="input-group">
                                    <input type="search" class="form-control rounded myInput" placeholder="Search"
                                        aria-label="Search" aria-describedby="search-addon" />
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered myTable" id="data">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">TITLE</th>
                                    <th class="text-center">AUTHOR/S</th>
                                    <th class="text-center">DEPARTMENT</th>
                                    <th class="text-center">COPYRIGHT</th>
                                    <th class="text-center">ACCCESSION NO</th>
                                    <th class="text-center">CALL NO</th>
                                    <th class="text-center">SUBJECT</th>
                                    <th class="text-center">STATUS</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    @if ($book->numberofcopies() > 0)
                                        <tr class="trtr">
                                            <td scope="row" class="getidd">
                                                {{ $book->id }}
                                            </td>
                                            <td class="getisbn">
                                                {{ $book->title }}
                                            </td>
                                            <td>
                                                {{ $book->author }}
                                            </td>
                                            <td>
                                                {{ $book->department }}
                                            </td>
                                            <td>
                                                {{ $book->copyright }}
                                            </td>
                                            <td class="getacc">
                                                {{ $book->accession }}
                                            </td>
                                            <td>
                                                {{ $book->callnumber }}
                                            </td>
                                            <td>
                                                {{ $book->subject }}
                                            </td>
                                            <td class="getstatus">
                                                @if (request()->input('data'))
                                                    {{ $book->getstatus(request()->input('data')) }}
                                                    @if (empty($book->getstatus(request()->input('data'))))
                                                        Available
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm btn-circle getdata">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-plus-circle"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                        <path
                                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                            </tbody>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        const bookList = [];
        const accessionList = [];
        var _changeInterval = null;

        $(".bookid").on("keyup", function() {

            var id = $(this).val().trim().toLowerCase();
            let studentId = $(this).data('user');

            console.log('keyup ' + studentId);

            clearInterval(_changeInterval);
            _changeInterval = setInterval(function() {
                $.get("/bookstatus/" + id + "/" + studentId, function(data, status) {
                    try {
                        if (data.bookstatus == "onlend") {
                            console.log('onlend');
                            alert('The Book is Already Borrowed');
                            $('.bookid').val("");
                        } else {
                            checkBookAvailability(id);
                        }
                    } catch (err) {
                        checkBookAvailability(id);
                    }
                    $('.bookid').val("");
                });
                clearInterval(_changeInterval);
            }, 900);

        });

        function checkBookAvailability(id) {
            $.get("/bookcopies/" + id, function(data, status) {
                try {
                    if (data.book.accession == "") {
                        alert("The Book Does Not Exist");
                        $('.bookid').val("");
                    } else {
                        if (!accessionList.includes(data.book.accession)) {
                            accessionList.push(data.book.accession);
                            bookList.push(data.book.id);
                            var tr = document.createElement('tr');
                            var td1 = tr.appendChild(document.createElement('td'));
                            var td2 = tr.appendChild(document.createElement('td'));
                            var td3 = tr.appendChild(document.createElement('td'));
                            var td4 = tr.appendChild(document.createElement('td'));
                            var td5 = tr.appendChild(document.createElement('td'));
                            var td6 = tr.appendChild(document.createElement('td'));
                            var td7 = tr.appendChild(document.createElement('td'));
                            var td8 = tr.appendChild(document.createElement('td'));
                            var td9 = tr.appendChild(document.createElement('td'));
                            td1.innerHTML = data.book.id;
                            td2.innerHTML = data.book.title;
                            td3.innerHTML = data.book.author;
                            td4.innerHTML = data.book.department;
                            td5.innerHTML = data.book.copyright;
                            td6.innerHTML = data.book.accession;
                            td7.innerHTML = data.book.callnumber;
                            td8.innerHTML = data.book.subject;
                            td9.innerHTML =
                                '<button type="button" class="btn btn-outline-success btn-success bg-success active custom-button" data-id="' +
                                id + '" onclick="deleteRow(this, ' + id + ');">Remove</button>';
                            document.getElementById("tbl").appendChild(tr);
                            $('.bookid').val("");
                            console.log('Available' + bookList);
                        } else {
                            alert("The Book Already in the list");
                            $('.bookid').val("");
                        }
                    }
                } catch (error) {

                    alert('No Available Book' + id);
                    $('.bookid').val("");
                }
            });
        }

        function deleteRow(el, id) {
            if (!confirm("Are you sure you want to remove this?")) return;
            var bookID = $(el).data('id')
            var row = el.parentNode.parentNode.rowIndex;
            var tbl = el.parentNode.parentNode.parentNode;
            let index = bookList.indexOf(bookID);
            bookList.splice(index, 1);
            accessionList.splice(index, 1);
            tbl.deleteRow(row);

        }

        var stud = document.getElementById("student").value;

        if (stud.trim().length > 1 && stud.trim().toUpperCase() !== "NOT ENROLLED") {
            document.getElementById("myBtn").disabled = false;
            document.getElementById("bor").disabled = false;
            var table = document.getElementById("tbl");
            var tbody = table.getElementsByTagName("tbody")[0];
            tbody.innerHTML = ""; // Remove all content from the tbody
        } else {
            document.getElementById("myBtn").disabled = true;
            document.getElementById("bor").disabled = true;
        }


        // console.log(stud);
    </script>
@endsection
