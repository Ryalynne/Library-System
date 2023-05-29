@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Receive Backorder Order</h2>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="purchase_order_number" class="form-label"><strong>Transaction: </strong></label>
                    <input type="text" class="form-control w-50 transaction" name="transaction"
                        value="{{ request()->input('transaction') ? $transaction->transaction : '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="purchase_order_number" class="form-label"><strong>Vendor Name: </strong></label>
                    <input type="text" class="form-control w-50"
                        value="{{ request()->input('transaction') ? $transaction->getVendorName($transaction->vendorid) : ' ' }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="purchase_order_number" class="form-label"><strong>Vendor Contact: </strong></label>
                    <input type="text" class="form-control w-50 "
                        value="{{ request()->input('transaction') ? $transaction->getVendorContact($transaction->vendorid) : ' ' }}"
                        disabled>
                </div>
                <div class="mb-3">
                    <label for="purchase_order_number" class="form-label"><strong>Requested By: </strong></label>
                    <input type="text" class="form-control w-50"
                        value="{{ request()->input('transaction') ? $transaction->requestedby : ' ' }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="purchase_order_number" class="form-label"><strong>Department: </strong></label>
                    <input type="text" class="form-control w-50"
                        value="{{ request()->input('transaction') ? $transaction->department : ' ' }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="purchase_order_number" class="form-label"><strong>Date Order: </strong></label>
                            <input type="text" class="form-control"
                                value="{{ request()->input('transaction') ? $transaction->created_at : ' ' }}" disabled>
                        </div>
                        <div class="col">
                            <label for="purchase_order_number" class="form-label"><strong>Date Delivery: </strong></label>
                            <input type="text" class="form-control"
                                value="{{ request()->input('transaction') ? $transaction->dateofdelivery : ' ' }}" disabled>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered myTable">
                    <thead>
                        <tr class="bg-success text-white">
                            <th>CODE ID</th>
                            <th>TITLE</th>
                            <th>Quantity Receive</th>
                            <th>Quantity Backorder</th>
                            <th>Quantity Order</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order as $book)
                            <tr data-book-id="{{ $book->id }}">
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td contenteditable="true" oninput="updateTotal(this)">0</td>
                                <td>{{ $book->quantity - $book->received }}</td>
                                <td>{{ $book->quantity }}</td>
                                <td>{{ $book->unitprice }}</td>
                                <td>₱0.00</td>
                                <td> <button type="button" class="btn btn-danger btn-sm remove-book" data-bs-toggle="modal"
                                        data-bs-target="#backdrop"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                            height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                        </svg>
                                    </button></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">ENTER TRANSACTION REFERENCE FIRST.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6" class="text-right">Total Amount:</th>
                            <th id="grandTotal">₱0.00</th>
                        </tr>
                    </tfoot>
                </table>

                <div class="text-end">
                    <button type="submit" class="btn btn-success w-50 btn-lg purchase" id="receiveOrderButton"
                        data-bs-toggle="modal" data-bs-target="#tablemodal">RECEIVE ORDER</button>

                </div>

            </div>
        </div>
    </div>
    <br>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // ... your existing code ...
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Handle click event on the "RECEIVE ORDER" button
            $('#receiveOrderButton').on('click', function() {
                // Loop through each row in the table
                $('.myTable tbody tr').each(function() {
                    // ... your existing code ...
                    var row = $(this);
                    var receivedQuantity = parseInt(row.find('td:nth-child(3)').text());
                    var bookId = row.attr('data-book-id');

                    // Send an AJAX request to update the received quantity
                    $.ajax({
                        url: '/update-received-quantityB/' + bookId,
                        type: 'PUT',
                        data: {
                            receivedQuantity: receivedQuantity
                        },
                        success: function(response) {
                            alert('Success update quantity');
                            document.location.href = "backorder";
                        },
                        error: function(xhr) {
                            alert('Error updating quantity');
                        }
                    });
                });
            });
        });

        function updateTotal(element) {
            var receivedQuantity = parseInt(element.innerText);
            var unitPrice = parseFloat(element.nextElementSibling.nextElementSibling.nextElementSibling.innerText);
            var orderQuantity = parseInt(element.nextElementSibling.innerText);
            var totalPriceElement = element.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling;

            if (isNaN(receivedQuantity) || receivedQuantity < 0 || receivedQuantity > orderQuantity) {
                element.innerText = "0";
                totalPriceElement.innerText = "₱0.00";
                alert("Invalid quantity entered. Please enter a valid value.");
                return;
            }

            var totalPrice = receivedQuantity * unitPrice;
            element.innerText = receivedQuantity;
            totalPriceElement.innerText = "₱" + totalPrice.toFixed(2);

            calculateGrandTotal();

        }

        function calculateGrandTotal() {
            var totalAmount = 0;
            var totalElements = document.querySelectorAll('.myTable tbody tr');
            totalElements.forEach(function(row) {
                var totalPriceElement = row.querySelector('td:nth-child(6)');
                var totalPrice = parseFloat(totalPriceElement.innerText.replace('₱', ''));
                totalAmount += totalPrice;
            });

            var grandTotalElement = document.getElementById('grandTotal');
            grandTotalElement.innerText = "₱" + totalAmount.toFixed(2);
        }


        $('.transaction').on('keyup', function(event) {
            if (event.keyCode === 13) {
                var id = $(this).val().trim().toLowerCase();
                if (id === "") {
                    document.location.href = "backorder";
                } else {
                    validateStudent(id);
                }
            }
        });


        function validateStudent(id) {
            $.get("/transactionB/" + id, function(data, status) {
                if (data && data.transaction.transaction === id) {
                    document.location.href = "backorder?transaction=" + id;
                } else {
                    alert('No transaction found: ' + id);
                    document.location.href = "backorder";
                }
            }).fail(function() {
                alert('Error occurred while fetching student information.');
                document.location.href = "backorder";
            });
        }
        
    </script>
@endsection
