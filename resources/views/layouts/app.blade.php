<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Dashboard') - Sultana Quran Academy</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        /* ================= SIDEBAR ================= */

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;

            background: #111;

            overflow-y: auto;

            z-index: 1000;

            box-shadow: 3px 0 15px rgba(0,0,0,0.15);
        }

        .admin-brand {
            padding: 25px 15px;
            text-align: center;
            border-bottom: 1px solid #333;
        }

        .admin-brand h4 {
            color: #fff;
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .admin-brand span {
            color: #d6a84f;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .admin-menu {
            padding: 15px 10px;
        }

        .admin-menu-title {
            color: #888;
            font-size: 11px;
            text-transform: uppercase;
            padding: 14px 15px 6px;
            letter-spacing: 1px;
        }

        .admin-menu a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 15px;
            margin-bottom: 4px;
            color: #ddd;
            text-decoration: none;
            border-radius: 7px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .admin-menu a .menu-label {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-menu a:hover {
            background: #2b2b2b;
            color: #d6a84f;
        }

        .admin-menu a.active {
            background: #d6a84f;
            color: #111;
            font-weight: 600;
        }

        .admin-menu a i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .admin-menu a .chevron {
            font-size: 12px;
            transition: transform 0.25s ease;
            width: auto;
        }

        .admin-menu a[aria-expanded="true"] .chevron {
            transform: rotate(90deg);
        }

        /* Dropdown */

        .admin-submenu {
            padding-left: 25px;
        }

        .admin-submenu a {
            font-size: 13px;
            padding: 9px 15px;
            color: #aaa;
        }

        .admin-submenu a.active {
            background: #d6a84f;
            color: #111;
        }

        .admin-submenu a i {
            font-size: 7px;
        }

        /* ================= MAIN CONTENT ================= */

        .admin-main {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* ================= TOPBAR ================= */

        .admin-topbar {
            height: 70px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .admin-topbar h5 {
            margin: 0;
            font-weight: 700;
            color: #222;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #d6a84f;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .admin-user-info strong {
            display: block;
            font-size: 14px;
        }

        .admin-user-info span {
            font-size: 11px;
            color: #888;
        }

        /* ================= PAGE CONTENT ================= */

        .admin-content {
            padding: 30px;
        }

        /* ================= MOBILE ================= */

        @media(max-width: 991px) {

            .admin-sidebar {
                width: 230px;
            }

            .admin-main {
                margin-left: 230px;
            }

        }

        @media(max-width: 767px) {

            .admin-sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-topbar {
                position: relative;
            }

        }

    </style>

    @stack('styles')

</head>

<body>

    {{-- ================= SIDEBAR ================= --}}

    <aside class="admin-sidebar">

        <div class="admin-brand">
            <h4>SULTANA QURAN ACADEMY</h4>
            <span>ADMIN PANEL</span>
        </div>

        <div class="admin-menu">

            {{-- DASHBOARD --}}

            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="menu-label">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Dashboard</span>
                </span>
            </a>


            {{-- ================= STUDENTS ================= --}}

            <div class="admin-menu-title">Students</div>

            <a href="#studentsMenu" data-bs-toggle="collapse"
               class="{{ request()->routeIs('admin.students*') ? 'active' : '' }}"
               aria-expanded="{{ request()->routeIs('admin.students*') ? 'true' : 'false' }}">
                <span class="menu-label">
                    <i class="bi bi-people-fill"></i>
                    <span>Students</span>
                </span>
                <i class="bi bi-chevron-right chevron"></i>
            </a>

            <div class="collapse admin-submenu {{ request()->routeIs('admin.students*') ? 'show' : '' }}" id="studentsMenu">

                <a href="{{ route('admin.students') }}"
                   class="{{ request()->routeIs('admin.students') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    All Students
                </a>

                <a href="{{ route('admin.students.enrolled') }}"
                   class="{{ request()->routeIs('admin.students.enrolled') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Enrolled Students
                </a>

                <a href="{{ route('admin.students.applications') }}"
                   class="{{ request()->routeIs('admin.students.applications') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Applications
                </a>

            </div>


            {{-- ================= TEACHERS ================= --}}

            <div class="admin-menu-title">Teachers</div>

            <a href="#teachersMenu" data-bs-toggle="collapse"
               class="{{ request()->routeIs('admin.teachers*') ? 'active' : '' }}"
               aria-expanded="{{ request()->routeIs('admin.teachers*') ? 'true' : 'false' }}">
                <span class="menu-label">
                    <i class="bi bi-person-video3"></i>
                    <span>Teachers</span>
                </span>
                <i class="bi bi-chevron-right chevron"></i>
            </a>

            <div class="collapse admin-submenu {{ request()->routeIs('admin.teachers*') ? 'show' : '' }}" id="teachersMenu">

                <a href="{{ route('admin.teachers') }}"
                   class="{{ request()->routeIs('admin.teachers') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    All Teachers
                </a>

                <a href="{{ route('admin.teachers.create') }}"
                   class="{{ request()->routeIs('admin.teachers.create') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Add Teacher
                </a>

                <a href="{{ route('admin.teachers.assigned') }}"
                   class="{{ request()->routeIs('admin.teachers.assigned') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Assigned Courses
                </a>

            </div>


            {{-- ================= COURSES ================= --}}

            <div class="admin-menu-title">Courses</div>

            <a href="#coursesMenu" data-bs-toggle="collapse"
               class="{{ request()->routeIs('admin.courses*') ? 'active' : '' }}"
               aria-expanded="{{ request()->routeIs('admin.courses*') ? 'true' : 'false' }}">
                <span class="menu-label">
                    <i class="bi bi-book-fill"></i>
                    <span>Courses</span>
                </span>
                <i class="bi bi-chevron-right chevron"></i>
            </a>

            <div class="collapse admin-submenu {{ request()->routeIs('admin.courses*') ? 'show' : '' }}" id="coursesMenu">

                <a href="{{ route('admin.courses') }}"
                   class="{{ request()->routeIs('admin.courses') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    All Courses
                </a>

                <a href="{{ route('admin.courses.create') }}"
                   class="{{ request()->routeIs('admin.courses.create') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Add Course
                </a>

                <a href="{{ route('admin.courses.curriculum') }}"
                   class="{{ request()->routeIs('admin.courses.curriculum') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Curriculum
                </a>

                <a href="{{ route('admin.courses.students') }}"
                   class="{{ request()->routeIs('admin.courses.students') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Enrolled Students
                </a>

                <a href="{{ route('admin.courses.reviews') }}"
                   class="{{ request()->routeIs('admin.courses.reviews') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Reviews
                </a>

            </div>


            {{-- ================= BOOKS ================= --}}

            <div class="admin-menu-title">Books</div>

            <a href="#booksMenu" data-bs-toggle="collapse"
               class="{{ request()->routeIs('admin.books*') ? 'active' : '' }}"
               aria-expanded="{{ request()->routeIs('admin.books*') ? 'true' : 'false' }}">
                <span class="menu-label">
                    <i class="bi bi-journal-bookmark-fill"></i>
                    <span>Books</span>
                </span>
                <i class="bi bi-chevron-right chevron"></i>
            </a>

            <div class="collapse admin-submenu {{ request()->routeIs('admin.books*') ? 'show' : '' }}" id="booksMenu">

                <a href="{{ route('admin.books') }}"
                   class="{{ request()->routeIs('admin.books') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    All Books
                </a>

                <a href="{{ route('admin.books.create') }}"
                   class="{{ request()->routeIs('admin.books.create') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Add Book
                </a>

            </div>


            {{-- ================= OTHER LINKS ================= --}}

            <div class="admin-menu-title">Management</div>

            <a href="{{ route('admin.pricing') }}"
               class="{{ request()->routeIs('admin.pricing') ? 'active' : '' }}">
                <span class="menu-label">
                    <i class="bi bi-currency-dollar"></i>
                    <span>Pricing</span>
                </span>
            </a>

            <a href="{{ route('admin.contact') }}"
               class="{{ request()->routeIs('admin.contact') ? 'active' : '' }}">
                <span class="menu-label">
                    <i class="bi bi-chat-left-text-fill"></i>
                    <span>Contact Messages</span>
                </span>
            </a>

            <a href="#aboutMenu" data-bs-toggle="collapse"
               class="{{ request()->routeIs('admin.about*') ? 'active' : '' }}"
               aria-expanded="{{ request()->routeIs('admin.about*') ? 'true' : 'false' }}">
                <span class="menu-label">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>About</span>
                </span>
                <i class="bi bi-chevron-right chevron"></i>
            </a>

            <div class="collapse admin-submenu {{ request()->routeIs('admin.about*') ? 'show' : '' }}" id="aboutMenu">

                <a href="{{ route('admin.about.content') }}"
                   class="{{ request()->routeIs('admin.about.content') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Content
                </a>

                <a href="{{ route('admin.about.certificates') }}"
                   class="{{ request()->routeIs('admin.about.certificates') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Certificates
                </a>

            </div>

            <a href="{{ route('admin.settings') }}"
               class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <span class="menu-label">
                    <i class="bi bi-gear-fill"></i>
                    <span>Settings</span>
                </span>
            </a>


            {{-- ================= LOGOUT ================= --}}

            <form action="{{ route('logout') }}" method="POST" class="mt-2">

                @csrf

                <button type="submit"
                        style="
                            width:100%;
                            border:0;
                            background:transparent;
                            color:#ddd;
                            text-align:left;
                            padding:12px 15px;
                            border-radius:7px;
                        ">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>

            </form>

        </div>

    </aside>


    {{-- ================= MAIN ================= --}}

    <main class="admin-main">

        <header class="admin-topbar">

            <h5>@yield('page-title', 'Dashboard')</h5>

            <div class="admin-user">

                <div class="admin-user-icon">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="admin-user-info">
                    <strong>Admin</strong>
                    <span>Administrator</span>
                </div>

            </div>

        </header>

        <div class="admin-content">
            @yield('content')
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>