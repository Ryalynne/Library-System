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
              <br>
            <table class="table">
                <thead>
                  <tr>  
                    <th scope="col">BOOK ID</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">BOOK TITLE</th>                   
                    <th scope="col">DATE OF ACTION</th>
                    <th scope="col">ACTION PERFORM</th>
                    <th scope="col">PERFORM BY</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>5</td>
                    <td>123456789</td>
                    <td>HARRY POTTER</td>
                    <td>MARCH 30, 2023</td>
                    <td>ADDED</td>
                    <td>JONAS PETER</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>


@endsection