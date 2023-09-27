@extends('layouts.app')
@section('content')
    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0 mt-4 mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-success">Book Management</li>
                <li class="breadcrumb-item text-success" aria-current="page">Lost/Damage Book</li>
            </ol>
        </nav>
    </div>

    <div class="container text-center">
        <div class="card mt-3 mb-4">
            <div class="card-body bg-success text-white">
                <h2> FINER INFORMATION</h2>
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
                    <input type="text" class="form-control mb-4" name="data" :value="old('data')"
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
                <h2>BORROWED BOOK</h2>
            </div>
        </div>


        <table class="table table-responsive table-bordered table-striped myTable mb5" id="tbl">
            <thead class="bg-success text-white">
                <tr>
                    <th>TRANSACTION</th>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>AUTHOR</th>
                    <th>DEPARTMENT</th>
                    <th>COPYRIGHT</th>
                    <th>ACCESSION NO</th>
                    <th>CALL NO</th>
                    <th>SUBJECT</th>
                    <th>BORROW DATE</th>
                    <th>DUE DATE</th>
                    <th>ACTION</th>
                    <th>OVERDUE</th>
                </tr>
            </thead>
            <tbody>
                @if (count($borrowbook) > 0)
                    @foreach ($borrowbook as $book)
                        <tr>
                            <td>{{ $book->transaction }}</td>
                            <td>{{ $book->book->id }}</td>
                            <td>{{ $book->book->title }}</td>
                            <td>{{ $book->book->author }}</td>
                            <td>{{ $book->book->department }}</td>
                            <td>{{ $book->book->copyright }}</td>
                            <td>{{ $book->book->accession }}</td>
                            <td>{{ $book->book->callnumber }}</td>
                            <td>{{ $book->book->subject }}</td>
                            <td class="col-2">{{ date('Y-m-d', strtotime($book->created_at)) }}</td>
                            <td class="col-2">{{ $book->duedate }}</td>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input getbook"
                                        id="checkbox-{{ $book->id }}" data-id="{{ $book->id }}">
                                    <label class="form-check-label" for="checkbox-{{ $book->id }}">MARK</label>
                                </div>
                            </td>
                            <td>{{ $book->penalty($book->duedate) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td id="messageRow" colspan="15">NO BORROWED BOOK</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <button type="button" class="btn btn-success  w-40 btn-lg returnbook mb-4 mt-4 " data-bs-toggle="modal"
            data-bs-target="#tablemodal" data-submit="{{ request()->input('data') }}" data-token="{{ csrf_token() }}"
            id="bor">Submit
            Return</button></a>
    </div>


    <div class="modal fade" id="tablemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">PRINT RETURN</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed id="table-frame" src="" frameborder="0" width="100%" height="100%">
                </div>
            </div>
        </div>
    </div>

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

                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle mb-2" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Type of Borrower
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" data-value="Employee">Employee</a></li>
                            <li><a class="dropdown-item" data-value="Student">Student</a></li>
                        </ul>
                        <input type="hidden" name="TypeUser" id="TypeUser" value="Employee"> <!-- Default value -->
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="name" placeholder="ENTER LAST NAME">
                        <button class="input-group-text bg-success text-white" id="searchBtn">SEARCH</button>
                    </div>

                    <!-- Table to display data -->
                    <table class="search-tbl table table-responsive table-bordered table-striped myTable mb5" id="tbl">
                        <!-- Table headers here -->
                        <thead class="bg-success text-white">
                            <th>ID</th>
                            <th>NAME</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@section('script')
    <script>
        const bookdata = [];

        $(".returnbook").on('click', function() {
            let token = $(this).data('token');
            let data = $(this).data('submit');
            if (bookdata.length == 0) {
                alert("Please ensure you have checked the text box before fining the book!");
            } else {
                $.post('/returndamage/book', {
                    'data': data,
                    'bookdata': bookdata,
                    '_token': token
                }, function(response) {
                    console.log(response);
                })
                const frame = $('#table-frame')
                const link = '/generate-tblreturndamage/' + JSON.stringify(bookdata) + '/' + data;
                frame.attr('src', link)
                bookdata.splice(0, bookdata.length);
                $('input:checked').parents("tr").remove();
                alert('successfully list as damage/lost');
                console.log(bookdata);
            }
        });


        $('.getbook').on('click', function() {
            var id = $(this).data('id');
            let check = $('#checkbox-' + id).is(':checked');
            if (check) {
                bookdata.push(id)
                console.log(bookdata);
            } else {
                let index = bookdata.indexOf(id);
                bookdata.splice(index, 1);
            }
        });


        $(document).ready(function() {
            $('#searchBtn').click(function() {
                var name = $('#name').val();
                var TypeUser = $('#TypeUser').val();

                $.ajax({
                    type: 'GET',
                    url: '/fetch-data',
                    data: {
                        name: name,
                        TypeUser: TypeUser
                    },
                    success: function(data) {
                        $('.search-tbl tbody').empty();
                        $.each(data, function(index, item) {
                            console.log(item);
                            var row = '<tr>' +
                                '<td>' + item.id + '</td>' +
                                '<td>' + item.first_name +" " +item.middle_name +" "+ item.last_name + '</td>' +
                                '<td>' +
                                '<button type="button" class="btn btn-outline-success btn-success bg-success active custom-button" data-transaction="' +
                                item.id + '">SELECT</button>' +
                                '</td>' +
                                '</tr>';
                            $('.search-tbl tbody').append(row);
                        });

                        $('.custom-button').on('click', function(event) {
                            event
                                .preventDefault();
                            var button = $(event.currentTarget);
                            var id = button.data('transaction');
                            var user = $('#TypeUser').val();
                            var redirectLink = $('#redirect-link');

                            $.get("/get-user/" + id + "/" + user, function(data,
                            status) {
                                window.location.href = '/fined?data=' +
                                    data;
                            });
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.dropdown-item').on('click', function() {
                var selectedValue = $(this).data('value');
                $('#dropdownMenuButton1').text(selectedValue);
                $('#TypeUser').val(selectedValue);
            });
        });

    </script>
@endsection
@endsection
