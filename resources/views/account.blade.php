@extends('layouts.app')

@section('content')
    <br>
    <div class="container">

        {{-- <button type="button" class="btn btn-success bg-success border-success" data-bs-toggle="modal"
            data-bs-target="#modal_addstudent">
            Register Borrower
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                <path
                    d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z" />
                <path
                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0Z" />
            </svg>
        </button> --}}
        <br><br>
        <div class="table-responsive">


            <table class="table table-bordered myTable">
                <thead>
                    <tr class="bg-success text-white">
                        <th>ID</th>
                        <th>QR CODE</th>
                        <th>LAST NAME</th>
                        <th>FIRST NAME</th>
                        <th>MIDDLE NAME</th>
                        <th>YEAR & COURSE </th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($account as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->account ? $student->account->student_number : '-' }}</td>
                            <td class="text-truncate">{{ $student->last_name }}</td>
                            <td class="text-truncate">{{ $student->first_name }}</td>
                            <td class="text-truncate">{{ $student->middle_name }}</td>
                            <td class="text-truncate">
                                @if ($student->enrollment_assessment)
                                    {{ strtoupper($student->enrollment_assessment->year_level() . ' - ' . $student->enrollment_assessment->course->course_code) }}
                                @else
                                    NOT ENROLLED
                                @endif
                            </td>
                            <td class="text-center col-1">
                                @if ($student->account)
                                    <img src="http://bma.edu.ph/img/student-picture/{{ $student->account->student_number }}.png"
                                        alt="No Image" class="img-fluid">
                                @else
                                    No Image Available
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">NO ACCOUNT AVAILABLE.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination justify-content-center">
            @if (count($account) > 0)
                {{ $account->links() }}
            @endif
            </div>
        </div>
    </div>
{{-- 
    
    <div class="modal fade AddUpdate" id="modal_addstudent" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">REGISTER ACCOUNT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('register.account') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Other form fields -->
                        <div class="mb-3">
                            <label for="qr_code" class="form-label">QR CODE</label>
                            <input type="text" class="form-control" id="qr_code" name="qr_code">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">NAME</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="mb-3">
                            <label for="middle_name" class="form-label">MIDDLE NAME</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">LAST NAME</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>

                        <div class="mb-3">
                            <label for="designation" class="form-label">DESIGNATION</label>
                            <input type="text" class="form-control" id="designation" name="designation">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">IMAGE</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success btn-tr-update">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}


@endsection

@section('script')
    <script></script>
@endsection
