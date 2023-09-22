@extends('layouts.app')

@section('content')
    <div class="card text-center border border-success">
    </div>
    <br>
    <div class="container">
        <div class="row align-items-start">
            <div class="col">
                <div class="card">
                    <div class="card-body bg-success text-white">
                        <h2>Pending Order</h2>
                    </div>
                </div>
                <div class="p-2 w-25">
                    <div class="input-group">
                        <input type="search" class="form-control rounded myInput" placeholder="Search Here..."
                            aria-label="Search" aria-describedby="search-addon" />
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered myTable">
                    <thead>
                        <tr class="bg-success text-white">
                            <th scope="col">Transaction</th>
                            <th scope="col">Vendor Name</th>
                            <th scope="col">Date of Order</th>
                            <th scope="col">Date of Delivery</th>
                            <th scope="col">Status</th>
                            <th scope="col">Requested By</th>
                            <th scope="col">Department</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    @foreach ($Order as $item)
                        <tbody>
                            <tr class="tr">
                                <td>{{ $item->transaction }}</td>
                                <td>{{ $item->getVendorName($item->vendorid) }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->dateofdelivery }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->requestedby }}</td>
                                <td>{{ $item->department }}</td>
                                <td class="text-center"><button type="button" class="btn btn-danger btn-sm remove-book"
                                        data-bs-toggle="modal" data-bs-target="#cancelOrderModal"
                                       >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#redirect" data-transaction="{{ $item->transaction }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            <br>
            <div class="pagination justify-content-center">
                {{ $Order->links() }}
            </div>
            <br>
        </div>
    </div>
    </div>


    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true"
        data-order_id="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelOrderModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel this order?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Exit</button>
                    <button type="button" class="btn btn-danger removenow">Cancel
                        Order</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="redirect" tabindex="-1" aria-labelledby="backdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backdropLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to redirect to this order?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    <a id="redirect-link" href="#" class="btn btn-success">Go to Order</a>
                </div>
            </div>
        </div>
    </div>






@section('script')
    <script>
        $(".printbtn").on('click', function() {
            const frame = $('#table-frame')
            const link = '/generate-tblonlend'
            frame.attr('src', link)
        });


        $('#redirect').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var transaction = button.data('transaction'); // Extract transaction from data-* attributes
            var redirectLink = $('#redirect-link'); // "Go to Order" link

            // Set the href attribute of the link to the appropriate URL
            redirectLink.attr('href', '/receivepurchaseorder?transaction=' + transaction);
        });


        $('.remove-book').on('click', function() {
            var id = $(this).data('id');
            $.get("/gettransaction/" + id, function(data, status) {
                if (data.transaction && data.transaction.id == id) {

                } else {
                
                }
            });
        });

        var transaction = "";

        $('.removenow').on('click', function() {
            var id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/cancelOrder/" + id,
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
@endsection
