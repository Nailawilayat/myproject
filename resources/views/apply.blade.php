@include('layouts.header')

@if(session('error'))
<div class="alert alert-danger text-center">
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<section class="login-section">
    <div class="container">

        <h2 class="register-title">Register & Apply</h2>

        <div class="login-box">

            <h2 class="login-heading">
                Login with your site account
            </h2>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <input
                    type="email"
                    name="email"
                    class="login-input"
                    placeholder="Username"
                    required>

                <input
                    type="password"
                    name="password"
                    class="login-input"
                    placeholder="Password"
                    required>

                <div class="login-options">

                    <label>
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>

                    <a href="#">
                        Lost your password?
                    </a>

                </div>

                <button class="login-btn" type="submit">
                    LOGIN
                </button>

                <p class="register-link">
                    Not a member yet?

                    <a href="{{ route('register') }}">
                        Register now
                    </a>
                </p>

            </form>

        </div>

    </div>
</section>

@include('layouts.footer')