@extends('logintemp')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <main class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Dashboard</h1>
                <div>
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Welcome Message -->
            <div class="alert alert-primary d-flex align-items-center" role="alert">
                <i class="fas fa-user-circle me-3 fs-4"></i>
                <div>
                    Welcome back, <strong>{{ auth()->user()->name }}</strong>! You are logged in as an admin.
                </div>
            </div>

            <!-- Quick Actions and Recent Orders -->
            <div class="row">
                <!-- Quick Actions -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-tools me-2"></i> Quick Actions
                        </div>
                        <div class="card-body">
                            <a href="{{ route('product.index') }}" class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-box-open me-2"></i> Manage Products
                            </a>
                            <a href="{{ route('category.index') }}" class="btn btn-success w-100 mb-2">
                                <i class="fas fa-list me-2"></i> Manage Categories
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-clock me-2"></i> Recent Orders
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentOrders as $order)
                                            <tr>
                                                <td>#{{ $order->id }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>${{ number_format($order->total, 2) }}</td>
                                                <td>
                                                    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm dropdown-toggle
                                                                @switch($order->status)
                                                                    @case('pending') btn-warning @break
                                                                    @case('processing') btn-info @break
                                                                    @case('completed') btn-success @break
                                                                    @case('cancelled') btn-danger @break
                                                                    @default btn-secondary
                                                                @endswitch
                                                            " type="button" id="dropdownMenuButton{{ $order->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                                {{ ucfirst($order->status) }}
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $order->id }}">
                                                                <li>
                                                                    <button type="submit" name="status" value="pending" class="dropdown-item">Pending</button>
                                                                </li>
                                                                <li>
                                                                    <button type="submit" name="status" value="processing" class="dropdown-item">Processing</button>
                                                                </li>
                                                                <li>
                                                                    <button type="submit" name="status" value="completed" class="dropdown-item">Completed</button>
                                                                </li>
                                                                <li>
                                                                    <button type="submit" name="status" value="cancelled" class="dropdown-item">Cancelled</button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash-alt me-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No recent orders</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize all dropdowns on the page
        const dropdowns = document.querySelectorAll('.dropdown-toggle');

        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('click', function (event) {
                // Close other dropdowns when one is opened
                const allDropdowns = document.querySelectorAll('.dropdown-menu');
                allDropdowns.forEach(menu => {
                    if (!menu.contains(event.target) && menu.classList.contains('show')) {
                        menu.classList.remove('show');
                    }
                });

                // Toggle the dropdown
                const dropdownMenu = dropdown.nextElementSibling;
                dropdownMenu.classList.toggle('show');
            });
        });

        // Optionally, close the dropdown if clicked outside
        document.addEventListener('click', function (event) {
            const target = event.target;
            if (!target.closest('.dropdown')) {
                const dropdownMenus = document.querySelectorAll('.dropdown-menu.show');
                dropdownMenus.forEach(menu => menu.classList.remove('show'));
            }
        });
    });
</script>

@endsection
