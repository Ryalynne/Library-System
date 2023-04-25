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
                    <button type="button" class="btn btn-outline-success w-100 btn-lg">Borrow Books</button></a>
            </div>
            <div class="col">
                <a href="returnpage">
                    <button type="button" class="btn btn-outline-success w-100 btn-lg">Return Books</button></a>
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
                        <tr>
                            <th scope="col">Book Title</th>
                            <th scope="col">Name of Borrower</th>
                            <th scope="col">Date Borrowed</th>
                            <th scope="col">Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($borrow as $item)
                                @foreach ($books as $booklist)
                                    @if ($booklist->id == $item->bookid)
                                        <td>{{ $booklist->booktitle }}</td>
                                    @endif
                                @endforeach
                                @foreach ($student as $studname)
                                    @if ($item->studentid == $studname->id)
                                        <td>{{ $studname->name }} {{ $studname->middle }} {{ $studname->lastname }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->duedate }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
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
                        <tr>
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
                                @foreach ($books as $booklist)
                                    @if ($booklist->id == $item->bookid)
                                        <td>{{ $booklist->booktitle }}</td>
                                    @endif
                                @endforeach
                                @foreach ($student as $studname)
                                    @if ($item->studentid == $studname->id)
                                        <td>{{ $studname->name }} {{ $studname->middle }} {{ $studname->lastname }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->duedate }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection
