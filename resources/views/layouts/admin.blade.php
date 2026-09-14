<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Sultana Quran Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background: #1c1c1c;
            color: #fff;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-radius: 6px;
            margin: 2px 8px;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #f39c12;
            color: #fff;
        }
        .sidebar h5 {
            color: #f39c12;
            padding: 15px 20px 5px;
        }
        .card-stat {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar" style="width: 250px;">
        <h5>SULTANA ADMIN</h5>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa fa-gauge"></i> Dashboard
            </a>
            <a href="{{ route('admin.users') ?? '#' }}"><i class="fa fa-users-gear"></i> Users</a>
            <a href="#"><i class="fa fa-user-graduate"></i> Students</a>
            <a href="#"><i class="fa fa-chalkboard-user"></i> Teachers</a>
            <a href="{{ route('admin.courses.index') }}"><i class="fa fa-book-open"></i> Courses</a>
            <a href="{{ route('admin.books.index') }}"><i class="fa fa-book"></i> Books</a>
            <a href="#"><i class="fa fa-layer-group"></i> Curriculum</a>
            <a href="#"><i class="fa fa-file-lines"></i> Applications</a>
            <a href="#"><i class="fa fa-tags"></i> Pricing</a>
            <a href="#"><i class="fa fa-newspaper"></i> Blog</a>
            <a href="#"><i class="fa fa-star"></i> Reviews</a>
            <a href="#"><i class="fa fa-envelope"></i> Contact Messages</a>
            <a href="#"><i class="fa fa-lock"></i> Roles & Permissions</a>
            <hr style="border-color:#444;">
            <a href="{{ route('logout') }}"><i class="fa fa-right-from-bracket"></i> Logout</a>
        </nav>
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>

</div>

</body>
</html>