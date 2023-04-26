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
                        <h2>Onlend History</h2>
                    </div>
                </div>
                <div class="d-flex mb-1 ">
                    <div class="me-auto p-2">
                        <button type="button" class="btn btn-success bg-success border-success">
                            Print Onlend
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
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
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-success text-white">
                            <th scope="col">Qr Code</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Name of Borrower</th>
                            <th scope="col">Date Borrowed</th>
                            <th scope="col">Due Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($borrow as $item)
                                <td>{{ $item->book->id }}</td>                             
                                <td>{{ $item->book->booktitle }}</td>                         
                                <td>{{ $item->student->name }} {{ $item->student->middle }} {{ $item->student->lastname }}</td>                           
                                <td>{{ date('Y-m-d', strtotime($item->created_at))}}</td>
                                <td>{{ $item->duedate }}</td>
                        </tr>
                    </tbody>  
                    @endforeach              
                </table>   
                <div class="pagination justify-content-center">
                    {{ $borrow->links() }}
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection
