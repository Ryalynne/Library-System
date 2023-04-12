@extends('layouts.app')

@section('content')
<br>
<div class="px-4 bg-white text-dark border border-success border-top-0 border-end-0">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item text-success">Books Management</li>
        <li class="breadcrumb-item text-success" aria-current="page">Books Issued / Returned</li>
        <li class="breadcrumb-item active text-success" aria-current="page">Books Issued</li>
      </ol>
    </nav> 
  </div>
  <br>
  <div class="container text-center">
    <div class="row align-items-start">
      <div class="col">   
        <div class="card">
          <div class="card-body bg-success text-white">
              <h2> BOOKS INFORMATION</h2>
          </div>
        </div>
      <br>
      <div class="container text-start">
        <div class="mb-3">
          <label  class="form-label">BOOK ID</label>
          <input  style="text-transform:uppercase" type="text" class="form-control">
        </div>
      <div class="mb-3">
          <label for="booktitle" class="form-label">BOOK TITLE</label>
          <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
        </div>

        <div class="mb-3">
          <label for="booktitle" class="form-label">AUTHOR/S</label>
          <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
        </div>

        <div class="mb-3">
          <label for="booktitle" class="form-label">DATE OF PUBLISH</label>
          <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
        </div>

        <div class="mb-3">
          <label for="booktitle" class="form-label">PUBLISHER</label>
          <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
        </div>
        <div class="mb-3">
          <label for="booktitle" class="form-label">DATE PUBLISHER</label>
          <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
        </div>
        <div class="mb-3">
          <label for="booktitle" class="form-label">DATE OF BORROWED</label>
          <input  type="date" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
        </div>
        <div class="mb-3">
          <label for="booktitle" class="form-label">DUE DATE</label>
          <input  type="date" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
        </div>
        <div class="mb-3">
          <label for="booktitle" class="form-label">PENALTY</label>
          <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
        </div>  
      </div>    
    </div> 
          <div class="col">
            <div class="card">
              <div class="card-body bg-success text-white">
                  <h2> BORROWER INFORMATION</h2>
              </div>
            </div>
            <br>
            <div class="container text-start">
              <div class="mb-3">
                  <label for="booktitle" class="form-label">STUDENT NUMBER</label>
                  <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
                </div>
            <div class="mb-3">
              <label for="booktitle" class="form-label">FULL NAME</label>
              <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
            </div>
            <div class="mb-3">
              <label for="booktitle" class="form-label">CLASS</label>
              <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
            </div>
            <div class="mb-3">
              <label for="booktitle" class="form-label">COPIES BORROWED</label>
              <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
            </div>
            <div class="mb-3">
              <label for="booktitle" class="form-label">COPIES TO RETURN</label>
              <input  style="text-transform:uppercase" type="text" class="form-control" id="booktitle" name="booktitle" :value="old('booktitle')" placeholder="">
            </div>
            </div>
            <div class="row justify-content-start">

              <div class="col">
                  <button type="button" class="btn btn-danger  w-100 btn-lg">Cancel</button>
              </div>
              <div class="col">
                  <a href = "borrowpage">
                  <button type="button"  class="btn btn-success  w-100 btn-lg">Returned Books</button></a>
              </div>
          </div> 
          </div>
       
      </div>
    </div>
  </div>
<br><br>

@endsection