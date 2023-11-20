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
                        <h2>ONLED HISTORY</h2>
                    </div>
                </div>
                <div class="d-flex mb-1 ">
                    <div class="me-auto p-2">
                        <button type="button" class="btn btn-success bg-success border-success printbtn"
                            data-bs-toggle="modal" data-bs-target="#tablemodal">
                            Print Onlend
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
                    <table class="table table-bordered myTable border-dark table-sm">
                        <thead>
                            <tr class="bg-success text-white">
                                <th scope="col">TRANSACTION</th>
                                <th scope="col">TITLE</th>
                                <th scope="col">AUTHORS/S</th>
                                <th scope="col">COPYRIGHT</th>
                                <th scope="col">ACCESSION NO</th>
                                <th scope="col">CALL NO</th>
                                <th scope="col">SUBJECT</th>
                                <th scope="col">BORROWER NAME</th>

                                <th scope="col">DATE BORROWED</th>
                                <th scope="col">DUE DATE</th>
                                <th scope="col">OVERDUE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr">
                                @foreach ($borrow as $item)
                                    <td>{{ $item->transaction }}</td>
                                    {{-- <td class="text-center">{{$item->student_number}}</td> --}}
                                    {{-- <td>{{ $item->book->id }}</td> --}}
                                    <td>{{ $item->book->title }}</td>
                                    <td>{{ $item->book->author }}</td>

                                    <td>{{ $item->book->copyright }}</td>
                                    <td>{{ $item->book->accession }}</td>
                                    <td>{{ $item->book->callnumber }}</td>
                                    <td>
                                        @if ($item->book->subject == null)
                                            no subject
                                        @else
                                            {{ $item->book->subjects->subjectName }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->student_list($item->borrower))
                                            {{ ucwords($item->borrower . ', ' . $item->student_list($item->borrower)) }}
                                        @else
                                            @php
                                                $staff = $item->staff_list($item->borrower);
                                            @endphp
                                            {{ ucwords($item->borrower . ', ' . $staff->last_name . ', ' . $staff->first_name) . ', ' . $staff->department }}
                                        @endif
                                        {{--  {{ json_encode($item->staff_list($item->borrower)) }} --}}
                                        {{--  {{ ($studentName = $item->student_list($item->borrower)) ?: ($staffName = $item->staff_list($item->borrower)) ?: 'no info' }} --}}
                                    </td>
                                    <td>{{ date('F j, Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ date('F j, Y', strtotime($item->duedate)) }}</td>
                                    <td>{{ $item->penalty($item->duedate) }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                <br>
                <div class="pagination justify-content-center">
                    {{ $borrow->links() }}
                </div>
                <br>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tablemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">PRINT ONLEND HISTORY</h1>
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
            const link = '/generate-tblonlend'
            frame.attr('src', link)
        });
    </script>
@endsection
<style>
    th {
        font-size: 13px;
    }
</style>
@endsection
