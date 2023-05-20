@extends('layouts.app')

@section('content')
    <div class="container">

        <section class="vh-50">
            <div class="container py-5 h-50">
                <br><br><br>
                <div class="row d-flex align-items-center justify-content-center h-100">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <img src="image/home.png" class="img-fluid" alt="Phone image">
                    </div>
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        <br>
                        <form method="POST" action="{{ route('login') }}" id="login-form">
                            @csrf

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label class="form-label" for="form1Example13">Email address</label>
                            </div>


                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password"> @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <label class="form-label" for="form1Example13">Password</label>
                            </div>

                            <div class="d-flex justify-content-around align-items-center mb-4">
                                <!-- Checkbox -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="remember"
                                        name="remember" />
                                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link link-success" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-success btn-lg btn-block w-100">Log in</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>

@section('script')
    <script>
        // Retrieve the form and input elements
        const loginForm = document.getElementById('login-form');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const rememberCheckbox = document.getElementById('remember');

        // Check if the email and password were previously saved
        const savedEmail = localStorage.getItem('savedEmail');
        const savedPassword = localStorage.getItem('savedPassword');
        const rememberMe = localStorage.getItem('rememberMe') === 'true';

        // Set the email and password inputs' values
        emailInput.value = savedEmail || '';
        passwordInput.value = savedPassword || '';
        rememberCheckbox.checked = rememberMe;

        // Add an event listener to the form submission
        loginForm.addEventListener('submit', function(event) {
            // Check if the "Remember Me" checkbox is selected
            const rememberValue = rememberCheckbox.checked;

            // Save the email and password values if the "Remember Me" checkbox is selected
            if (rememberValue) {
                localStorage.setItem('savedEmail', emailInput.value);
                localStorage.setItem('savedPassword', passwordInput.value);
            } else {
                localStorage.removeItem('savedEmail');
                localStorage.removeItem('savedPassword');
            }

            // Store the "Remember Me" checkbox state in local storage
            localStorage.setItem('rememberMe', rememberValue);

            // Proceed with form submission
            // ...
        });
    </script>
@endsection
@endsection
