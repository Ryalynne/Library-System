@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Vendor Management</h2>
        <hr>
        <h4>Create Vendor</h4>
        <form action="{{ route('vendor.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="vendorName">Vendor Name:</label>
                <input type="text" class="form-control" id="vendorName" name="vendorName">
                @error('vendorName')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="vendorContact">Vendor Contact:</label>
                <input type="text" class="form-control" id="vendorContact" name="vendorContact">
            </div>
            @error('vendorContact')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br><br>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
        <br>
        <hr>
        <h4>Vendor List</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vendor Name</th>
                    <th>Vendor Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendor as $vendorlist)
                    <tr>
                        <td>{{ $vendorlist->id }}</td>
                        <td>{{ $vendorlist->vendorname }}</td>
                        <td>{{ $vendorlist->vendorcontact }}</td>
                        <td>
                            <button class="btn btn-sm btn-success edit-button-vendor" data-toggle="modal"
                                data-target="#editModal" data-id={{ $vendorlist->id }}>Edit</button>
                            <button type="button" class="btn btn-danger btn-sm remove-book" data-bs-toggle="modal"
                                data-bs-target="#backdrop" data-id={{ $vendorlist->id }}>delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>

        <div class="modal fade" id="backdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="titleofbook"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this vendor? This action cannot be undone and the vendor's data will
                        be permanently removed from the system.
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger removenow" id="remove">Delete</button>
                        <p id="myParagraph"></p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">UPDATE VENDOR</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="modal-name">Name:</label>
                                <input type="text" class="form-control modal-name" id="modal-name">
                            </div>
                            <div class="form-group">
                                <label for="modal-contact">Contact:</label>
                                <input type="text" class="form-control modal-contact" id="modal-contact">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Update</button>
                        <p id="myParagraph"></p>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $('.edit-button-vendor').on('click', function() {
                var id = $(this).data('id');
                $.get("/vendor/" + id, function(data, status) {
                    $('.modal-name').val(data.vendorname);
                    $('.modal-contact').val(data.vendorcontact);
                    $('#editModal').modal('show');
                });
            });

            var vendorid = "";
            $('.remove-book').on('click', function() {
                var id = $(this).data('id');
                $.get("/vendor/" + id, function(data, status) {
                    document.getElementById("titleofbook").innerHTML = data.vendorname;
                    vendorid = id;
                });
            });

            $('.removenow').on('click', function() {
                var id = vendorid;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/removevendor/" + id,
                    data: {
                        _method: "POST"
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        </script>
    @endsection
