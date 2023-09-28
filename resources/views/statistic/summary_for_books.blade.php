@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-success">MONTHLY STATISTIC OF BORROWED</h1>
        <button type="button" class="btn btn-success mb-3">PRINT</button>
        <table class="table table-bordered border-dark myTable">
            <thead>
                <tr class="bg-success text-white">
                    <th>DATE</th>
                    <th>DAY</th>
                    <th>COUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($onlendCounts as $date => $count)
                    <tr>
                        <td>{{ $date }}</td>
                        <td>{{ \Carbon\Carbon::parse($date)->format('l') }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
                <tr class="bg-primary text-white">
                    <td colspan="2">Total:</td>
                    <td>
                        @php
                            $totalCount = 0;
                            echo array_sum($onlendCounts) - $totalCount;
                        @endphp
                    </td>
                </tr>

            </tbody>
        </table>
        <hr>
        <h1 class="text-success">MONTHLY STATISTIC OF RETURNED</h1>
        <button type="button" class="btn btn-success mb-3">PRINT</button>
        <table class="table table-bordered border-dark myTable">
            <thead>
                <tr class="bg-success text-white">
                    <th>DATE</th>
                    <th>DAY</th>
                    <th>COUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($returnedCounts as $date => $count)
                    <tr>
                        <td>{{ $date }}</td>
                        <td>{{ \Carbon\Carbon::parse($date)->format('l') }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
                <tr class="bg-primary text-white">
                <td colspan="2">Total:</td>
                <td>
                    @php
                        $totalCount = 0;
                        echo array_sum($returnedCounts) - $totalCount;
                    @endphp
                </td>
                </tr>
            </tbody>
        </table>

    </div>
@endsection
