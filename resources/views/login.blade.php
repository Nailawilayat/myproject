@include('layouts.header')

@if(session('error'))
    <div class="alert alert-danger text-center login-alert">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success text-center login-alert">
        {{ session('success') }}
    </div>
@endif


<section class="login-section">

    <div class="container">

        <h2 class="register-title">
            Register & Apply
        </h2>

        <div class="login-box">

            <h2 class="login-heading">
                Login with your site account
            </h2>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                {{-- EMAIL --}}
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="login-input"
                    placeholder="Username"
                    required>

                @error('email')
                    <small class="text-danger d-block text-start mb-2">
                        {{ $message }}
                    </small>
                @enderror


                {{-- PASSWORD --}}
                <input
                    type="password"
                    name="password"
                    class="login-input"
                    placeholder="Password"
                    required>

                @error('password')
                    <small class="text-danger d-block text-start mb-2">
                        {{ $message }}
                    </small>
                @enderror


                {{-- LOGIN OPTIONS --}}
                <div class="login-options">

                    <label>
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>

                </div>


                {{-- LOGIN BUTTON --}}
                <button
                    class="login-btn"
                    type="submit">

                    LOGIN

                </button>


                {{-- REGISTER LINK --}}
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