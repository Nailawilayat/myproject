@include('layouts.header')

{{-- PAGE HEADER --}}
<section class="page-header">
    <div class="page-overlay"></div>

    <div class="container position-relative">

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-wrap">
            <a href="{{ url('/') }}">Home</a>
            <span> &gt; </span>
            <a href="{{ url('/register') }}">Register</a>
        </div>

        {{-- TITLE --}}
        <h1 class="page-title">REGISTER</h1>

    </div>
</section>


{{-- REGISTER PAGE HEADER --}}
<section class="register-header-bar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <h4 class="register-header-title">Register & Apply</h4>
            </div>
        </div>
    </div>
</section>


{{-- REGISTER / STUDENT FORM --}}
<section class="register-form-section">

    <div class="container">

        {{-- FULL WIDTH FORM --}}
        <div class="row justify-content-center">

            <div class="col-12 col-lg-9">

                <div class="form-card">

                    <h4 class="mb-4 fw-bold text-center">
                        Student Information
                    </h4>


                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf


                        {{-- FULL NAME --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Full Name</label>
                            </div>

                            <div class="col-md-8">

                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="form-control"
                                       placeholder="Enter full name">

                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- EMAIL --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Email Address</label>
                            </div>

                            <div class="col-md-8">

                                <input type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-control"
                                       placeholder="Enter email">

                                @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- PASSWORD --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Password</label>
                            </div>

                            <div class="col-md-8">

                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Min 6 characters">

                                @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- CONFIRM PASSWORD --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Confirm Password</label>
                            </div>

                            <div class="col-md-8">

                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control"
                                       placeholder="Re-enter password">

                                @error('password_confirmation')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- CONTACT PHONE --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Contact Phone</label>
                            </div>

                            <div class="col-md-8">

                                <input type="text"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       class="form-control"
                                       placeholder="Enter phone number">

                                @error('phone')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- GENDER --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Gender</label>
                            </div>

                            <div class="col-md-8">

                                <select name="gender" class="form-control">

                                    <option value="">
                                        Select Gender
                                    </option>

                                    <option value="male"
                                        {{ old('gender') == 'male' ? 'selected' : '' }}>
                                        Male
                                    </option>

                                    <option value="female"
                                        {{ old('gender') == 'female' ? 'selected' : '' }}>
                                        Female
                                    </option>

                                    <option value="other"
                                        {{ old('gender') == 'other' ? 'selected' : '' }}>
                                        Other
                                    </option>

                                </select>

                                @error('gender')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- COURSE --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Course(s)</label>
                            </div>

                            <div class="col-md-8">

                                <input type="text"
                                       name="course"
                                       value="{{ old('course') }}"
                                       class="form-control"
                                       placeholder="Enter course">

                                @error('course')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- GUARDIAN NAME --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Guardian Name</label>
                            </div>

                            <div class="col-md-8">

                                <input type="text"
                                       name="guardian_name"
                                       value="{{ old('guardian_name') }}"
                                       class="form-control"
                                       placeholder="Enter guardian name">

                                @error('guardian_name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- GUARDIAN PHONE --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Guardian Phone No</label>
                            </div>

                            <div class="col-md-8">

                                <input type="text"
                                       name="guardian_phone"
                                       value="{{ old('guardian_phone') }}"
                                       class="form-control"
                                       placeholder="Enter guardian phone number">

                                @error('guardian_phone')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- ADDRESS --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Address</label>
                            </div>

                            <div class="col-md-8">

                                <textarea name="address"
                                          class="form-control"
                                          placeholder="Enter address">{{ old('address') }}</textarea>

                                @error('address')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- CURRENT CITY --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Current City</label>
                            </div>

                            <div class="col-md-8">

                                <input type="text"
                                       name="city"
                                       value="{{ old('city') }}"
                                       class="form-control"
                                       placeholder="Enter current city">

                                @error('city')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- COUNTRY --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Country</label>
                            </div>

                            <div class="col-md-8">

                                <input type="text"
                                       name="country"
                                       value="{{ old('country') }}"
                                       class="form-control"
                                       placeholder="Enter country">

                                @error('country')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- NOTE / QUERY --}}
                        <div class="row mb-3">

                            <div class="col-md-4 form-label-col">
                                <label>Note / Query</label>
                            </div>

                            <div class="col-md-8">

                                <textarea name="note"
                                          class="form-control"
                                          placeholder="Enter your note or query">{{ old('note') }}</textarea>

                                @error('note')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                        </div>


                        {{-- SIGN UP BUTTON --}}
                        <div class="text-center mt-4">

                            <button type="submit"
                                    class="btn btn-warning px-5 signup-btn">

                                SIGN UP

                            </button>

                        </div>


                        {{-- LOGIN LINK --}}
                        <div class="text-center mt-3">

                            <p class="mb-0">

                                Are you a member?

                                <a href="{{ route('login') }}"
                                   class="text-primary fw-bold text-decoration-none">

                                    Login now

                                </a>

                            </p>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>


@include('layouts.footer')