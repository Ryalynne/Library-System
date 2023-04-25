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
        <div class="row align-items-start ">
            <div class="col border-end">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2> BOOKS INFORMATION</h2>
                    </div>
                </div>
                <br>
                <div class="container text-start">
                    <center>
                        <img src="https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png"
                            class="img-thumbnail w-50" alt="...">
                    </center>
                    <div class="mb-3">
                        <label class="form-label">STUDENT ID</label>
                        {{-- <form action="{{ route('borrowpage') }}" method="get"> --}}
                        <input type="text" class="form-control studid" name="student" :value="old('student')"
                            value="{{ request()->input('student') ? $student->id : ' ' }}">
                        {{-- </form> --}}
                    </div>
                    <div class="mb-3">
                        <label for="booktitle" class="form-label">FULL NAME</label>
                        <input style="text-transform:uppercase" type="text" class="form-control full-name"
                            value="{{ request()->input('student') ? $student->name . ' ' . $student->middle . ' ' . $student->lastname : ' ' }}"
                            disabled>
                    </div>

                    <div class="mb-3">
                        <label for="booktitle" class="form-label">CLASS</label>
                        <input style="text-transform:uppercase" type="text" class="form-control class"
                            value="{{ request()->input('student') ? $student->class : ' ' }}" disabled>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2>RETURN BOOK</h2>
                    </div>
                </div>
                <br>
                <table class="table table-bordered" id="tbl">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>ISBN</th>
                            <th>BOOK TITLE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowbook as $book)
                            @foreach ($books as $item)
                                @if ($book->bookid == $item->id)
                                    <td> {{ $item->isbn }}</td>
                                @endif
                                @if ($book->bookid == $item->id)
                                    <td>
                                        {{ $item->booktitle }}
                                    </td>
                                @endif
                            @endforeach
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="check" id="flexCheckDefault"
                                        checked>
                                    <label for="flexCheckDefault" class="form-check-label">Return</label>
                                </div>
                            </td>
                    </tbody>
                    @endforeach
                </table>
                <br>
                <div class="text-end">
                    <button type="button" class="btn btn-success  w-50 btn-lg">Return Books</button></a>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>
    <br><br>

@section('script')
    <script>
        const someCheckbox = document.getElementById('flexCheckDefault');

        someCheckbox.addEventListener('change', e => {
            if (e.target.checked === true) {
                console.log("Checkbox is checked - boolean value: ", e.target.checked)
            }
            if (e.target.checked === false) {
                console.log("Checkbox is not checked - boolean value: ", e.target.checked)
            }
        })

        $('.studid').on('keyup', function() {
            var id = $(this).val().toLowerCase();
            if (id == "") {
                $('.full-name').val("")
                $('.class').val("")
                document.location.href = "returnpage";
                document.getElementById('myBtn').disabled = true;
            } else {
                $.get("/student/" + id, function(data, status) {

                    try {
                        if (id == data.student.id) {
                            document.location.href = "returnpage" + '?student=' + data.student.id;
                            console.log('true');
                        }
                    } catch (err_value) {
                        alert('No Student that have ' + id);
                        document.location.href = "returnpage";
                        console.log('false');
                    }

                });
            }
        });
    </script>
@endsection
@endsection
