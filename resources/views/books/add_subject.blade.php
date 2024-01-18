@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex mb-1">
            <div class="row justify-content-start">
                <div class="col-md-6">
                    <form action="add/subject" method="POST" class="mb-3">
                        @csrf
                        <label for="vendorName">DEPARTMENT:</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="subject">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-success bg-success border-success mx-1 rounded"
                            data-bs-toggle="modal" data-bs-target="#modal_import">
                            Import Subject
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_import" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">IMPORT EXCEL FILE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-file">
                            <form action="/subjectImport" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                <button type="submit">Import</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered border-dark myTable">
            <thead>
                <tr class="bg-success text-white">
                    <th class="text-center">DEPARTMENT</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subject as $sub)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 tr">
                        <td>{{ $sub->subjectName }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15" class="text-center text-size-15px"><b>NO BOOK FOUND</b></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $subject->links() }}
    </div>
@endsection
