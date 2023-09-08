@extends('layouts.app')

@section('content')
    <div class="card text-center border border-success">
    </div>
    <br>
    <div class="container">
        <div class="row align-items-start">
            <div class="col">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2>Archived History</h2>
                    </div>
                </div>
                <div class="d-flex mb-1 ">
                    <div class="me-auto p-2">
                        <button type="button" class="btn btn-success bg-success border-success  printbtn"
                            data-bs-toggle="modal" data-bs-target="#tablemodal">
                            Print Adjustment
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
                            <input type="search" class="form-control rounded myInput" placeholder="Search"
                                aria-label="Search" aria-describedby="search-addon" />
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered myTable border-dark">
                        <thead>
                            <tr class="bg-success text-white">
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col" class="text-center">TITLE</th>
                                <th scope="col" class="text-center">AUTHOR/S</th>
                                <th scope="col" class="text-center">CATEGORIES</th>
                                <th scope="col" class="text-center">COPYRIGHT</th>
                                <th scope="col" class="text-center">ACCESSION NO</th>
                                <th scope="col" class="text-center">ADDED DATE</th>
                                <th scope="col" class="text-center">REMOVE DATE</th>
                                <th scope="col" class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr">
                                @foreach ($adjustment as $adjust)
                                    <td>
                                        {{ $adjust->id }}
                                    </td>
                                    <td>
                                        {{ $adjust->title }}
                                    </td>
                                    <td>
                                        {{ $adjust->author }}
                                    </td>
                                    <td>
                                        {{ $adjust->categories }}
                                    </td>
                                    <td>
                                        {{ $adjust->copyright }}
                                    </td>
                                    <td>
                                        {{ $adjust->accession }}
                                    </td>
                                    <td>
                                        {{ date('Y-m-d', strtotime($adjust->created_at)) }}
                                    </td>
                                    <td>
                                        {{ date('Y-m-d', strtotime($adjust->updated_at)) }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm remove-book"
                                            data-bs-toggle="modal" data-bs-target="#backdrop"
                                            data-id={{ $adjust->id }}><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor"
                                                class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                                            </svg></button>
                                    </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                <br>
                <div class="pagination justify-content-center">
                    {!! $adjustment->links() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tablemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">PRINT ACTION</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed id="table-frame" src="" frameborder="0" width="100%" height="100%">
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
                    After removing this book, it will automatically go to booklist.
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success removenow" id="remove">Are you sure you want
                        to remove this?</button>
                    <p id="myParagraph"></p>
                </div>
            </div>
        </div>
    </div>


@section('script')
    <script>
        $(".printbtn").on('click', function() {
            const frame = $('#table-frame')
            const link = '/generate-tbladjustment/'
            frame.attr('src', link)
        });

        var removeid = "";

        $('.remove-book').on('click', function() {
            var id = $(this).data('id');
            $.get("/bookarchived/" + id, function(data, status) {
                if (data.book && data.book.id == id) {
                    document.getElementById("titleofbook").innerHTML = data.book.title;
                    removeid = id;
                    console.log(removeid);
                }
                console.log(removeid);
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
                url: "/removearchived/" + id,
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
        
    </script>
@endsection
@endsection
