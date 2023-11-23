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
                        <h2>Book Action History</h2>
                    </div>
                </div>
                <div class="container">
                    <div class="d-flex mb-1 ">
                        <div class="me-auto p-2">
                            <button type="button" class="btn btn-success bg-success border-success printbtn"
                                data-bs-toggle="modal" data-bs-target="#tablemodal">
                                Print Action
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
                                    <th scope="col">TITLE</th>
                                    <th scope="col">AUTHOR/S</th>
                                    <th scope="col">DEPARTMENT</th>
                                    <th scope="col">COPYRIGHT</th>
                                    <th scope="col">ACCESSION NO</th>
                                    <th scope="col">CALL NO</th>
                                    <th scope="col">SUBJECT</th>
                                    <th scope="col">DATE OF ACTION</th>
                                    <th scope="col">ACTION PERFORM</th>
                                    <th scope="col">PERFORM BY</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr">
                                    @foreach ($action as $item)
                                        <td>{{ $item->book->title }}</td>
                                        <td>{{ $item->book->author }}</td>
                                        <td>
                                            {{ $item->book->departments->departmentName ?? 'No Department' }}
                                        </td>
                                        <td>{{ $item->book->copyright }}</td>
                                        <td>{{ $item->book->accession }}</td>
                                        <td>{{ $item->book->callnumber }}</td>
                                        <td>
                                            {{ $item->book->subjects->subjectName ?? 'No Subject' }}
                                        </td>
                                        <td>{{ date('F j, Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->action }}</td>
                                        <td>{{ $item->performby }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <br>
                    <div class="pagination justify-content-center">
                        {{ $action->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="tablemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">PRINT ACTION LIST</h1>
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
            $(".printbtn").on('click', function() {
                const frame = $('#table-frame')
                const link = '/generate-action/'
                frame.attr('src', link)
            });
        </script>
    @endsection
@endsection
