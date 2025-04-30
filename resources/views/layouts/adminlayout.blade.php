<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AgriCulture')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Glassmorphic Sidebar */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            border-right: 2px solid rgba(255, 255, 255, 0.3);
            padding: 20px;
        }
        .sidebar h4 {
            text-align: center;
            font-weight: bold;
            color: #2E7D32;
            margin-bottom: 20px;
        }
        .nav-link {
            color: #2E7D32;
            font-size: 16px;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s;
            border-radius: 8px;
        }
        .nav-link i {
            font-size: 18px;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(46, 125, 50, 0.2);
        }
        .nav-link.logout {
            color: #D32F2F !important;
        }
        .nav-link.logout:hover {
            background: rgba(211, 47, 47, 0.2);
        }
        /* Main Content */
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background: #F1F8E9;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column">
        <h4><i class="fa-solid fa-leaf"></i> Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ url('/admin/dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line" style="color: #FFD700;"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/farmers') }}" class="nav-link {{ Request::is('admin/farmers') ? 'active' : '' }}">
                    <i class="fa-solid fa-tractor" style="color: #FF9800;"></i> Farmers
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/crops') }}" class="nav-link {{ Request::is('admin/crops') ? 'active' : '' }}">
                    <i class="fa-solid fa-seedling" style="color: #4CAF50;"></i> Crops
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/weather') }}" class="nav-link {{ Request::is('admin/weather') ? 'active' : '' }}">
                    <i class="fa-solid fa-cloud-sun-rain" style="color: #1E88E5;"></i> Weather
                </a>
            </li>
            <li class="nav-item mt-auto">
                <a class="nav-link logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-sign-out-alt" style="color: #D32F2F;"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>
</div>

</body>
</html>