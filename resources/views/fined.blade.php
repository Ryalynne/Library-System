@extends('layouts.app')

@section('content')
    <br>
    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-success">Book Management</li>
                <li class="breadcrumb-item text-success" aria-current="page">Damage - Lost Book</li>
            </ol>
        </nav>
    </div>
    <br>
    <div class="container text-center">
        <div class="row align-items-start ">
            <div class="col border-end">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2> BORROWER INFORMATION</h2>
                    </div>
                </div>
                <br>
                <div class="container text-start">
                    <center>
                        <div class="image-container">
                            @if (request()->input('student') || $student)
                                <img src="http://bma.edu.ph/img/student-picture/{{ $student ? $student->student_number : 'midshipman' }}.png"
                                    class="img-thumbnail img-fluid student-image" alt="No Image">
                            @else
                                <img src="https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png"
                                    class="img-thumbnail img-fluid student-image" alt="No Image">
                            @endif
                        </div>
                    </center>
                    <form action="">
                        @if (!$student && request()->input('student'))
                            <span class="badge bg-danger w-100">No Student Found.</span>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">ENTER ID:</label>
                            <input type="text" class="form-control "  name="student" :value="old('student')"
                                value="{{ request()->input('student') ? ($student ? $student->student_number : '') : '' }}">
                        </div>
                        <input type="hidden" id="student"
                            value="{{ $student && request()->input('student') ? $student->student_number : '' }}">
                    </form>
                    <div class="mb-3">
                        <label for="booktitle" class="form-label">FULL NAME: </label>
                        <input style="text-transform:uppercase" type="text" class="form-control full-name" disabled
                        value="{{ request()->input('student') ? ($student ? ($student->student->enrollment_assessment ? $student->student->enrollment_assessment->year_level() : 'NOT ENROLLED') : '') : '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="booktitle" class="form-label">DESIGNATED: </label>
                        <input style="text-transform:uppercase" type="text" class="form-control class"
                            value="{{ request()->input('student') ? ($student ? ($student->student->enrollment_assessment ? $student->student->enrollment_assessment->year_level() : 'NOT ENROLLED') : '') : '' }}"
                            disabled>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2>DAMAGE / LOST BOOK</h2>
                    </div>
                </div>
                <br>
                <table class="table table-bordered table-striped" id="tbl">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>TRANSACTION</th>
                            <th>ID</th>
                            <th>TITLE</th>
                            <th>COPYRIGHT</th>
                            <th>ACCESSION NO</th>
                            <th>BORROW DATE</th>
                            <th>DUE DATE</th>
                            <th>ACTION</th>
                            <th>PENALTY</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($borrowbook) > 0)
                            @foreach ($borrowbook as $book)
                                <td> {{ $book->transaction }}</td>
                                <td> {{ $book->book->id }}</td>
                                <td>
                                    {{ $book->book->title }}
                                </td>
                                <td> {{ $book->book->copyright }}</td>
                                <td> {{ $book->book->accession }}</td>
                                <td>
                                    {{ date('Y-m-d', strtotime($book->created_at)) }}
                                </td>
                                <td>
                                    {{ $book->duedate }}
                                </td>

                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input getbook"
                                            id="checkbox-{{ $book->id }}" data-id="{{ $book->id }}">
                                        <label for="flexCheckDefault" class="form-check-label">Fine</label>
                                    </div>
                                </td>
                                <td>
                                    {{ $book->penalty($book->duedate) }}
                                </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td id="messageRow" colspan="10">NO BORROWED BOOK</td>
                            </tr>
                        @endif

                    </tbody>

                </table>
                <br>
                <div class="text-end">
                    <button type="button" class="btn btn-success  w-50 btn-lg returnbook" data-bs-toggle="modal"
                        data-bs-target="#tablemodal" data-student="{{ $student ? $student->student_number : '' }}"
                        data-token="{{ csrf_token() }}" id="myBtn">Fine
                        Book</button></a>
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
                    <h1 class="modal-title fs-5">PRINT FINES</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed id="table-frame" src="" frameborder="0" width="100%" height="100%">
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-button {
            background-color: green;
        }

        .image-container {
            width: 200px;
            /* Adjust the width as needed */
            height: 200px;
            /* Adjust the height as needed */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .student-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
    </style>
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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
                alert("Please ensure you have checked the text box before fining the book!");
            } else {
                $.post('/returndamage/book',{
                    'studentId': studentId,
                    'bookdata': bookdata,
                    '_token': token
                }, function(response) {
                    console.log(response);
                })
                const frame = $('#table-frame')
                const link = '/generate-tblreturndamage/' + JSON.stringify(bookdata) + '/' + studentId;
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

        var stud = document.getElementById("student").value;

        if (stud.trim().length > 1 && stud.trim().toUpperCase() !== "NOT ENROLLED"){
            document.getElementById("myBtn").disabled = false;
        } else {
            document.getElementById("myBtn").disabled = true;
            var tableRow = document.getElementById('messageRow');
            tableRow.innerHTML = '<td colspan="6">ENTER BORROWER ID FIRST</td>';
        }
    </script>
@endsection
@endsection
