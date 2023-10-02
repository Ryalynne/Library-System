@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-success">DAILY OR MONTHLY STATISTIC OF BORROWED</h1>


      
       
        <form id="dateForm" action="/statistic-summary" method="GET" class="mb-3">
            <input type="date" name="startingdate" value="{{ request('startingdate', now()->format('Y-m-d')) }}">
            <input type="date" name="enddate" value="{{ request('enddate', now()->format('Y-m-d')) }}">
            <input type="submit" value="FILTER">
        </form>
     
        <form action="/generate-statistic" method="get">
            <button type="submit" class="btn btn-success mb-3">PRINT</button>
            <input type="date" name="startingdate" value="{{ request('startingdate', now()->format('Y-m-d')) }}" hidden>
            <input type="date" name="enddate" value="{{ request('enddate', now()->format('Y-m-d')) }}" hidden>
        </form>

        <table class="table table-bordered border-dark myTable mt-2">
            <thead>
                <tr class="bg-success text-white">
                    <th>DATE</th>
                    <th>DAY</th>
                    <th>BORROWED COUNT</th>
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
                <tr class="bg-danger text-white">
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
        <h1 class="text-success">DAILY OR MONTHLY STATISTIC OF RETURNED</h1>
        <form action="/generate-statisticR" method="get">
            <button type="submit" class="btn btn-success mb-3">PRINT</button>
            <input type="date" name="startingdate" value="{{ request('startingdate', now()->format('Y-m-d')) }}" hidden>
            <input type="date" name="enddate" value="{{ request('enddate', now()->format('Y-m-d')) }}" hidden>
        </form>
        <table class="table table-bordered border-dark myTable">
            <thead>
                <tr class="bg-success text-white">
                    <th>DATE</th>
                    <th>DAY</th>
                    <th>RETURNED COUNT</th>
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
                <tr class="bg-danger text-white">
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
