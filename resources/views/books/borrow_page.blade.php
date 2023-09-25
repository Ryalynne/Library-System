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
            <div class="form-group">
                <label for="data">ENTER ID:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="data" name="data" :value="old('data')"
                        data-borrower="{{ request()->input('data') }}" value="{{ request()->input('data') }}">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#search_user">SEARCH</button>
                    </div>
                </div>
            </div>
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
                            Search Books
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
                    {{-- EMPTY --}}
                @else
                    <td colspan="10">ENTER BORROWER ID FIRST</td>
                @endif
            </tbody>
        </table>

        <button type="button" class="btn btn-success  w-40 btn-lg borrowbook mb-4 mt-4 " data-bs-toggle="modal"
            data-bs-target="#tablemodal" data-submit="{{ request()->input('data') }}" data-token="{{ csrf_token() }}"
            id="bor">Submit
            Books</button></a>

    </div>

    {{-- --------------------------------------------------------------------------------------------------------------------------------------- --}}
    {{-- MODALS --}}


    {{-- SEARCH BORROWER --}}
    <div class="modal fade" id="search_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5  fw-bold">SEARCH PERSON</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="name" placeholder="NAME">
                        <button class="input-group-text bg-success text-white" id="searchBtn">SEARCH</button>
                    </div>

                    <!-- Table to display data -->
                    <table class="table table-responsive table-bordered table-striped myTable mb5" id="tbl">
                        <!-- Table headers here -->
                        <thead class="bg-success text-white">
                            <th>ID</th>
                            <th>FIRST NAME</th>
                            <th>MIDDLE NAME</th>
                            <th>LAST NAME</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- PRINT BORROWER --}}
    <div class="modal fade" id="tablemodal" onClick="self.location.reload();" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">PRINT BORROW</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed id="table-frame" src="" frameborder="0" width="100%" height="100%">
                </div>
            </div>
        </div>
    </div>


    {{-- SEARCH BAR --}}
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


        $(".borrowbook").on('click', function() {
            let borrower = $(this).data('submit');
            let token = $(this).data('token');
            const formData = new FormData();
            formData.append('user', borrower);
            formData.append('books', bookList);
            formData.append('_token', token);

            if (bookList.length == 0) {
                alert('You need to add a book to the table to borrow!');
            } else {
                $.post('/book/borrow', {
                    'user': borrower,
                    'books': bookList,
                    '_token': token
                }, function(response) {
                    console.log(response);
                })

                console.log(borrower + bookList);
                const frame = $('#table-frame')
                const link = '/generate-tblborrow/' + JSON.stringify(bookList) + '/' + borrower
                frame.attr('src', link)
                var table = document.getElementById("tbl");
                for (var i = table.rows.length - 1; i > 0; i--) {
                    table.deleteRow(i);
                }
                bookList.splice(0, bookList.length);
                accessionList.splice(0, accessionList.length);
                // location.reload();
                alert('successfully borrowed');
                //print borrow
            }
        });


        var _changeInterval;

        $(".bookid").on("keyup", function() {
            var id = $(this).val().trim().toLowerCase();
            var borrower = $(this).data('user');
            clearInterval(_changeInterval);
            _changeInterval = setInterval(function() {
                $.get("/bookstatus/" + id + '/' + borrower)
                    .done(function(data, response) {
                        if (data.status == "success") {
                            console.log('Book is available');

                            checkBookAvailability(id);
                        } else if (data.status == "error") {
                            console.log('Book is already borrowed');
                            alert("Book is already borrowed");
                            $('.bookid').val("");
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX request failed:", textStatus, errorThrown);
                    })
                    .always(function() {
                        $('.bookid').val("");
                    });
                clearInterval(_changeInterval);
            }, 900);
        });

        function checkBookAvailability(id) {
            $.get("/bookcopies/" + id, function(data) {
                try {
                    if (data.book.id == "") {
                        alert("The Book Does Not Exist");
                        $('.bookid').val("");
                    } else {
                        if (!bookList.includes(data.book.id)) {
                            accessionList.push(data.book.accession);
                            bookList.push(data.book.id);
                            var tr = $('<tr>');
                            tr.append($('<td>').text(data.book.id));
                            tr.append($('<td>').text(data.book.title));
                            tr.append($('<td>').text(data.book.author));
                            tr.append($('<td>').text(data.book.department));
                            tr.append($('<td>').text(data.book.copyright));
                            tr.append($('<td>').text(data.book.accession));
                            tr.append($('<td>').text(data.book.callnumber));
                            tr.append($('<td>').text(data.book.subject));
                            tr.append($('<td>').html(
                                '<button type="button" class="btn btn-outline-success btn-success bg-success active custom-button" data-id="' +
                                id + '" onclick="deleteRow(this, ' + id + ');">Remove</button>'));
                            $('#tbl').append(tr);
                            $('.bookid').val("");
                            console.log('Available Books: ' + bookList);
                            console.log('Accession List: ' + accessionList);
                        } else {
                            alert("The Book is Already in the list");
                            $('.bookid').val("");
                        }
                    }
                } catch (error) {
                    alert('Error, No Available Book' + ' ' + id);
                    $('.bookid').val("");
                }
            });
        }

        var $iddata = "";
        let $status = "";
        var studentid = "";

        $(".getdata").on('click', function() {
            var $row = $(this).closest(".trtr");
            $iddata = $row.find(".getidd").text().trim().toLowerCase();
            $acc = $row.find(".getacc").text().trim().toLowerCase();
            $status = $row.find(".getstatus").text();
            $.get("/book/" + $iddata, function(data, status) {
                if ($status.includes("onlend")) {
                    alert('The Book Already Borrowed');
                } else if (!accessionList.includes($acc)) {
                    // bookList.push($iddata)
                    accessionList.push(data.book.accession);
                    bookList.push($iddata);
                    console.log(bookList + accessionList);
                    var tr = document.createElement('tr');
                    var td1 = tr.appendChild(document.createElement(
                        'td'));
                    var td2 = tr.appendChild(document.createElement(
                        'td'));
                    var td3 = tr.appendChild(document.createElement(
                        'td'));
                    var td4 = tr.appendChild(document.createElement('td'));
                    var td5 = tr.appendChild(document.createElement('td'));
                    var td6 = tr.appendChild(document.createElement('td'));
                    var td7 = tr.appendChild(document.createElement('td'));
                    var td8 = tr.appendChild(document.createElement('td'));
                    var td9 = tr.appendChild(document.createElement('td'));
                    td1.innerHTML = $iddata;
                    td2.innerHTML = data.book.title;
                    td3.innerHTML = data.book.author;
                    td4.innerHTML = data.book.department;
                    td5.innerHTML = data.book.copyright;
                    td6.innerHTML = data.book.accession;
                    td7.innerHTML = data.book.callnumber;
                    td8.innerHTML = data.book.subject;
                    td9.innerHTML =
                        '<button type="button" class="btn btn-outline-success btn-success bg-success active custom-button" data-id="' +
                        $iddata + '" onclick="deleteRow(this, ' + $iddata +
                        ');">Remove</button>';
                    document.getElementById("tbl").appendChild(tr);
                    $('.bookid').val("");
                    alert('Added Successfully');
                    console.log($status)
                } else {
                    alert('The Book Already in the list');
                }
            });
        });


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


        $(document).ready(function() {
            $('#searchBtn').click(function() {
                var name = $('#name').val();
                $.ajax({
                    type: 'GET',
                    url: '/fetch-data',
                    data: {
                        name: name
                    },
                    success: function(data) {
                        $('#tbl tbody').empty();
                        $.each(data, function(index, item) {
                            $('#tbl tbody').append('<tr>' +
                                '<td>' + item.id + '</td>' +
                                '<td>' + item.first_name + '</td>' +
                                '<td>' + item.middle_name + '</td>' +
                                '<td>' + item.last_name + '</td>' +
                                '<td><a href="#">SELECT</a>' +
                                '</tr>');
                        });
                    }
                });
            });
        });

    </script>
@endsection
