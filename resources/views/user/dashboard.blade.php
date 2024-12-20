@extends('logintemp')

@section('content')
<div class="container-fluid dashboard-container">
    <div class="row">
        <!-- Sidebar for Large Screens -->
        <div class="col-md-3 col-lg-2 d-none d-md-block sidebar-desktop">
            <div class="bg-white h-100 shadow-sm">
                <div class="p-4 text-center border-bottom">
                    <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                </div>

                <nav class="nav nav-pills flex-column p-3">
                    <a href="#" class="nav-link active mb-2" aria-current="page">
                        <i class="bi bi-grid-fill me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('user.orders') }}" class="nav-link mb-2">
                        <i class="bi bi-box-seam me-2"></i> My Orders
                    </a>
                    <form action="{{ route('user.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="nav-link text-danger w-100 text-start">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto main-content">
            <div class="container-fluid px-4 py-5">
                <div class="row mb-4 align-items-center mt-5 mt-md-0">
                    <div class="col">
                        <h1 class="display-6 mb-0">Welcome, {{ auth()->user()->name }}!</h1>
                        <p class="text-muted mb-0">Here's an overview of your account</p>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-light text-dark p-2 shadow-sm">
                            <i class="bi bi-calendar me-1"></i> {{ now()->format('F d, Y') }}
                        </span>
                    </div>
                </div>

                <!-- Recent Orders Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0">Recent Orders</h5>
                        <a href="{{ route('user.orders') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye me-1"></i> View All
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge 
                                                @switch($order->status)
                                                    @case('pending') bg-warning @break
                                                    @case('processing') bg-info @break
                                                    @case('completed') bg-success @break
                                                    @case('cancelled') bg-danger @break
                                                    @default bg-secondary
                                                @endswitch
                                            ">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>${{ number_format($order->total, 2) }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('user.order.details', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
:root {
    --primary-color: #007bff;
    --secondary-color: #6c757d;
    --body-bg: #f4f6f8;
}

body {
    background-color: var(--body-bg);
    font-family: 'Inter', sans-serif;
}

/* Sidebar Styles */
.sidebar-desktop {
    height: 100vh;
    position: sticky;
    top: 0;
    overflow-y: auto;
}

.nav-pills .nav-link {
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    border-radius: 0.5rem;
}

.nav-pills .nav-link.active {
    background-color: var(--primary-color);
    color: white;
}

.nav-pills .nav-link:hover {
    background-color: rgba(0, 123, 255, 0.1);
    color: var(--primary-color);
}

/* Mobile Adjustments */
@media (max-width: 768px) {
    .main-content {
        padding-top: 60px;
    }
}
</style>
@endsection