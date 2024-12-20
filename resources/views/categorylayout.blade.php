<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous"
    >
    <style>
    :root {
    --sidebar-width: 250px;
    --sidebar-bg: #1a1f2d;
    --sidebar-hover: #2c3344;
    --sidebar-active: #3498db;
    --text-primary: #ffffff;
    --text-secondary: #b0b6c4;
    --transition-speed: 0.3s;
    }

    body, html {
        height: 100%;
        margin: 0;
        font-family: 'Inter', 'Arial', sans-serif;
        background-color: #f4f6f9;
        overflow-x: hidden;
    }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        width: var(--sidebar-width);
        z-index: 100;
        padding: 0;
        background-color: var(--sidebar-bg);
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        transition: all var(--transition-speed) ease;
    }

    .sidebar .position-sticky {
        top: 0;
        height: 100vh;
        padding-top: 20px;
        overflow-y: auto;
    }

    .sidebar .nav-link {
        padding: 12px 24px;
        color: var(--text-secondary);
        font-weight: 500;
        border-left: 4px solid transparent;
        transition: all var(--transition-speed) ease;
        margin: 4px 0;
    }

    .sidebar .nav-link:hover {
        background-color: var(--sidebar-hover);
        color: var(--text-primary);
        border-left-color: var(--sidebar-active);
        padding-left: 28px;
    }

    .sidebar .nav-link.active {
        background-color: var(--sidebar-hover);
        color: var(--text-primary);
        border-left-color: var(--sidebar-active);
    }

    .sidebar .nav-link i {
        width: 24px;
        text-align: center;
        margin-right: 8px;
        font-size: 1.1rem;
    }

    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: var(--sidebar-bg);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background-color: var(--sidebar-hover);
        border-radius: 3px;
    }

    .main-content {
        margin-left: var(--sidebar-width);
        padding: 2rem;
        min-height: 100vh;
        background-color: #f4f6f9;
        transition: margin-left var(--transition-speed) ease;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        transition: transform var(--transition-speed) ease, 
                    box-shadow var(--transition-speed) ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        transition: all var(--transition-speed) ease;
    }

    .btn-link {
        text-decoration: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    .nav-link.text-danger {
        color: #dc3545 !important;
    }

    .nav-link.text-danger:hover {
        color: #fff !important;
        background-color: #dc3545;
    }

    .table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        color: #495057;
        font-weight: 600;
    }

    .table tbody tr {
        transition: background-color var(--transition-speed) ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    @media (max-width: 768px) {
        :root {
            --sidebar-width: 100%;
        }

        .sidebar {
            position: relative;
            width: 100%;
            height: auto;
        }

        .sidebar .position-sticky {
            height: auto;
            padding-top: 10px;
        }

        .main-content {
            margin-left: 0;
            padding: 1rem;
        }

        .card {
            margin-bottom: 1rem;
        }

        .sidebar-collapse {
            display: none;
        }

        .sidebar-collapse.show {
            display: block;
        }

        .sidebar .nav-link {
            padding: 10px 20px;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.5s ease-out;
    }

    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
    }

    .status-active {
        background-color: #28a745;
    }

    .status-inactive {
        background-color: #dc3545;
    }

    .shadow-sm {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08) !important;
    }

    .shadow-md {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
    }

    .shadow-lg {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.12) !important;
    }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.dashboard') }}" aria-current="page">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.index') }}">
                                <i class="fas fa-box me-2"></i>Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link text-danger" style="padding-left: 10; border: none; background: none;">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>

                    </ul>
                </div>
            </nav>


            <main class="col-md-10 ms-sm-auto main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script 
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
        integrity="sha384-..." 
        crossorigin="anonymous"
    ></script>
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
        integrity="sha384-..." 
        crossorigin="anonymous"
    ></script>

    <link 
        rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    >
</body>
</html>