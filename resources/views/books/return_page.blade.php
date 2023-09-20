@extends('layouts.app')
@section('content')
    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0 mt-4 mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-success">Book Management</li>
                <li class="breadcrumb-item text-success" aria-current="page">Return Book</li>
            </ol>
        </nav>
    </div>

    <div class="container text-center">
        <div class="card mt-3 mb-4">
            <div class="card-body bg-success text-white">
                <h2> RETURNER INFORMATION</h2>
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
                data-borrower="{{ request()->input('data') }}" value="{{ request()->input('data') }}">
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
                                    <label class="form-check-label" for="checkbox-{{ $book->id }}">Return</label>
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


@endsection

@section('script')
    <script>
        const bookdata = [];

        $(".returnbook").on('click', function() {
            let token = $(this).data('token');
            let data = $(this).data('submit');
            if (bookdata.length == 0) {
                alert('Please check the text box before returning the book!');
            } else {
                $.post('/return/book', {
                    'data': data,
                    'bookdata': bookdata,
                    '_token': token
                }, function(response) {
                    console.log(response);
                })
                const frame = $('#table-frame')
                const link = '/generate-tblreturn/' + JSON.stringify(bookdata) + '/' + data;
                frame.attr('src', link)
                bookdata.splice(0, bookdata.length);
                $('input:checked').parents("tr").remove();
                alert('successfully Returned');
                console.log(bookdata);
            }
        });


        $('.getbook').on('click', function() {
            var id = $(this).data('id');
            let check = $('#checkbox-' + id).is(':checked');
            if (check) {
                bookdata.push(id)
            } else {
                let index = bookdata.indexOf(id);
                bookdata.splice(index, 1);
            }
        });


        // var stud = document.getElementById("student").value;

        // if (stud.trim().length > 1 && stud.trim().toUpperCase() !== "NOT ENROLLED") {
        //     document.getElementById("myBtn").disabled = false;
        // } else {
        //     document.getElementById("myBtn").disabled = true;
        //     var tableRow = document.getElementById('messageRow');
        //     tableRow.innerHTML = '<td colspan="6">ENTER BORROWER ID FIRST</td>';
        // }
    </script>
@endsection