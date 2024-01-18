@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <div class="p-2">
            <div class="input-group">
                <form method="GET" action="/account">
                    @csrf
                    <input class="myInput form-control " placeholder="Search here" name="search" />
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered myTable">
                <thead>
                    <tr class="bg-success text-white">
                        <th>STUDENT ID</th>
                        <th>LAST NAME</th>
                        <th>FIRST NAME</th>
                        <th>MIDDLE NAME</th>
                        <th>YEAR & COURSE </th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($account as $student)
                        <tr class="tr">
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
                {{ $account->links() }}
            </div>
        </div>
    </div>
@endsection