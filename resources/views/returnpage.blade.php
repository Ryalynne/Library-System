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
                        <h2>RETURN BOOK</h2>
                    </div>
                </div>
                <br>
                <table class="table table-bordered" id="tbl">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>ISBN</th>
                            <th>BOOK TITLE</th>
                            <th>BORROW DATE</th>
                            <th>DUE DATE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-select">
                            @foreach ($borrowbook as $book)
                                <td> {{ $book->book->isbn }}</td>
                                <td>
                                    {{ $book->book->booktitle }}
                                </td>
                                <td>
                                    {{ date('Y-m-d', strtotime($book->created_at)) }}
                                </td>
                                <td>
                                    {{ $book->duedate }}
                                </td>

                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input getbook"
                                            id="checkbox-{{ $book->bookid }}" data-id="{{ $book->bookid }}">
                                        <label for="flexCheckDefault" class="form-check-label">Return</label>
                                    </div>
                                </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <br>
                <div class="text-end">
                    <button type="button" class="btn btn-success  w-50 btn-lg returnbook" data-bs-toggle="modal"
                        data-bs-target="#tablemodal" data-student="{{ $student ? $student->id : '' }}"
                        data-token="{{ csrf_token() }}">Return
                        Books</button></a>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>
    <br><br>

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

@section('script')
    <script>
        const bookdata = [];

        $(".returnbook").on('click', function() {
            let token = $(this).data('token');
            let studentId = $(this).data('student');
            const formData = new FormData();
            formData.append('bookdata', bookdata);
            formData.append('_token', token);
            formData.append('studentId', studentId);
            if (bookdata.length == 0) {
                alert('You need to add a book to the table to borrow!');
            } else {
                 $.post('/return/book', {
                     'studentId': studentId,
                     'bookdata': bookdata,
                     '_token': token
                 }, function(response) {
                     console.log(response);            
                 })
                const frame = $('#table-frame')
                const link = '/generate-tblreturn/' + JSON.stringify(bookdata)
                frame.attr('src', link)
                bookdata.splice(0, bookdata.length);

                $('input:checked').parents("tr").remove();
                alert('successfully borrowed');
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
            console.log(bookdata);

        });


        $('.studid').on('keyup', function() {
            var id = $(this).val().toLowerCase();
            if (id == "") {
                $('.full-name').val("")
                $('.class').val("")
                document.location.href = "returnpage";
                document.getElementById('myBtn').disabled = true;
            } else {
                $.get("/student/" + id, function(data, status) {

                    try {
                        if (id == data.student.id) {
                            document.location.href = "returnpage" + '?student=' + data.student.id;
                            console.log('true');
                        }
                    } catch (err_value) {
                        alert('No Student that have ' + id);
                        document.location.href = "returnpage";
                        console.log('false');
                    }

                });
            }
        });
    </script>
@endsection
@endsection
