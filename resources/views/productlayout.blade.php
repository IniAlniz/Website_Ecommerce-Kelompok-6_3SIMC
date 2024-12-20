<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Dashboard">
    <title>Admin Dashboard</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #333;
            --sidebar-link-color: #f4f4f4;
            --sidebar-hover-bg: rgba(255, 255, 255, 0.1);
            --active-link-color: #007bff;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            width: var(--sidebar-width);
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background-color: var(--sidebar-bg);
            transition: transform 0.3s ease;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: var(--sidebar-link-color);
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link:hover {
            background-color: var(--sidebar-hover-bg);
            color: #ffffff;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            color: var(--active-link-color);
            background-color: rgba(0, 123, 255, 0.1);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .nav-item .btn-link.nav-link {
            width: 100%;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar" id="sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.index') }}">
                                <i class="fas fa-box me-2"></i>
                                <span>Category</span>
                            </a>
                        </li>
                        <li class="nav-item mt-auto">
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
    </script>
</body>
</html>