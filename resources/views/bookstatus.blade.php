@extends('layouts.app')

@section('content')
    <br>
    <div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active text-success" aria-current="page">Book Management</li>
                <li class="breadcrumb-item active text-success" aria-current="page">Borrow Books /Return Books</li>
            </ol>
        </nav>
    </div>
    <br><br>
    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col">
                <a href="borrowpage">
                    <button type="button" class="btn btn-success  w-100 btn-lg">BORROW BOOK</button></a>
            </div>
            <div class="col">
                <a href="returnpage">
                    <button type="button" class="btn btn-success  w-100 btn-lg">RETURN BOOK</button></a>
            </div>
        </div>
        <br>
        <hr class=" text-success">

        <div class="row align-items-start">
            <div class="col">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2>Borrowed History</h2>
                    </div>
                </div>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-success text-white">
                            <th scope="col">Book Title</th>
                            <th scope="col">Name of Borrower</th>
                            <th scope="col">Date Borrowed</th>
                            <th scope="col">Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($borrow as $item)
                                <td>{{ $item->book->booktitle }}</td>
                                <td>{{ $item->student->name }} {{ $item->student->middle }} {{ $item->student->lastname }}
                                </td>
                                <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                <td>{{ $item->duedate }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <div class="pagination justify-content-center">
                    {!! $borrow->links() !!}
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2>Returned History</h2>
                    </div>
                </div>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-success text-white">
                            <th scope="col">Book Title</th>
                            <th scope="col">Name of Borrower</th>
                            <th scope="col">Date Borrowed</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Book Returned</th>
                            <th scope="col">Penalty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($return as $item)
                                <td>{{ $item->book->booktitle }}</td>
                                <td>{{ $item->student->name }} {{ $item->student->middle }} {{ $item->student->lastname }}
                                </td>
                                <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                <td>{{ $item->duedate }}</td>
                                <td>{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                                <td>{{$item->penalty($item->duedate)}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <div class="pagination justify-content-center">
                    {!! $return->links() !!}
                </div>
            </div>
        </div>
        <br><br>
    </div>
@endsection
