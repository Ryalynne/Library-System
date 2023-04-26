@extends('layouts.app')

@section('content')
    <br>
    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-success">Book Management</li>
                <li class="breadcrumb-item active text-success" aria-current="page">Book List</li>
            </ol>
        </nav>
    </div>
    <div class="table-responsive-lg">
        <div class="container">
            <br>
            <div id="success_message"></div>
            <!-- Button trigger modal -->
            <div class="d-flex mb-1">
                <div class="me-auto p-2">
                    <button type="button" class="btn btn-success bg-success border-success" data-bs-toggle="modal"
                        data-bs-target="#modal_addbook">
                        Register Books
                    </button>
                    <button type="button" class="btn btn-success bg-success border-success">
                        Print Book List
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path
                                d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                            <path
                                d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
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
            {{-- method="POST" action="{{ route('books.store') }} --}}
            <!-- Modal -->
            <form>
                @csrf
                <div class="modal fade AddStudentModal" id="modal_addbook" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Register Books</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                {{-- textfield --}}
                                <div class="mb-3">
                                    <label for="isbn" class="form-label">ISBN</label>
                                    <input type="text" class="form-control t-isbn" id="isbn" name="isbn"
                                        :value="old('isbn')" placeholder="ex.4092752">

                                </div>
                                <p id="msgisbn"> </p>
                                {{-- textfield --}}


                                <div class="mb-3">
                                    <label for="booktitle" class="form-label">BOOK TITLE</label>
                                    <input style="text-transform:uppercase" type="text" class="form-control t-booktitle"
                                        id="booktitle" name="booktitle" :value="old('booktitle')"
                                        placeholder="ex.Math with Friends">

                                </div>
                                <p id="msgbooktitle"> </p>

                                {{-- textfield --}}
                                <div class="mb-3">
                                    <label for="author" class="form-label">AUTHOR/S</label>
                                    <input style="text-transform:uppercase" type="text" class="form-control t-author"
                                        id="author" name="author" :value="old('author')" placeholder="ex.Camille Pura">

                                </div>
                                <p id="msgauthor"> </p>
                                {{-- textfield --}}
                                <div class="mb-3">
                                    <label for="datepublish" class="form-label">DATE PUBLISH</label>
                                    <input type="date" class="form-control t-datepublish" id="datepublish"
                                        name="datepublish" :value="old('datepublish')" placeholder="ex.BMA">

                                </div>
                                <p id="msgdatepublish"> </p>
                                {{-- textfield --}}
                                <div class="mb-3">
                                    <label for="publisher" class="form-label">PUBLISHER</label>
                                    <input style="text-transform:uppercase" type="text" class="form-control t-publisher"
                                        id="publisher" name="publisher" :value="old('publisher')" placeholder="ex.BMA">

                                </div>
                                <p id="msgpublisher"> </p>
                                {{-- textfield --}}
                                <div class="mb-3">
                                    <label for="genre" class="form-label">GENRE</label>
                                    <input style="text-transform:uppercase" type="text" class="form-control t-genre"
                                        id="genre" name="genre" :value="old('genre')"placeholder="ex.Math">

                                </div>
                                <p id="msggenre"> </p>
                                {{-- textfield --}}
                                <div class="mb-3">
                                    <label for="copies" class="form-label">COPIES</label>
                                    <input type="text" class="form-control t-copies" id="copies" name="copies"
                                        :value="old('copies')" placeholder="ex.20">
                                </div>
                                <p id="msgcopies"> </p>
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
                    <table class="table table-bordered myTable">
                        <thead>
                            <tr class="bg-success text-white">
                                <th scope="col" class="text-center">BOOK ID</th>
                                <th scope="col" class="text-center">ISBN</th>
                                <th scope="col" class="text-center">BOOK TITLE</th>
                                <th scope="col" class="text-center">AUTHOR/S</th>
                                <th scope="col" class="text-center">DATE PUBLISH</th>
                                <th scope="col" class="text-center">PUBLISHER</th>
                                <th scope="col" class="text-center">GENRE</th>
                                <th scope="col" class="text-center">ADDED DATE</th>
                                <th scope="col" class="text-center">BARCODE</th>
                                <th scope="col" class="text-center ">ACTIONS PERFORM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
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
                                        {{ $book->publisher }}
                                    </td>
                                    <td>
                                        {{ $book->genre }}
                                    </td>
                                    <td class="col-1">
                                        {{ date('Y-m-d', strtotime($book->created_at)) }}
                                    </td>
                                    <td class="text-center">
                                        {!! QrCode::size(40, 50)->generate($book->id) !!}
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


                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#backdrop"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg></button>

                                        <button type="button" class="btn btn-sm btn-primary btn-qr getbookid"
                                            data-bs-toggle="modal" data-id={{ $book->id }}
                                            data-bs-target="#qrcodemodal"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="20" height="20" fill="currentColor" class="bi bi-qr-code"
                                                viewBox="0 0 16 16">
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
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">UPDATE BOOK</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- MODAL BODY --}}
                    <div class="modal-body ">
                        <form method="POST" action="{{ route('books.update-book') }}">
                            @csrf
                            <fieldset>
                                <div class="mb-3">
                                    <label for="bookid" class="form-label">BOOK ID</label>
                                    <input type="text" class="form-control modal-book-id" id="bookid"
                                        name="bookid" :value="old('bookid')" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="bookid" class="form-label">ISBN</label>
                                    <input type="text" class="form-control modal-book-isbn" id="bookid"
                                        name="bookid" :value="old('bookid')" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="updatebooktitle" class="form-label">BOOK TITLE</label>
                                    <input style="text-transform:uppercase" type="text"
                                        class="form-control modal-book-title" id="updatebooktitle" name="updatebooktitle"
                                        :value="old('updatebooktitle')">
                                </div>
                                <div class="mb-3">
                                    <label for="updateauthor" class="form-label">AUTHOR/S</label>
                                    <input style="text-transform:uppercase" type="text"
                                        class="form-control modal-book-author" id="updateauthor" name="updateauthor"
                                        :value="old('updateauthor')">
                                </div>
                                <div class="mb-3">
                                    <label for="updatepublish" class="form-label">DATE
                                        PUBLISH</label>
                                    <input type="date" class="form-control modal-book-datepublish" id="updatepublish"
                                        name="updatepublish" :value="old('updatepublish')">
                                </div>
                                <div class="mb-3">
                                    <label for="updatepublisher" class="form-label">PUBLISHER</label>
                                    <input style="text-transform:uppercase" type="text"
                                        class="form-control modal-book-publisher" id="updatepublisher"
                                        name="updatepublisher" :value="old('updatepublisher')">
                                </div>
                                <div class="mb-3">
                                    <label for="updategenre" class="form-label">GENRE</label>
                                    <input style="text-transform:uppercase" type="text"
                                        class="form-control modal-book-genre" id="updategenre" name="updategenre"
                                        :value="old('updategenre')">
                                </div>
                            </fieldset>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update Book</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="backdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        After removing this book it will automatically go to archived.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Are you sure you want to remove
                            this? </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="qrcodemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="p1"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed id="qrcode-frame" src="" frameborder="0" width="100%" height="400px">
                </div>
            </div>
        </div>
    </div>


    </tr>
    </tbody>
    @endforeach
    </table>
    <div class="pagination justify-content-center">
        {{ $books->links() }}
    </div>
    </div>
    <br>
    <br>
@section('script')
    <script>
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

        $(document).on('click', '.btn-tr-submit', function(e) {
            e.preventDefault();
            $(this).text('Checking');
            var data = {
                'isbn': $('.t-isbn').val(),
                'author': $('.t-author').val(),
                'publisher': $('.t-publisher').val(),
                'datepublish': $('.t-datepublish').val(),
                'booktitle': $('.t-booktitle').val(),
                'genre': $('.t-genre').val(),
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
                    // console.log(response);         
                    if (response.status == 400) {

                        $('#msgisbn').html("");
                        $('#msgisbn').addClass('alert alert-danger');

                        $('#msgbooktitle').html("");
                        $('#msgbooktitle').addClass('alert alert-danger');

                        $('#msgauthor').html("");
                        $('#msgauthor').addClass('alert alert-danger');

                        $('#msgdatepublish').html("");
                        $('#msgdatepublish').addClass('alert alert-danger');

                        $('#msggenre').html("");
                        $('#msggenre').addClass('alert alert-danger');

                        $('#msgcopies').html("");
                        $('#msgcopies').addClass('alert alert-danger');

                        $('#msgpublisher').html("");
                        $('#msgpublisher').addClass('alert alert-danger');


                        $.each(response.errors, function(key, err_value) {
                            if (key == "isbn") {
                                $('#msgisbn').append(err_value);
                            }
                            if (key == "booktitle") {
                                $('#msgbooktitle').append(err_value);
                            }
                            if (key == "author") {
                                $('#msgauthor').append(err_value);
                            }
                            if (key == "datepublish") {
                                $('#msgdatepublish').append(err_value);
                            }
                            if (key == "genre") {
                                $('#msggenre').append(err_value);
                            }
                            if (key == "copies") {
                                $('#msgcopies').append(err_value);
                            }
                            if (key == "publisher") {
                                $('#msgpublisher').append(err_value);
                            }
                        });
                        $('.btn-tr-submit').text('Register');
                    } else {
                        location.reload();
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('.AddStudentModal').find('input').val('');
                        $('.btn-tr-submit').text('Register');
                        $('.AddStudentModal').modal('hide');
                    }
                }
            });
        })
    </script>
@endsection
@endsection
