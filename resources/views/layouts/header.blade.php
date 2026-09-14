<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $siteSettings['site_name'] ?? 'Sultana Quran Academy' }}</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<!-- TOP BAR -->
<div class="top-bar py-2">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start gap-2 gap-md-0">

        <div class="top-contact d-flex flex-column flex-sm-row align-items-center gap-1 gap-sm-0">
    <span><i class="bi bi-telephone-fill me-1"></i> {{ $siteSettings['contact_phone'] ?? '+92 343 3367079' }}</span>
    <span class="mx-2 d-none d-sm-inline">|</span>
    <span><i class="bi bi-envelope-fill me-1"></i> {{ $siteSettings['contact_email'] ?? 'info@sultanaquranacademy.com' }}</span>
</div>

        <div class="top-links">

            @if(session('student_id'))
                <span class="me-2">
                    <i class="bi bi-person-check-fill me-1"></i>
                    Welcome, {{ session('student_name', 'User') }}
                </span>
            @else
                <a href="{{ url('/register') }}" class="me-2">
                    <i class="bi bi-person-plus-fill me-1"></i>Register
                </a>

                <span class="mx-1">|</span>

                <a href="{{ url('/login') }}" class="ms-2">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Login
                </a>
            @endif

        </div>

    </div>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar shadow-sm">

<div class="container">

    <!-- LOGO -->
    <a class="navbar-brand d-flex align-items-center fw-bold text-white"
       href="{{ url('/') }}">

       <img src="{{ !empty($siteSettings['site_logo']) ? asset($siteSettings['site_logo']) : asset('images/logo.png') }}"
     alt="{{ $siteSettings['site_name'] ?? 'Sultana Quran Academy' }}"
     class="site-logo">
        <div>
            <span class="d-block">{{ $siteSettings['site_name'] ?? 'SULTANA QURAN ACADEMY' }}</span>
        </div>

    </a>

    <!-- MOBILE BUTTON -->
    <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu">

        <span class="navbar-toggler-icon"></span>

    </button>

    <!-- MENU -->
    <div class="collapse navbar-collapse" id="menu">

        <ul class="navbar-nav ms-auto align-items-lg-center">

            <!-- HOME -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                   href="{{ url('/') }}">

                    HOME

                </a>
            </li>

            <!-- BOOKS -->
            <li class="nav-item">

                @if (session('student_id'))

                    <a class="nav-link {{ request()->is('books*') ? 'active' : '' }}"
                       href="{{ route('books.index') }}">

                        BOOKS

                    </a>

                @else

                    <a class="nav-link"
                       href="#"
                       onclick="showLoginAlert(event)">

                        BOOKS

                    </a>

                @endif

            </li>

            <!-- COURSES DROPDOWN -->
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle {{ request()->is('courses*') ? 'active' : '' }}"
                   href="#"
                   id="coursesDropdown"
                   role="button"
                   data-bs-toggle="dropdown"
                   aria-expanded="false">

                    COURSES

                </a>

                <ul class="dropdown-menu shadow border-0">

                    <li>
                        <a class="dropdown-item"
                           href="{{ url('/courses/beginner') }}">

                           Beginner (Noorani Qaida)

                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item"
                           href="{{ url('/courses/quran-reading-course') }}">

                           Reading the Holy Quran

                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item"
                           href="{{ url('/courses/tajweed') }}">

                           Learn Tajweed Online

                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item"
                           href="{{ url('/courses/juz30') }}">

                           Quran Reading Juz 30

                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item"
                           href="{{ url('/courses/tarjuma') }}">

                           Tarjuma Quran

                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item"
                           href="{{ url('/courses/basic_islamic') }}">

                           Basic Islamic Education

                        </a>
                    </li>

                </ul>

            </li>

            <!-- PRICING -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('pricing') ? 'active' : '' }}"
                   href="{{ url('/pricing') }}">

                    PRICING

                </a>
            </li>

            <!-- APPLY -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('apply') ? 'active' : '' }}"
                   href="{{ url('/apply') }}">

                    APPLY NOW

                </a>
            </li>

            <!-- ABOUT -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
                   href="{{ url('/about') }}">

                    ABOUT

                </a>
            </li>

            <!-- CONTACT -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                   href="{{ url('/contact') }}">

                    CONTACT

                </a>
            </li>

            @if(session('student_id'))

                <!-- DASHBOARD (Role Based) -->
                <li class="nav-item">

                    @if(session('student_role') === 'admin')
                        <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}"
                           href="{{ route('admin.dashboard') }}">
                            ADMIN DASHBOARD
                        </a>
                    @elseif(session('student_role') === 'teacher')
                        <a class="nav-link {{ request()->is('teacher*') ? 'active' : '' }}"
                           href="{{ route('teacher.dashboard') }}">
                            TEACHER DASHBOARD
                        </a>
                    @elseif(session('student_role') === 'user')
                        <a class="nav-link {{ request()->is('user*') ? 'active' : '' }}"
                           href="{{ route('user.dashboard') }}">
                            MY DASHBOARD
                        </a>
                    @endif

                </li>

                <!-- LOGOUT -->
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('logout') }}">
                        LOGOUT
                    </a>
                </li>

            @endif

        </ul>

    </div>

</div>

</nav>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@include('partials.navbar-close-script')
@include('partials.login-alert-script')
</body>
</html>