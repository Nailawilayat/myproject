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

    {{-- Admin Layout Styles --}}
    <link rel="stylesheet" href="{{ asset('css/admin-forms.css') }}">

    {{-- Sidebar submenu overrides: left-aligned text + hover behaviour --}}
    <style>

        /* Force submenu links to align left instead of right/centered */
        .admin-submenu a {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            text-align: left;
            gap: 8px;
        }

        .admin-submenu a i {
            font-size: 6px;
            flex-shrink: 0;
        }

        .admin-menu-title + a .chevron {
            transition: transform 0.2s ease;
        }

        .admin-menu-title + a[aria-expanded="true"] .chevron {
            transform: rotate(90deg);
        }

    </style>

    @stack('styles')

</head>

<body>

    {{-- ================= MOBILE OVERLAY ================= --}}

    <div class="sidebar-overlay" id="sidebarOverlay"></div>


    {{-- ================= SIDEBAR ================= --}}

    <aside class="admin-sidebar" id="adminSidebar">

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

    <a href="{{ route('admin.students.create') }}"
       class="{{ request()->routeIs('admin.students.create') ? 'active' : '' }}">
        <i class="bi bi-circle-fill"></i>
        Add Student
    </a>

    <a href="{{ route('admin.students.enrolled') }}"
       class="{{ request()->routeIs('admin.students.enrolled') ? 'active' : '' }}">
        <i class="bi bi-circle-fill"></i>
        Enrolled Students
    </a>

    <a href="{{ route('admin.students.manage') }}"
       class="{{ request()->routeIs('admin.students.manage') ? 'active' : '' }}">
        <i class="bi bi-circle-fill"></i>
        Manage Account
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

    <a href="{{ route('admin.teachers.manage') }}"
       class="{{ request()->routeIs('admin.teachers.manage') ? 'active' : '' }}">
        <i class="bi bi-circle-fill"></i>
        Manage Account
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

                <a href="{{ route('admin.courses.students') }}"
                   class="{{ request()->routeIs('admin.courses.students') ? 'active' : '' }}">
                    <i class="bi bi-circle-fill"></i>
                    Enrolled Students
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

           <a href="{{ route('admin.contact-messages') }}"
   class="{{ request()->routeIs('admin.contact-messages*') ? 'active' : '' }}">
    <span class="menu-label">
        <i class="bi bi-chat-left-text-fill"></i>
        <span>Contact Messages</span>
    </span>
</a>

 <a href="{{ route('admin.certificates') }}"
   class="{{ request()->routeIs('admin.certificates*') ? 'active' : '' }}">
    <span class="menu-label">
        <i class="bi bi-patch-check-fill"></i>
        <span>Certificates</span>
    </span>
</a>
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

            <div class="admin-topbar-left">

                <button class="sidebar-toggle-btn" id="sidebarToggleBtn" type="button">
                    <i class="bi bi-list"></i>
                </button>

                <h5>@yield('page-title', 'Dashboard')</h5>

            </div>

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

    <script>

        const sidebar = document.getElementById('adminSidebar');
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
            if (sidebar.classList.contains('show')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        overlay.addEventListener('click', closeSidebar);

        // Close sidebar automatically when a menu link is clicked (mobile)
        document.querySelectorAll('.admin-menu a').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 767 && !link.hasAttribute('data-bs-toggle')) {
                    closeSidebar();
                }
            });
        });

        // ================= HOVER-TO-OPEN SUBMENUS (desktop only) =================
        // Mobile/touch screens still use click (Bootstrap's default collapse
        // behaviour via data-bs-toggle="collapse"), since touch devices have no hover.

        function isDesktop() {
            return window.innerWidth > 767;
        }

        document.querySelectorAll('.admin-menu-title').forEach(function (titleEl) {

            const toggleLink = titleEl.nextElementSibling; // the <a data-bs-toggle="collapse">
            if (!toggleLink || !toggleLink.hasAttribute('data-bs-toggle')) return;

            const targetSelector = toggleLink.getAttribute('href'); // e.g. "#studentsMenu"
            const submenu = document.querySelector(targetSelector);
            if (!submenu) return;

            const collapseInstance = bootstrap.Collapse.getOrCreateInstance(submenu, { toggle: false });

            let closeTimeout = null;

            // Hovering anywhere in this cluster (title, toggle link, submenu) keeps it open
            const group = [titleEl, toggleLink, submenu];

            function openMenu() {
                if (!isDesktop()) return;
                clearTimeout(closeTimeout);
                collapseInstance.show();
            }

            function scheduleClose() {
                if (!isDesktop()) return;
                clearTimeout(closeTimeout);
                closeTimeout = setTimeout(function () {
                    collapseInstance.hide();
                }, 150); // small delay so moving mouse from title -> submenu doesn't flicker-close
            }

            group.forEach(function (el) {
                el.addEventListener('mouseenter', openMenu);
                el.addEventListener('mouseleave', scheduleClose);
            });

        });

    </script>

    @stack('scripts')

</body>

</html>