@extends('layouts.app')

@section('content')

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb ">
                <li class="breadcrumb-item text-success  mt-3">Book Management</li>
                <li class="breadcrumb-item active text-success  mt-3" aria-current="page">Book Entry</li>
            </ol>
        </nav>
    </div>

    <div class="table-responsive-lg">
        <div class="container">
            <br>
            <div id="success_message"></div>
            <div class="d-flex mb-1">
                <div class="d-flex mb-1">
                    <div class="me-auto p-2 btn-group">

                        <button type="button" class="btn btn-success bg-success border-success mx-2 rounded"
                            data-bs-toggle="modal" data-bs-target="#modal_addbook">
                            Register Books
                            <!-- Your SVG icon code -->
                        </button>

                        {{-- PRINT TABLE --}}
                        {{-- <form action="/generate-table" method="GET">
                            <button type="submit" class="btn btn-success bg-success border-success mx-2 rounded">
                                Print Book List
                                <!-- Your SVG icon code -->
                            </button>
                        </form> --}}

                        {{-- IMPORT --}}
                        <button type="button" class="btn btn-success bg-success border-success mx-2 rounded"
                            data-bs-toggle="modal" data-bs-target="#modal_import">
                            Import
                            <!-- Your SVG icon code -->
                        </button>
                        <a class="btn btn-success float-end rounded" href="{{ route('users.export') }}">Export Booklist</a>
                        {{-- QRLIST --}}
                        <form action="/Print_QRList/" method="GET">
                            <button type="submit" class="btn btn-success bg-success border-success mx-2 rounded">
                                Bulk QR Print
                                <!-- Your SVG icon code -->
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-2">
                    <div class="input-group">
                        <form method="GET" action="/booklist">
                            @csrf
                            <input class="myInput form-control " placeholder="Search here" name="search" />
                        </form>
                    </div>
                </div>
            </div>
            <form>
                @csrf
                <div class="modal fade AddStudentModal" id="modal_addbook" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Register Book</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">


                                <div class="mb-3">
                                    <label for="title" class="form-label">TITLE</label>
                                    <input style="text-transform:uppercase" type="text" class="form-control t-title"
                                        id="title" name="title" :value="old('title')"
                                        placeholder="ex.IAMSAR Manual Vol.1 Organization and Management">
                                </div>
                                <p id="msgtitle" class="text-danger"> </p>

                                <!-- {{-- textfield --}} -->
                                <div class="mb-3">
                                    <label for="author" class="form-label">AUTHOR/S</label>
                                    <input style="text-transform:uppercase" type="text" class="form-control t-author"
                                        id="author" name="author" :value="old('author')" placeholder="ex.IMO">
                                </div>
                                <p id="msgauthor" class="text-danger"> </p>

                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="department">DEPARTMENT</label>
                                        <select name="department" id="department" class="form-control t-department">
                                            @foreach (\App\Models\departmentList::all() as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ request('department') == $department->id ? 'selected' : '' }}>
                                                    {{ strtoupper($department->departmentName) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- department -->

                                <div class="mb-3">
                                    <label for="copyright" class="form-label">COPYRIGHT</label>
                                    <input type="text" class="form-control t-copyright" id="copyright" name="copyright"
                                        :value="old('copyright')" placeholder="ex.2023">
                                </div>
                                <p id="msgcopyright" class="text-danger"> </p>

                                <div class="mb-3">
                                    <label for="accession" class="form-label">ACCESSION NO.</label>
                                    <input type="text" class="form-control t-accession" id="accession" name="accession"
                                        :value="old('accession')" placeholder="ex.04313">
                                </div>
                                <p id="msgaccession" class="text-danger"> </p>

                                <div class="mb-3">
                                    <label for="callnumber" class="form-label">CALL NO.</label>
                                    <input type="text" class="form-control t-callnumber" id="callnumber"
                                        name="callnumber" :value="old('callnumber')" placeholder="ex.04313">
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="subject">SUBJECT</label>
                                        <select name="subject" id="subject" class="form-control t-subject">
                                            @foreach (\App\Models\subjectList::all() as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ request('subject') == $subject->id ? 'selected' : '' }}>
                                                    {{ strtoupper($subject->subjectName) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- subject --}}
                                <div class="mb-3">
                                    <label for="copies" class="form-label">COPIES</label>
                                    <input type="text" class="form-control t-copies" id="copies" name="copies"
                                        :value="old('copies')" placeholder="ex.20">
                                </div>
                                <p id="msgcopies" class="text-danger"> </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success btn-tr-submit">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered border-dark myTable">
                            <thead>
                                <tr class="bg-success text-white">
                                    <th class="text-center">TITLE</th>
                                    <th class="text-center">AUTHOR</th>
                                    <th class="text-center">DEPARTMENT</th>
                                    <th class="text-center">COPYRIGHT</th>
                                    <th class="text-center">ACCESSION NO.</th>
                                    <th class="text-center">CALL NO.</th>
                                    <th class="text-center">SUBJECT</th>
                                    <th class="text-center">ADDED AT</th>
                                    <th class="text-center">ACTIONS PERFORM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                                        <td>
                                            {{ $book->title }}
                                        </td>
                                        <td>
                                            {{ $book->author }}
                                        </td>
                                        <td>
                                            @if ($book->department == null)
                                                no department
                                            @else
                                                {{ $book->departments->departmentName }}
                                            @endif
                                        </td>
                                        <td>{{ $book->copyright }}</td>
                                        <td>
                                            {{ $book->accession }}
                                        </td>
                                        <td>
                                            {{ $book->callnumber }}
                                        </td>
                                        <td>
                                            @if ($book->subject == null)
                                                no subject
                                            @else
                                                {{ $book->subjects->subjectName }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ date('F j, Y', strtotime($book->created_at)) }}
                                        </td>
                                        <td class="text-center col-2">
                                            <button type="button" class="btn btn-success edit-button btn-sm"
                                                data-id={{ $book->id }} data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" viewBox="0 0 16 16">
                                                    <path
                                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                </svg>
                                            </button>


                                            <button type="button" class="btn btn-danger btn-sm remove-book"
                                                data-bs-toggle="modal" data-bs-target="#backdrop"
                                                data-id={{ $book->id }}><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20" fill="currentColor"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                </svg></button>

                                            <button type="button" class="btn btn-sm btn-primary btn-qr getbookid"
                                                data-bs-toggle="modal" data-id={{ $book->id }}
                                                data-bs-target="#qrcodemodal"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20" fill="currentColor"
                                                    class="bi bi-qr-code" viewBox="0 0 16 16">
                                                    <path d="M2 2h2v2H2V2Z" />
                                                    <path d="M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z" />
                                                    <path d="M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z" />
                                                    <path
                                                        d="M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z" />
                                                    <path d="M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z" />
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                </svg></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="15" class="text-center text-size-15px"><b>NO BOOK FOUND</b></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination justify-content-center">
            {{ $books->links() }}
        </div>


        <div class="modal fade AddUpdate" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">UPDATE BOOK</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">

                        <div class="mb-3" hidden>
                            <label for="bookid" class="form-label">BOOK ID</label>
                            <input type="text" class="form-control modal-book-id" id="bookid" name="bookid"
                                :value="old('bookid')" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="updatetitle" class="form-label">TITLE</label>
                            <input style="text-transform:uppercase" type="text" class="form-control modal-book-title"
                                id="updatetitle" name="updatetitle" :value="old('updatetitle')">
                        </div>
                        <p id="msg1title" class="text-danger"> </p>

                        <div class="mb-3">
                            <label for="updateauthor" class="form-label">AUTHOR/S</label>
                            <input style="text-transform:uppercase" type="text" class="form-control modal-book-author"
                                id="updateauthor" name="updateauthor" :value="old('updateauthor')">
                        </div>
                        <p id="msg1author" class="text-danger"> </p>

                        {{-- <div class="mb-3">
                            <div class="form-group">
                                <label for="department">DEPARTMENT</label>
                                <select name="updatedepartment" id="updatedepartment"
                                    class="form-control t-department modal-book-department">
                                    <option value="{{ $department->departmentName }}">Select Department</option>
                                    @foreach (\App\Models\DepartmentList::select('departmentName')->distinct()->get() as $department)
                                        <option value="{{ $department->departmentName }}"
                                            {{ request('updatedepartment') == $department->departmentName ? 'selected' : '' }}>
                                            {{ strtoupper($department->departmentName) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="updatedepartment">DEPARTMENT</label>
                                <select name="updatedepartment" id="updatedepartment"
                                    class="form-control t-department modal-book-department">
                                    @foreach (\App\Models\departmentList::all() as $department)
                                        <option value="{{ $department->id }}"
                                            {{ request('department') == $department->id ? 'selected' : '' }}>
                                            {{ strtoupper($department->departmentName) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="updatecopyright" class="form-label">COPYRIGHT</label>
                            <input style="text-transform:uppercase" type="text"
                                class="form-control modal-book-copyright" id="updatecopyright" name="updatecopyright"
                                :value="old('updatecopyright')">
                        </div>
                        <p id="msg1copyright" class="text-danger"> </p>

                        <div class="mb-3">
                            <label for="updateaccession" class="form-label">ACCESSION NO.</label>
                            <input style="text-transform:uppercase" type="text"
                                class="form-control modal-book-accession" id="updateaccession" name="updateaccession"
                                :value="old('updateaccession')">
                        </div>
                        <p id="msg1accession" class="text-danger"> </p>

                        <div class="mb-3">
                            <label for="updatecallnumber" class="form-label">CALL NO.</label>
                            <input style="text-transform:uppercase" type="text"
                                class="form-control modal-book-callnumber" id="updatecallnumber" name="updatecallnumber"
                                :value="old('updatecallnumber')">
                        </div>
                        <p id="msg1callnumber" class="text-danger"> </p>
                        {{-- <div class="mb-3">
                            <div class="form-group">
                                <label for="updatesubject">SUBJECT</label>
                                <select name="updatesubject" id="updatesubject"
                                    class="form-control t-subject modal-book-subject">
                                    @foreach (\App\Models\subjectList::select('subjectName')->distinct()->get() as $subject)
                                        <option value="{{ $subject->subjectName }}"
                                            {{ request('updatesubject') == $subject->subjectName ? 'selected' : '' }}>
                                            {{ strtoupper($subject->subjectName) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="updatesubject">SUBJECT</label>
                                <select name="updatesubject" id="updatesubject"
                                    class="form-control t-subject modal-book-subject">
                                    @foreach (\App\Models\subjectList::all() as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{ request('subject') == $subject->id ? 'selected' : '' }}>
                                            {{ strtoupper($subject->subjectName) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-tr-update">Update</button>
                    </div>

                </div>
            </div>
        </div>


        <div class="modal fade" id="backdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="titleofbook"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        After removing this book, it will automatically go to archived.
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success removenow" id="remove">Are you sure you want
                            to remove this?</button>
                        <p id="myParagraph" class="text-danger"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="qrcodemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="p1"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <embed id="qrcode-frame" src="" frameborder="0" width="100%" height="100%">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_import" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">IMPORT EXCEL FILE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-file">
                            <form action="/import" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                <button type="submit">Import</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_bulk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">QR CODE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <embed id="bulk-frame" src="" frameborder="0" width="100%" height="100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script>
            var removeid = "";

            $('.remove-book').on('click', function() {
                var id = $(this).data('id');
                $.get("/book/" + id, function(data, status) {
                    if (data.book && data.book.id == id) {
                        $.get("/getcopy/" + id, function(copyData, copyStatus) {
                            console.log(copyData);
                            if (copyData == 0) {
                                document.getElementById("titleofbook").innerHTML = data.book.title;
                                document.getElementById("myParagraph").innerHTML = "";
                                document.getElementById("remove").disabled = false;
                                removeid = id;
                            } else if (copyData > 0) {
                                document.getElementById("titleofbook").innerHTML = data.book.title;
                                document.getElementById("myParagraph").innerHTML =
                                    "Cannot be removed due to existing copies.";
                                document.getElementById("remove").disabled = true;
                            }
                        });
                    } else {
                        document.getElementById("myParagraph").innerHTML = data.book.title;
                        "Cannot be removed due to existing copies.";
                        document.getElementById("remove").disabled = true;
                        console.log('error');
                    }
                });
            });

            $('.removenow').on('click', function() {
                var id = removeid;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/removebook/" + id,
                    data: {
                        _method: "POST"
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.btn-qr').on('click', function() {
                var id = $(this).data('id');

                $.get("/book/" + id, function(data, status) {
                    $('#p1').text(data.book.title)
                });
                const frame = $('#qrcode-frame')
                const link = '/generate-pdf/' + id
                frame.attr('src', link)

            });

            $(document).on('click', '.btn-tr-update', function(e) {
                e.preventDefault();
                $(this).text('Checking');
                var data = {
                    'id': $('.modal-book-id').val(),
                    'title': $('.modal-book-title').val(),
                    'author': $('.modal-book-author').val(),
                    'department': $('.modal-book-department').val(),
                    'copyright': $('.modal-book-copyright').val(),
                    'accession': $('.modal-book-accession').val(),
                    'callnumber': $('.modal-book-callnumber').val(),
                    'subject': $('.modal-book-subject').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('books.update-book') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $('#msg1title').html("");
                            $('#msg1author').html("");
                            $('#msg1department').html("");
                            $('#msg1copyright').html("");
                            $('#msg1accession').html("");
                            $('#msg1callnumber').html("");
                            $('#msg1subject').html("");
                            switch (true) {
                                case (response.errors.title !== undefined):
                                    $('#msg1title').append(response.errors.title);
                                    $('#msg1title').addClass('alert alert-danger');
                                    break;
                                default:
                                    $('#msg1title').removeClass('alert alert-danger');
                                    break;
                            }

                            switch (true) {
                                case (response.errors.author !== undefined):
                                    $('#msg1author').append(response.errors.author);
                                    $('#msg1author').addClass('alert alert-danger');
                                    break;
                                default:
                                    $('#msg1author').removeClass('alert alert-danger');
                                    break;
                            }

                            switch (true) {
                                case (response.errors.department !== undefined):
                                    $('#msg1department').append(response.errors.department);
                                    $('#msg1department').addClass('alert alert-danger');
                                    break;
                                default:
                                    $('#msg1department').removeClass('alert alert-danger');
                                    break;
                            }

                            switch (true) {
                                case (response.errors.copyright !== undefined):
                                    $('#msg1copyright').append(response.errors.copyright);
                                    $('#msg1copyright').addClass('alert alert-danger');
                                    break;
                                default:
                                    $('#msg1copyright').removeClass('alert alert-danger');
                                    break;
                            }

                            switch (true) {
                                case (response.errors.accession !== undefined):
                                    $('#msg1accession').append(response.errors.accession);
                                    $('#msg1accession').addClass('alert alert-danger');
                                    break;
                                default:
                                    $('#msg1accession').removeClass('alert alert-danger');
                                    break;
                            }
                            $('.btn-tr-update').text('Update');
                        } else {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.AddUpdate').find('input').val('');
                            $('.btn-tr-update').text('Update');
                            $('.AddUpdate').modal('hide');
                            location.reload();
                        }
                    }
                });
            })


            $(document).on('click', '.btn-tr-submit', function(e) {
                e.preventDefault();
                $(this).text('Checking');
                var data = {
                    'title': $('.t-title').val(),
                    'author': $('.t-author').val(),
                    'department': $('.t-department').val(),
                    'copyright': $('.t-copyright').val(),
                    'accession': $('.t-accession').val(),
                    'copies': $('.t-copies').val(),
                    'callnumber': $('.t-callnumber').val(),
                    'subject': $('.t-subject').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('books.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $('#msgtitle').html("");
                            $('#msgcopies').html("");
                            switch (true) {
                                case !!response.errors.title:
                                    $('#msgtitle').append(response.errors.title);
                                    $('#msgtitle').addClass('alert alert-danger');
                                    break;
                                default:
                                    $('#msgtitle').removeClass('alert alert-danger');
                            }
                            switch (true) {
                                case !!response.errors.copies:
                                    $('#msgcopies').append(response.errors.copies);
                                    $('#msgcopies').addClass('alert alert-danger');
                                    break;
                                default:
                                    $('#msgcopies').removeClass('alert alert-danger');
                            }
                            $('.btn-tr-submit').text('Register');
                        } else {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.AddStudentModal').find('input').val('');
                            $('.btn-tr-submit').text('Register');
                            $('.AddStudentModal').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }
                    }
                });
            })
        </script>
    @endsection
@endsection
