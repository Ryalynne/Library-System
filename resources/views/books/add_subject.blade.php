@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="add/subject" method="POST">
            @csrf
            <div class="form-group mt-5 mb-3">
                <label for="vendorName">SUBJECT:</label>
                <input type="text" class="form-control" name="subject">
            </div>
            <button type="submit" class="btn btn-success mb-3">Create</button>
        </form>

        <table class="table table-bordered border-dark myTable">
            <thead>
                <tr class="bg-success text-white">
                    <th class="text-center">DEPARTMENT</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($paginator as $sub)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                    <td>{{$sub}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="15" class="text-center text-size-15px"><b>NO BOOK FOUND</b></td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $paginator->links()}}
    </div>
@endsection
