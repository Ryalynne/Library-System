@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="mt-5">
            <button type="button" class="btn btn-success bg-success border-success mx-2 rounded" data-bs-toggle="modal"
                data-bs-target="#modal_import">
                IMPORT E-BOOKS
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered border-dark myTable mt-3">
                <thead>
                    <tr class="bg-success text-white">
                        <th>TITLE</th>
                        <th>AUTHOR</th>
                        <th>COPYTRIGHT</th>
                        <th>LINKS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>
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
                            <form action="/importEbooks" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                                <button type="submit">Import</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
