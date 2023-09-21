<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'BMA Library System') }}
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('build/assets/app-67dcdfd2.css') }}">
    <script src="{{ asset('build/assets/app-1e58d95a.js') }}"></script>

    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

</head>

<body class="d-flex flex-column min-vh-100">
    <div id="app" class="sticky-top ">
        <nav class="navbar navbar-expand-md navbar-light bg-success">
            <div class="container-fluid">

                <a class="navbar-brand text-white" href="{{ url('/home') }}">
                    <img src="image/bmalogo.png" width="35" alt="" class="d-inline-block align-middle mr-2">
                    BMA LIBRARY
                </a>

                <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Left Side Of Navbar /if-else ng login-->
                @guest
                    @if (Route::has('login'))
                    @endif
                @else
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="home">Dashboard</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link text-white">|</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Books Management
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="booklist">Physical Books List</a>
                                    <hr>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="ebook">E-Books List</a>
                                    <hr>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="bookadjustment">Physical Books
                                        Adjustment</a>
                                    <hr>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="borrowpage">Borrow Book</a>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="returnpage">Return Book</a>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="fined">Damage / Lost
                                        Book</a>
                                    <hr>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="department">Add Department</a>

                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="subject">Add Subject</a>


                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link text-white">|</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Books History
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="bookhistory">Books Action
                                        History</a>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="adjustmenthistory">Adjustment
                                        History</a>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="onlendhistory">Onlend History</a>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="returnhistory">Returned
                                        History</a>
                                    <!-- {{-- finehistory --}} -->
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="finedhistory">Book Lost / Damage
                                        History</a>
                                    <hr>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="archivedhistory">Books
                                        Archived</a>
                                </div>
                            </li>

                            <li class="nav-item active">
                                <a class="nav-link text-white">|</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Requisition
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="vendormanagement">Vendor
                                        Management</a>
                                    <hr>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="purchase">Purchase Order</a>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="purchasepending">Pending
                                        Order</a>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="receivepurchaseorder">Receive
                                        Order</a>
                                    <hr>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="backorder">Back Order</a>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="badorder">Bad Order</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link text-white">|</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Requisition History
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="receivehistory">Receive
                                        History</a>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="cancelhistory">Cancel History</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link text-white">|</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Statistic Report
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="receivehistory">Summary of Statistics</a>
                                    <a class="dropdown-item dropdown-active-success"
                                        onclick="this.style.backgroundColor='#198754'"
                                        onmouseover="this.style.backgroundColor='#198754'"
                                        onmouseout="this.style.backgroundColor=''" href="cancelhistory">Summary of E-book Statistics</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link text-white">|</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="account">Student List</a>
                            </li>
                    </div>
                @endguest
                <ul class="navbar-nav ms-auto">
                    @guest
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <!-- {{-- name ng profile --}} -->

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <!-- {{-- dropdownlist --}} -->
                                <a class="dropdown-item dropdown-active-success "
                                    onclick="this.style.backgroundColor='#198754'"
                                    onmouseover="this.style.backgroundColor='#198754'"
                                    onmouseout="this.style.backgroundColor=''" href="setting">Settings</a>

                                <a class="dropdown-item dropdown-active-success"
                                    onmouseover="this.style.backgroundColor='#198754'"
                                    onmouseout="this.style.backgroundColor=''" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none  text-white">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
    </div>
    </nav>
    <main>
        @yield('content')
    </main>
    </div>
</body>

@guest
    @if (Route::has('login'))
    @endif
@else
    <footer class="mt-auto flex-shrink-0 py-3 bg-success text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; BALIWAG MARITIME ACADEMY</small>
        </div>
    </footer>
@endguest

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
@livewireScripts
<script>
    $('.edit-button').on('click', function() {
        var id = $(this).data('id');
        $.get("/copy/" + id, function(data, status) {
            $('.modal-copy-copies').val(data.copy)
        });
    });

    $(document).ready(function() {
        $(".myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".myTable .tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $('.edit-button').on('click', function() {
        var id = $(this).data('id');
        $.get("/book/" + id, function(data, status) {
            $('.modal-book-id').val(id);
            $('.modal-book-title').val(data.book.title);
            $('.modal-book-author').val(data.book.author);
            $('.modal-book-categories').val(data.book.categories);
            $('.modal-book-copyright').val(data.book.copyright);
            $('.modal-book-accession').val(data.book.accession);
            $('.modal-book-callnumber').val(data.book.callnumber);
            $('.modal-book-subject').val(data.book.subject);
        });
    });
</script>

@yield('script')


<style>
    .myInput:focus {
        border-color: 0 0 0 0.2rem rgba(5, 158, 0, 0.25);
        box-shadow: 0 0 0 0.2rem rgba(5, 158, 0, 0.25);
    }

    .dropdown-item.dropdown-active-success:hover,
    .dropdown-item.dropdown-active-success:focus,
    .dropdown-item.dropdown-active-success.active {
        color: rgb(255, 255, 255);
    }
</style>

</html>
