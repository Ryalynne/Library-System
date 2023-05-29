@extends('layouts.app')

@section('content')

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- other meta tags and CSS links -->
    </head>

    <br>
    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-success">Book Management</li>
                <li class="breadcrumb-item active text-success" aria-current="page">Book Entry</li>
            </ol>
        </nav>
    </div>
    <div class="table-responsive-lg">
        <div class="container">
            <br>
            <div id="success_message"></div>
            <!-- Button trigger modal -->

            <div class="d-flex mb-1">
                <div class="me-auto p-2 btn-group">
                    <button type="button" class="btn btn-success bg-success border-success" data-bs-toggle="modal"
                        data-bs-target="#modal_addbook">
                        Register Books
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                            <path
                                d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z" />
                            <path
                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0Z" />
                        </svg>
                    </button>
                    <button type="button" class="btn btn-success bg-success border-success print-tbl "
                        data-bs-toggle="modal" data-bs-target="#tablemodal">
                        Print Book List
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path
                                d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                            <path
                                d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                        </svg>
                    </button>
                    <button type="button" class="btn btn-success bg-success border-success" data-bs-toggle="modal"
                        data-bs-target="#modal_import">
                        IMPORT
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2H6z" />
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3V9z" />
                        </svg>
                    </button>
                </div>
                <div class="p-2">
                    <div class="input-group">
                        <input type="search" class="form-control rounded myInput" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" />
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

                                {{-- textfield --}}
                                <div class="mb-3">
                                    <label for="author" class="form-label">AUTHOR/S</label>
                                    <input style="text-transform:uppercase" type="text" class="form-control t-author"
                                        id="author" name="author" :value="old('author')" placeholder="ex.IMO">

                                </div>
                                <p id="msgauthor" class="text-danger"> </p>

                                <div class="mb-3">
                                    <label for="copyright" class="form-label">COPYRIGHT</label>
                                    <input type="text" class="form-control t-copyright" id="copyright" name="copyright"
                                        :value="old('copyright')" placeholder="ex.2023">
                                </div>
                                <p id="msgcopyright" class="text-danger"> </p>

                                <div class="mb-3">
                                    <label for="accession" class="form-label">ACCESSION NO.</label>
                                    <input type="number" class="form-control t-accession" id="accession"
                                        name="accession" :value="old('accession')" placeholder="ex.04313">
                                </div>


                                <p id="msgaccession" class="text-danger"> </p>
                                {{-- textfield --}}
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
                        <table class="table table-bordered myTable">
                            <thead>
                                <tr class="bg-success text-white">
                                    <th class="text-center">ID</th>
                                    <th class="text-center">QR CODE</th>
                                    <th class="text-center">TITLE</th>
                                    <th class="text-center">AUTHOR</th>
                                    <th class="text-center">COPYRIGHT</th>
                                    <th class="text-center">ACCESSION NO</th>
                                    <th class="text-center">ADDED AT</th>
                                    <th class="text-center ">ACTIONS PERFORM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                                        <th class="text-center">
                                            {{ $book->id }}
                                        </th>
                                        <td class="text-center">{!! QrCode::size(40, 50)->generate($book->id) !!}
                                        </td>
                                        <td>
                                            {{ $book->title }}
                                        </td>
                                        <td>
                                            {{ $book->author }}
                                        </td>
                                        <td>{{ $book->copyright }}</td>
                                        <td>
                                            {{ $book->accession }}
                                        </td>
                                        <td>
                                            {{ date('Y-m-d', strtotime($book->created_at)) }}
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
                    </div>
                </div>
            </div>
            <div class="modal fade AddUpdate" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">UPDATE BOOK</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <div class="mb-3">
                                <label for="bookid" class="form-label">BOOK ID</label>
                                <input type="text" class="form-control modal-book-id" id="bookid" name="bookid"
                                    :value="old('bookid')" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="updatetitle" class="form-label">TITLE</label>
                                <input style="text-transform:uppercase" type="text"
                                    class="form-control modal-book-title" id="updatetitle" name="updatetitle"
                                    :value="old('updatetitle')">
                            </div>
                            <p id="msg1title" class="text-danger"> </p>
                            <div class="mb-3">
                                <label for="updateauthor" class="form-label">AUTHOR/S</label>
                                <input style="text-transform:uppercase" type="text"
                                    class="form-control modal-book-author" id="updateauthor" name="updateauthor"
                                    :value="old('updateauthor')">
                            </div>
                            <p id="msg1author" class="text-danger"> </p>

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

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success btn-tr-update">Update</button>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>


            <div class="modal fade" id="backdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="titleofbook"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            After removing this book, it will automatically go to archived.
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success removenow" id="remove">Are you sure you want
                                to remove this?</button>
                            <p id="myParagraph"></p>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <embed id="qrcode-frame" src="" frameborder="0" width="100%" height="100%">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="tablemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">PRINT BOOK LIST</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <embed id="table-frame" src="" frameborder="0" width="100%" height="100%">
                        </div>
                    </div>
                </div>
            </div>
            </tr>
            </tbody>
            @endforeach
            </table>

            <div class="modal fade" id="modal_import" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">IMPORT EXCEL FILE</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="file" id="fileInput" accept=".xlsx, .xls" />
                            <button type="button" class="btn btn-success" onclick="importExcelFile()">Import</button>
                            <button type="button" class="btn btn-success" onclick="insertData()">Register</button>
                            <br><br>
                            <table id="importTable" class="table table-bordered">
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <div class="pagination justify-content-center">
            {{ $books->links() }}
        </div>
    </div>
    <br>
    <br>



@section('style')
    <style>
        #importTable {
            border-collapse: collapse;
            width: 100%;
        }

        #importTable th,
        #importTable td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #importTable th {
            background-color: #f2f2f2;
        }

        #importTable td input[type="text"] {
            width: 100%;
            box-sizing: border-box;
        }

        .removeButton {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            position: relative;
            z-index: 1;
        }
    </style>
@endsection

@section('script')
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
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
                $('#p1').text(data.book.booktitle)
            });

            // $('#p1').text(id)          
            const frame = $('#qrcode-frame')
            const link = '/generate-pdf/' + id
            frame.attr('src', link)

        });

        $('.print-tbl').on('click', function() {

            const frame = $('#table-frame')
            const link = '/generate-table/'
            frame.attr('src', link)
            console.log('button clicked');

        });


        $(document).on('click', '.btn-tr-update', function(e) {
            e.preventDefault();
            $(this).text('Checking');
            var data = {
                'id': $('.modal-book-id').val(),
                'title': $('.modal-book-title').val(),
                'author': $('.modal-book-author').val(),
                'copyright': $('.modal-book-copyright').val(),
                'accession': $('.modal-book-accession').val(),
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
                        $('#msgcopyright').html("");
                        $('#msg1accession').html("");
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
                'copyright': $('.t-copyright').val(),
                'accession': $('.t-accession').val(),
                'copies': $('.t-copies').val(),
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
                        $('#msgauthor').html("");
                        $('#msgcopyright').html("");
                        $('#msgaccession').html("");
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
                            case !!response.errors.author:
                                $('#msgauthor').append(response.errors.author);
                                $('#msgauthor').addClass('alert alert-danger');
                                break;
                            default:
                                $('#msgauthor').removeClass('alert alert-danger');
                        }
                        switch (true) {
                            case !!response.errors.copyright:
                                $('#msgcopyright').append(response.errors.copyright);
                                $('#msgcopyright').addClass('alert alert-danger');
                                break;
                            default:
                                $('#msgcopyright').removeClass('alert alert-danger');
                        }
                        switch (true) {
                            case !!response.errors.accession:
                                $('#msgaccession').append(response.errors.accession);
                                $('#msgaccession').addClass('alert alert-danger');
                                break;
                            default:
                                $('#msgaccession').removeClass('alert alert-danger');
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


        var importedData = []; // Array to store the imported data

        function importExcelFile() {
            var fileInput = document.getElementById('fileInput');
            var table = document.getElementById('importTable');
            table.innerHTML = '';

            if (fileInput.files.length === 0) {
                alert('Please select an Excel file.');
                return;
            }

            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var data = new Uint8Array(e.target.result);
                var workbook = XLSX.read(data, {
                    type: 'array'
                });

                var worksheet = workbook.Sheets[workbook.SheetNames[0]];
                var jsonData = XLSX.utils.sheet_to_json(worksheet, {
                    header: 1
                });

                // Define the column headers
                var columnHeaders = ['ID', 'TITLE', 'AUTHOR', 'COPYRIGHT', 'ACCESSION NO.', 'COPIES', ''];

                // Add column headers
                var headerRow = document.createElement('tr');

                for (var j = 0; j < columnHeaders.length; j++) {
                    var cellHeader = document.createElement('th');
                    cellHeader.textContent = columnHeaders[j];
                    headerRow.appendChild(cellHeader);
                }

                table.appendChild(headerRow);

                for (var i = 1; i < jsonData.length; i++) {
                    (function() {
                        var row = document.createElement('tr');

                        for (var j = 0; j < jsonData[i].length; j++) {
                            var cell = document.createElement('td');
                            var input = document.createElement('input');
                            input.type = 'text';
                            input.value = jsonData[i][j];
                            cell.appendChild(input);
                            row.appendChild(cell);
                        }

                        // Add an input column for "COPIES"
                        var copiesCell = document.createElement('td');
                        var copiesInput = document.createElement('input');
                        copiesInput.type = 'text';
                        copiesInput.value = '0'; // Set the default value to 0
                        copiesCell.appendChild(copiesInput);
                        row.appendChild(copiesCell);

                        // Add a remove button column
                        var removeButtonCell = document.createElement('td');
                        var removeButton = document.createElement('button');
                        removeButton.textContent = 'Remove';
                        removeButton.className = 'removeButton';
                        removeButton.addEventListener('click', function() {
                            removeImportedRow(rowData);
                            table.removeChild(row);
                        });
                        removeButtonCell.appendChild(removeButton);
                        row.appendChild(removeButtonCell);

                        table.appendChild(row);

                        // Push the row data into the importedData array
                        var rowData = {
                            id: jsonData[i][0],
                            title: jsonData[i][1],
                            author: jsonData[i][2],
                            copyright: jsonData[i][3],
                            accession: jsonData[i][4],
                            copies: copiesInput
                        };

                        importedData.push(rowData);
                    })();
                }
            };

            reader.readAsArrayBuffer(file);
        }

        function removeImportedRow(rowData) {
            var index = importedData.indexOf(rowData);
            if (index > -1) {
                importedData.splice(index, 1);
            }
        }

        function insertData() {
            if (importedData.length === 0) {
                alert('No data to register. Please import an Excel file first.');
                return;
            }

            for (var i = 0; i < importedData.length; i++) {
                var rowData = importedData[i];
                var dataToInsert = {
                    title: rowData.title,
                    author: rowData.author,
                    copyright: rowData.copyright,
                    accession: rowData.accession,
                    copies: rowData.copies.value
                };
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/test',
                    type: 'POST',
                    data: dataToInsert,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function(response) {
                        console.log(response.message);
                        // Handle success, if needed
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        // Handle error, if needed
                    }
                });
            }

            // Clear the imported data and the table
            importedData = [];
            var table = document.getElementById('importTable');
            table.innerHTML = '';

            alert('Data registered successfully.');
        }
    </script>
@endsection
@endsection
