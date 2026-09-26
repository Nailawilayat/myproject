<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Teacher Dashboard') - Sultana Quran Academy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/teacher-layout.css') }}">

    @stack('styles')

</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>


    <aside class="teacher-sidebar" id="teacherSidebar">

        <div class="teacher-brand">
            <h4>SULTANA QURAN ACADEMY</h4>
            <span>TEACHER PANEL</span>
        </div>

        <div class="teacher-menu">

            <a href="{{ route('teacher.dashboard') }}"
               class="{{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i>
                <span>Dashboard</span>
            </a>

            <div class="teacher-menu-title">Teaching</div>

            <a href="{{ route('teacher.courses') }}"
               class="{{ request()->routeIs('teacher.courses') ? 'active' : '' }}">
                <i class="bi bi-book-fill"></i>
                <span>My Courses</span>
            </a>

            <a href="{{ route('teacher.students') }}"
               class="{{ request()->routeIs('teacher.students') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>My Students</span>
            </a>

           


<a href="{{ route('teacher.books') }}"
   class="{{ request()->routeIs('teacher.books') ? 'active' : '' }}">
    <i class="bi bi-journal-bookmark-fill"></i>
    <span>Books</span>
</a>

<a href="{{ route('teacher.live-classes') }}"
   class="{{ request()->routeIs('teacher.live-classes*') ? 'active' : '' }}">
    <i class="bi bi-camera-video-fill"></i>
    <span>Live Classes</span>
</a>

<form action="{{ route('logout') }}" method="POST" class="mt-2">
    @csrf
    <button type="submit"
            style="width:100%; border:0; background:transparent; color:#ddd;
                   text-align:left; padding:12px 15px; border-radius:7px;">
        <i class="bi bi-box-arrow-right me-2"></i>
        Logout
    </button>
</form>

        </div>

    </aside>


    <main class="teacher-main">

        <header class="teacher-topbar">

            <div class="teacher-topbar-left">

                <button class="sidebar-toggle-btn" id="sidebarToggleBtn" type="button">
                    <i class="bi bi-list"></i>
                </button>

                <h5>@yield('page-title', 'Dashboard')</h5>

            </div>

            <div class="teacher-user">

                <div class="teacher-user-icon">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="teacher-user-info">
                    <strong>{{ session('student_name') }}</strong>
                    <span>Teacher</span>
                </div>

            </div>

        </header>

        <div class="teacher-content">
            @yield('content')
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        const sidebar = document.getElementById('teacherSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggleBtn');

        function openSidebar() {
            sidebar.classList.add('show');
            overlay.classList.add('active');
        }

        function closeSidebar() {
            sidebar.classList.remove('show');
            overlay.classList.remove('active');
        }

        toggleBtn.addEventListener('click', function () {
            sidebar.classList.contains('show') ? closeSidebar() : openSidebar();
        });

        overlay.addEventListener('click', closeSidebar);

    </script>

    @stack('scripts')

</body>

</html>