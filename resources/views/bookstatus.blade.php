@extends('layouts.app')

@section('content')
<br>
<div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">      
          <li class="breadcrumb-item active text-success" aria-current="page">Book Management</li>
          <li class="breadcrumb-item active text-success" aria-current="page">Books Issued / Returned</li>
        </ol>
      </nav>
</div>
<br><br>
<div class="container text-center"> 
    <div class="row align-items-start">
        <div class="col">
            <a href = "borrowpage">
            <button type="button"  class="btn btn-outline-success w-100 btn-lg">Issued Books</button></a>
        </div>
        <div class="col">
            <a href = "returnpage">
            <button type="button" class="btn btn-outline-success w-100 btn-lg">Returned Books</button></a>
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
        <table class="table">
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
                <th>a</th>
                <td>a</td>
                <td>a</td>
                <td>a</td>
              </tr>
            </tbody>
          </table>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body bg-success text-white">
                <h2>Returned History</h2>
            </div>
          </div>
          <br>
        <table class="table">
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
                <th>b</th>
                <td>b</td>
                <td>b</td>
                <td>b</td>
                <td>b</td>
                <td>b</td>
              </tr>
            </tbody>
          </table>
    </div>
  </div>

</div>

@endsection