@extends('layouts.app')

@section('content')
    <br>
    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-success">Book Management</li>
                <li class="breadcrumb-item active text-success myInput" aria-current="page">Book Adjustment</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <br>
        <div id="success_message"></div>
        <div id="success_message_copies"></div>
        <div class="d-flex mb-1 ">
            <div class="me-auto p-2">
                <button type="button" class="btn btn-success bg-success border-success print-tbl" data-bs-toggle="modal"
                    data-bs-target="#printcopies">
                    Print Book List with Copies
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
                    <form method="GET" action="/bookadjustment">
                        @csrf
                        <input class="myInput form-control " placeholder="Search here" name="search" />
                    </form>
                </div>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-bordered border-dark myTable">
                <thead>
                    <tr class="bg-success text-white">

                        <th scope="col" class="text-center">TITLE</th>
                        <th scope="col" class="text-center">AUTHOR/S</th>
                        <th scope="col" class="text-center">DEPARTMENT</th>
                        <th scope="col" class="text-center">COPYRIGHT</th>
                        <th scope="col" class="text-center">ACCESSION NO</th>
                        <th scope="col" class="text-center">CALL NO</th>
                        <th scope="col" class="text-center">SUBJECT</th>
                        <th scope="col" class="text-center">COPIES</th>
                        <th scope="col" class="text-center">ACTIONS PERFORM</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">

                            <td class="px-6 py-3">
                                {{ $book->title }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $book->author }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $book->department }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $book->copyright }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $book->accession }}
                            </td>
                            <td>
                                {{ $book->callnumber }}
                            </td>
                            <td>
                                {{ $book->subject }}
                            </td>
                            <td class="px-6 py-3">
                                {{ $book->numberofcopies() }}
                            </td>
                            <td class="text-center col-2">
                                {{-- button --}}
                                <button type="button" class="btn btn-primary edit-button" data-id={{ $book->id }}
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                </button>

                                <button type="button" class="btn btn-danger edit-button" data-bs-toggle="modal"
                                    data-id={{ $book->id }} data-bs-target="#back"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-dash-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                    </svg></button>
                            </td>
                            {{-- modal --}}
                            <div class="modal fade Addcopies" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">ADJUST COPIES</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        {{-- MODAL BODY --}}
                                        <div class="modal-body ">
                                            {{-- <form method="POST" action="{{ route('books.update-copy') }}">
                                                <fieldset> --}}
                                            <div class="mb-3">
                                                <label for="disabledTextInput" class="form-label">BOOK ID</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-id" placeholder="Disabled input"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="disabledTextInput" class="form-label">
                                                    TITLE</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-title" placeholder="Disabled input"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="disabledTextInput" class="form-label">AUTHOR/S</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-author" placeholder="Disabled input"
                                                    readonly>
                                            </div>
                                            {{-- department --}}
                                            <div class="mb-3">
                                                <label for="disabledTextInput" class="form-label">department</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-department"
                                                    placeholder="Disabled input" readonly>
                                            </div>
                                            {{-- department --}}
                                            <div class="mb-3">
                                                <label for="disabledTextInput" class="form-label">COPYRIGHT</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-copyright" placeholder="Disabled input"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="disabledTextInput" class="form-label">ACCESSION</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-accession" placeholder="Disabled input"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">AVAILABLE
                                                    COPIES</label>
                                                <input type="text" id=""
                                                    class="form-control modal-copy-copies" placeholder="" readonly>
                                            </div>
                                            {{-- </fieldset> --}}
                                            <div class="mb-3">
                                                <label for="addcopies" class="form-label">ADD NEW COPIES</label>
                                                <input type="hidden" name="bookid" class="modal-book-id ">
                                                <input input type="text" class="form-control add-copies"
                                                    id="addcopies" name="addcopies" :value="old('addcopies')"
                                                    placeholder="ex.10">
                                            </div>
                                            <p id="msgcopies" class="text-danger"> </p>
                                        </div>

                                        <div class="modal-footer">
                                            {{-- @csrf --}}
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success add-copies-btn">Add
                                                copies</button>
                                        </div>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade Lesscopiesmodal" id="back" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="backrop" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="back">ADJUST COPIES</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        {{-- MODAL BODY --}}

                                        <div class="modal-body ">
                                            {{-- <form method="POST" action="{{ route('books.updatenegative-copy') }}">
                                                <fieldset> --}}
                                            <div class="mb-3">
                                                <label class="form-label">BOOK ID</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-id" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">TITLE</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-title" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">AUTHOR/S</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-author" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="disabledTextInput" class="form-label">COPYRIGHT</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-copyright" placeholder="Disabled input"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="disabledTextInput" class="form-label">ACCESSION</label>
                                                <input type="text" id="disabledTextInput"
                                                    class="form-control modal-book-accession" placeholder="Disabled input"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">AVAILABLE
                                                    COPIES:</label>
                                                <input type="text" id="availcopies"
                                                    class="form-control modal-copy-copies" name="availcopies"
                                                    :value="old('availcopies')" placeholder="" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lesscopies" class="form-label">NUMBER OF COPIES TO BE
                                                    REMOVED</label>
                                                <input type="hidden" name="bookid" class="modal-book-id">
                                                <input type="text" class="form-control less-copies" id="lesscopies"
                                                    name="lesscopies" :value="old('lesscopies')" placeholder="ex.10">
                                            </div>
                                            <p id="msglesscopies" class="text-danger"> </p>
                                            <div class="mb-3">
                                                <label for="comment" class="form-label">REASON</label>
                                                <input type="text" class="form-control modal-book-comment"
                                                    id="comment" name="comment" :value="old('comment')"
                                                    placeholder="ex.damage">
                                            </div>
                                            <p id="msgcomment" class="text-danger"> </p>
                                        </div>
                                        {{-- footermodal --}}
                                        <div class="modal-footer">
                                            @csrf
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success less-copies-btn">Adjust
                                                copies</button>
                                        </div>
                                        {{-- </form> --}}
                                        {{-- end of form --}}
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                </tfoot>

            </table>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            {{ $books->links() }}
        </div>
        <br>
        <br>

    </div>

    <div class="modal fade" id="printcopies" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">PRINT BOOK LIST</h1>
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
        $('.print-tbl').on('click', function() {
            const frame = $('#table-frame')
            const link = '/generate-tblcopies/'
            frame.attr('src', link)
            console.log('button clicked');
        });

        $(document).on('click', '.add-copies-btn', function(e) {
            e.preventDefault();
            $(this).text('Checking');
            var data = {
                'addcopies': $('.add-copies').val(),
                'bookid': $('.modal-book-id ').val(),
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('books.update-copy') }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.status == 400) {
                        $('#msgcopies').html("");
                        if (response.errors.addcopies) {
                            $('#msgcopies').append(response.errors.addcopies);
                            $('#msgcopies').addClass('alert alert-danger');
                        } else {
                            $('#msgcopies').removeClass('alert alert-danger');
                        }
                        $('.add-copies-btn').text('Add Copies');
                    } else {
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('.Addcopies').find('input').val('');
                        $('.add-copies-btn').text('Add Copies');
                        $('.Addcopies').modal('hide');
                        // Refresh the page after 3 seconds
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            });
        });


        $(document).on('click', '.less-copies-btn', function(e) {
            e.preventDefault();
            $(this).text('Checking');
            var data = {
                'lesscopies': $('.less-copies').val(),
                'bookid': $('.modal-book-id').val(),
                'comment': $('.modal-book-comment').val(),
                'availcopies': $('#availcopies').val(),
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('books.updatenegative-copy') }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.status == 400) {
                        $('#msglesscopies').html("");
                        $('#msgcomment').html("");

                        if (response.errors.lesscopies) {
                            $('#msglesscopies').append(response.errors.lesscopies);
                            $('#msglesscopies').addClass('alert alert-danger');
                        } else {
                            $('#msglesscopies').removeClass('alert alert-danger');
                        }
                        if (response.errors.comment) {
                            $('#msgcomment').append(response.errors.comment);
                            $('#msgcomment').addClass('alert alert-danger');
                        } else {
                            $('#msgcomment').removeClass('alert alert-danger');
                        }

                        $('.less-copies-btn').text('Less Copies');
                    } else {
                        $('#success_message_copies').html("");
                        $('#success_message_copies').addClass('alert alert-success');
                        $('#success_message_copies').text(response.message);
                        $('.Lesscopiesmodal').find('input').val('');
                        $('.less-copies-btn').text('Less Copies');
                        $('.Lesscopiesmodal').modal('hide');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                }
            });
        });
    </script>
@endsection
@endsection
