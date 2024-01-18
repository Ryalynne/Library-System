@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Generate Bad Order</h2>
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
                            <th hidden>CODE ID</th>
                            <th>TITLE</th>
                            <th>Quantity Receive</th>

                            <th>Quantity Order</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order as $book)
                            <tr data-book-id="{{ $book->id }}">
                                <td hidden>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td contenteditable="true" oninput="updateTotal(this)">0</td>
                                <td>{{ $book->quantity - $book->received }}</td>
                                <td>{{ $book->unitprice }}</td>
                                <td>₱0.00</td>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input getid"
                                            id="checkbox-{{ $book->id }}" data-id="{{ $book->id }}">
                                        <label class="form-check-label" for="checkbox-{{ $book->id }}">Include</label>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">ENTER TRANSACTION REFERENCE FIRST.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-right">Total Amount:</th>
                            <th id="grandTotal">₱0.00</th>
                        </tr>
                    </tfoot>
                </table>

                <div class="text-end">
                    <button type="submit" class="btn btn-success w-50 btn-lg badorder" id="receiveOrderButton"
                        data-bs-toggle="modal" data-bs-target="#tablemodal">GENERATE BAD ORDER</button>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="modal fade" id="tablemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">PRINT RETURN</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <embed id="table-frame" src="" frameborder="0" width="100%" height="100%">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const bookid = [];
        const quantity = [];

        $(".badorder").on('click', function() {
            const frame = $('#table-frame')
            const link = '/generate-badorder/' + JSON.stringify(bookid) + '/' + JSON.stringify(quantity);
            frame.attr('src', link)
            bookid.splice(0, bookid.length);
            $('.getid').prop('checked', false);
            alert('successfully Printed');
        });

        $('.getid').on('click', function() {
            var id = $(this).data('id');
            let check = $('#checkbox-' + id).is(':checked');
            let receivedQuantityElement = $(this).closest('tr').find('td:nth-child(3)');
            let receivedQuantity = parseInt(receivedQuantityElement.text());

            if (check) {
                if (receivedQuantity === 0) {
                    $(this).prop('checked', false);
                    alert("Received quantity must be greater than 0 to include the book.");
                } else {
                    bookid.push(id);
                    quantity.push(receivedQuantity);
                    console.log(bookid);
                    console.log(quantity);
                }
            } else {
                let index = bookid.indexOf(id);
                bookid.splice(index, 1);
                quantity.splice(index, 1);
                receivedQuantityElement.text("0");
                console.log(bookid);
                console.log(quantity);
            }
        });

        function updateTotal(element) {
            var receivedQuantity = parseInt(element.innerText);
            var unitPrice = parseFloat(element.nextElementSibling.nextElementSibling.innerText);
            var orderQuantity = parseInt(element.nextElementSibling.innerText);
            var totalPriceElement = element.nextElementSibling.nextElementSibling.nextElementSibling;

            if (isNaN(receivedQuantity) || receivedQuantity < 0 || receivedQuantity > orderQuantity) {
                element.innerText = "0";
                totalPriceElement.innerText = "₱0.00";
                alert("Invalid quantity entered. Please enter a valid value.");
                calculateGrandTotal();
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
                    document.location.href = "badorder";
                } else {
                    validateStudent(id);
                }
            }
        });

        function validateStudent(id) {
            $.get("/transactionBO/" + id, function(data, status) {
                if (data && data.transaction.transaction === id) {
                    document.location.href = "badorder?transaction=" + id;
                } else {
                    alert('No transaction found: ' + id);
                    document.location.href = "badorder";
                }
            }).fail(function() {
                alert('Error occurred while fetching student information.');
                document.location.href = "badorder";
            });
        }
    </script>
@endsection
