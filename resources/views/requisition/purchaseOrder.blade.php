@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h2>Manage Purchase Order</h2>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <form action="">
                    <p><strong>Vendor ID:</strong>
                    <div class="mb-3">
                        <input type="text" class="form-control w-50 getventor" name="vendor" :value="old('vendor')"
                            value="{{ request()->input('vendor') ? ($vendor ? $vendor->id : '') : '' }}">
                        <div class="form-text">Enter the vendor id.</div>
                    </div>
                </form>
                <p><strong>Vendor Name:</strong>
                    <input type="text" class="form-control w-50" name="vendorname"
                        value="{{ request()->input('vendor') ? ($vendor ? $vendor->vendorname : '') : '' }}" disabled>
                    <br>
                <p><strong>Vendor Contact:</strong>
                    <input type="text" class="form-control w-50" name="vendorcontact"
                        value="{{ request()->input('vendor') ? ($vendor ? $vendor->vendorcontact : '') : '' }}" disabled>
                    <br>
                <p>
                    <strong>Requested By:</strong>
                    <input type="text" class="form-control w-50" id="requestor" aria-describedby="text"
                        name="requestedBY">
                </p>
                <div id="text" class="form-text">Enter the name of the requestor.</div>
                <br>
                <p><strong>Department:</strong> <input type="text" class="form-control w-50" aria-describedby="text"
                        id="department"></p>
                <div id="text" class="form-text">Enter the designated department of requestor.</div>
                <br>

            </div>
            <div class="col-md-6">
                <h4>Order Deatails:</h4>
                <table class="table table-bordered myTable">
                    <thead>
                        <tr class="bg-success text-white">
                            <th hidden>CODE ID</th>
                            <th>TITLE</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$vendor && request()->input('vendor'))
                            <span class="badge bg-danger w-100">No Vendor Found.</span>
                        @else
                            @php
                                $startingId = DB::table('purchasemodels')->max('id') + 1;
                                $key = $startingId;
                            @endphp
                            <tr>
                                <td class="id" hidden></td>
                                <td contenteditable="true" class="title"></td>
                                <td contenteditable="true" class="quantity">0</td>
                                <td contenteditable="true" class="unitPrice">0.00</td>
                                <td class="total">₱0</td>
                                <td><button class="btn btn-danger btn-sm delete-row">Delete</button></td>
                            </tr>
                        @endif

                        @if (!$vendor)
                            <tr>
                                <td colspan="6" class="text-center">ENTER VENDOR ID FIRST</td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Total Amount:</th>
                            <th id="grandTotal">₱0</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="text-end">
                    <button type="submit" class="btn btn-success w-50 btn-lg purchase" data-bs-toggle="modal"
                        data-bs-target="#tablemodal" data-vendor="{{ $vendor ? $vendor->id : '' }}"
                        data-token="{{ csrf_token() }}">PURCHASE ORDER</button>
                </div>
            </div>
        </div>
        <h4>Delivery Address</h4>
        <p>Km 54. Cagayan Valley Road Sampaloc San Rafael, Bulacan</p>
        <br>
        <h4>Date of Delivery</h4>
        <input type="date" class="form-control w-25" id="dateofdelivery">
        <div class="form-text">Set the date of delivery.</div>
        <br>
        <hr>
    </div>

    <br>
    <br>

    <div class="modal fade" id="tablemodal" onClick="self.location.reload();" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">PURCHASE ORDER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed id="table-frame" src="" frameborder="0" width="100%" height="100%">
                </div>
            </div>
        </div>
    </div>
    <style>
        .myTable {
            max-width: 600px;
            /* Adjust the value to your desired width */
            width: 100%;
            table-layout: fixed;
        }

        .myTable td {
            word-break: break-word;
        }
    </style>
@section('script')
    <script>
        // Get the current date
        var currentDate = new Date();

        // Format the date as YYYY-MM-DD
        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);
        var formattedDate = year + '-' + month + '-' + day;

        // Set the value of the date input to the current date
        document.getElementById('dateofdelivery').value = formattedDate;


        const id = [];
        const title = [];
        const quantity = [];
        const unitprice = [];

        $(".purchase").on('click', function() {
            let vendorID = $(this).data('vendor');
            let token = $(this).data('token');
            let requestedBY = $("#requestor").val();
            let dateofdelivery = $("#dateofdelivery").val();
            let department = $("#department").val();

            $("table tr").each(function() {
                // const title = $(this).find(".title").text().trim();
                const idd = $(this).find(".id").text().trim();
                const booktitle = $(this).find(".title").text().trim();
                const qty = parseInt($(this).find(".quantity").text().trim());
                const price = parseFloat($(this).find(".unitPrice").text().trim());

                // Add the values to the respective arrays
                id.push(idd);
                title.push(booktitle);
                quantity.push(qty);
                unitprice.push(price);

            });

            const formData = new FormData();
            formData.append('vendorID', vendorID);
            formData.append('title', title);
            formData.append('quantity', quantity);
            formData.append('unitprice', unitprice);
            formData.append('_token', token);

            if (title.length == 0) {
                alert('You need to add a book to the table to borrow!');
            } else {
                $.post('/create/purchase', {
                    'vendorID': vendorID,
                    'requestedBY': requestedBY, // Add this line if you have requestedBY field
                    'department': department, // Add this line if you have department field
                    'dateofdelivery': dateofdelivery, // Add this line if you have dateofdelivery field
                    'booktitle': title,
                    'quantity': quantity,
                    'unitprice': unitprice,
                    '_token': token
                }, function(response) {
                    console.log(response);
                })

                const frame = $('#table-frame')
                const link = '/generatepuchaseorder/' + JSON.stringify(id) + '/' + vendorID
                frame.attr('src', link)
            }
        });



        // function validateVendor(id) {
        //     $.get("/vendor/" + id, function(data, status) {
        //         if (data && data.id && data.id == id) {
        //             document.location.href = "purchase?vendor=" + id;
        //         } else {
        //             alert('No vendor found with ID: ' + id);
        //             document.location.href = "purchase";
        //         }
        //     }).fail(function() {
        //         alert('Error occurred while fetching vendor information.');
        //         document.location.href = "purchase";
        //     });
        // }

        // $('.getventor').on('keyup', function(event) {
        //     if (event.keyCode === 13) {
        //         var id = $(this).val().trim().toLowerCase();
        //         if (id === "") {
        //             $('.vendorname').val("");
        //             $('.vendorcontact').val("");
        //             document.location.href = "purchase";
        //         } else {
        //             validateVendor(id);
        //         }
        //     }
        // });

        var startingId = <?php $maxId = DB::table('purchasemodels')->max('id');
        echo is_numeric($maxId) ? $maxId : 0; ?>;

        $(document).ready(function() {
            var isEditing = false; // Flag to track if editing is in progress

            function updateTotalPrice() {
                var count = startingId; // Start counting from the retrieved value

                $('tr').each(function() {
                    if (!$(this).hasClass('existing')) { // Skip rows with existing IDs
                        $(this).find('.id').text(count++);
                    }
                    var quantity = parseFloat($(this).find('.quantity').text());
                    var unitPrice = parseFloat($(this).find('.unitPrice').text().replace('₱', ''));
                    var total = (isNaN(quantity) || isNaN(unitPrice)) ? 0 : (quantity * unitPrice);
                    $(this).find('.total').text('₱' + total.toFixed(2));
                });

                // Calculate and update grand total
                var grandTotal = 0;
                $('.total').each(function() {
                    grandTotal += parseFloat($(this).text().replace('₱', ''));
                });
                $('#grandTotal').text('₱' + grandTotal.toFixed(2));
            }

            // Retrieve the maximum ID value from the database


            // Update total price when quantity or unit price changes
            $(document).on('input', '.quantity, .unitPrice', updateTotalPrice);

            $(document).on('input', '.title', function() {
                var $row = $(this).closest('tr');
                if (!$row.next().length && $(this).text().trim() !== '') {
                    var $newRow = $row.clone();
                    $newRow.find('.title').text('');
                    $newRow.find('.quantity').text('0');
                    $newRow.find('.unitPrice').text('0.00');
                    $newRow.find('.total').text('₱0');
                    $row.after($newRow);
                    updateTotalPrice();
                }
            });

            // Handle keydown event to require ENTER key press to stop editing
            $(document).on('keydown', '.title, .quantity, .unitPrice', function(e) {
                if (e.keyCode === 13) { // ENTER key
                    e.preventDefault();
                    $(this).blur();
                }
            });

            // Handle focus event to enable editing and set isEditing flag
            $(document).on('focus', '.title, .quantity, .unitPrice', function() {
                isEditing = true;
            });

            // Handle blur event to end editing
            $(document).on('blur', '.title, .quantity, .unitPrice', function() {
                if (isEditing) {
                    isEditing = false;
                    $(this).closest('tr').removeClass('editing');
                }
            });

            // Prevent edit from ending when hovering over elements
            $(document).on('mouseenter', 'tr', function() {
                if (isEditing) {
                    $(this).addClass('editing');
                }
            });

            $(document).on('mouseleave', 'tr', function() {
                if (isEditing) {
                    $(this).removeClass('editing');
                }
            });

            $(document).on('click', '.delete-row', function() {
                var $row = $(this).closest('tr');

                if ($row.hasClass('existing')) {
                    // Existing rows can be deleted
                    if ($row.siblings('.existing').length) {
                        $row.remove();
                        updateTotalPrice();
                    }
                } else {
                    // Blank rows should not be deleted
                    var $existingRows = $row.siblings('.existing');

                    if ($existingRows.length || $row.find('.title').text().trim() !== '') {
                        $row.remove();
                        updateTotalPrice();
                    } else {
                        $row.find('.title').text('');
                        $row.find('.quantity').text('0');
                        $row.find('.unitPrice').text('0.00');
                        $row.find('.total').text('₱0.00');
                    }
                }
            });

            updateTotalPrice();
        });
    </script>
@endsection
@endsection
