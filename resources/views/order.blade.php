@extends('logintemp')

@section('content')
<div class="container-fluid dashboard-container">
    <div class="row">
        <div class="col-md-3 col-lg-2 d-none d-md-block sidebar-desktop">
            <div class="bg-white h-100 shadow-sm">
                <div class="p-4 text-center border-bottom">
                    <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                </div>

                <nav class="nav nav-pills flex-column p-3">
                    <a href="{{ route('user.orders') }}" class="nav-link active mb-2" aria-current="page">
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
                <!-- Cart Section -->
                <div class="row mb-4">
                    <div class="col">
                        <h1 class="display-6 mb-0">Your Cart</h1>
                        <p class="text-muted mb-0">Review items before checkout</p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        @php $cart = session()->get('cart', []); @endphp
                        
                        @if(!empty($cart))
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $cartTotal = 0; @endphp
                                        @foreach($cart as $id => $item)
                                            <tr>
                                                <td>{{ $item['name'] }}</td>
                                                <td>${{ number_format($item['price'], 2) }}</td>
                                                <td>{{ $item['quantity'] }}</td>
                                                <td>
                                                    @php 
                                                    $itemTotal = $item['price'] * $item['quantity'];
                                                    $cartTotal += $itemTotal;
                                                    @endphp
                                                    ${{ number_format($itemTotal, 2) }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                            <td colspan="2"><strong>${{ number_format($cartTotal, 2) }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between">
                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">Clear Cart</button>
                                </form>
                                <form action="{{ route('cart.checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
                                </form>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                                <p class="mt-3 text-muted">Your cart is empty</p>
                                <a href="{{ route('shop') }}" class="btn btn-primary">Continue Shopping</a>
                            </div>
                        @endif
                    </div>
                    <div class="row mb-4">
                    <div class="col">
                        <h1 class="display-6 mb-0">Your Checkout</h1>
                        <p class="text-muted mb-0">Your History of Purchases</p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        @if($orders->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Products</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>#{{ $order->id }}</td>
                                                <td>
                                                    <div class="small">
                                                        @foreach($order->items as $item)
                                                            <div class="mb-1">
                                                                {{ $item->product_name }} (x{{ $item->quantity }})
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td>${{ number_format($order->total, 2) }}</td>
                                                <td>
                                                    @switch($order->status)
                                                        @case('pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                            @break
                                                        @case('processing')
                                                            <span class="badge bg-info">Processing</span>
                                                            @break
                                                        @case('shipped')
                                                            <span class="badge bg-primary">Shipped</span>
                                                            @break
                                                        @case('delivered')
                                                            <span class="badge bg-success">Delivered</span>
                                                            @break
                                                        @case('cancelled')
                                                            <span class="badge bg-danger">Cancelled</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-secondary">{{ $order->status }}</span>
                                                    @endswitch
                                                </td>
                                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        @if($order->status === 'pending')
                                                            <form action="{{ route('orders.cancel', $order->id) }}" 
                                                                  method="POST" 
                                                                  class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" 
                                                                        class="btn btn-sm btn-outline-danger ms-2">
                                                                    Cancel Order
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-box-seam text-muted" style="font-size: 3rem;"></i>
                                <p class="mt-3 text-muted">No orders found</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.dropdown-menu {
    min-width: 150px;
}

.dashboard-container {
    min-height: 100vh;
    background-color: #f8f9fa;
}

.sidebar-desktop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100;
    padding: 0;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

.sidebar-desktop .nav-link {
    color: #495057;
    border-radius: 8px;
    margin-bottom: 5px;
    transition: all 0.3s ease;
}

.sidebar-desktop .nav-link:hover {
    background-color: #e9ecef;
    transform: translateX(5px);
}

.sidebar-desktop .nav-link.active {
    background-color: #0d6efd;
    color: white;
}

.sidebar-desktop .nav-link i {
    width: 20px;
}

.main-content {
    background-color: #f8f9fa;
    padding: 20px;
    transition: all 0.3s ease;
}

.card {
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

.table {
    margin-bottom: 0;
}

.table th {
    font-weight: 600;
    color: #495057;
    border-top: none;
    background-color: #f8f9fa;
    padding: 1rem;
}

.table td {
    vertical-align: middle;
    padding: 1rem;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
}

.badge {
    padding: 0.5em 0.8em;
    font-weight: 500;
    letter-spacing: 0.5px;
    border-radius: 6px;
}

.bg-warning {
    background-color: #ffc107 !important;
    color: #000;
}

.bg-info {
    background-color: #0dcaf0 !important;
}

.bg-primary {
    background-color: #0d6efd !important;
}

.bg-success {
    background-color: #198754 !important;
}

.bg-danger {
    background-color: #dc3545 !important;
}

.btn {
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #0d6efd;
    border: none;
    box-shadow: 0 2px 4px rgba(13, 110, 253, 0.3);
}

.btn-primary:hover {
    background-color: #0b5ed7;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(13, 110, 253, 0.4);
}

.btn-danger {
    background-color: #dc3545;
    border: none;
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
}

.btn-danger:hover {
    background-color: #bb2d3b;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.4);
}

.btn-outline-danger {
    color: #dc3545;
    border-color: #dc3545;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    color: white;
    transform: translateY(-2px);
}

.text-center.py-4 {
    padding: 3rem 0;
}

.text-center.py-4 i {
    color: #6c757d;
    margin-bottom: 1rem;
}

.text-muted {
    color: #6c757d !important;
}

.pagination {
    margin-bottom: 0;
}

.pagination .page-link {
    padding: 0.5rem 1rem;
    margin: 0 3px;
    border-radius: 6px;
    color: #0d6efd;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background-color: #e9ecef;
    transform: translateY(-2px);
}

.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .main-content {
        padding: 15px;
    }

    .table th, .table td {
        padding: 0.75rem;
    }

    .btn {
        padding: 0.4rem 1rem;
    }

    .display-6 {
        font-size: 1.5rem;
    }
}

::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.shadow-hover {
    transition: box-shadow 0.3s ease;
}

.shadow-hover:hover {
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}

.order-item {
    padding: 0.5rem 0;
    border-bottom: 1px solid #dee2e6;
}

.order-item:last-child {
    border-bottom: none;
}

.cart-item {
    animation: slideIn 0.3s ease-out;
}
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cancelForms = document.querySelectorAll('form[action*="cancel"]');
        cancelForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const confirmed = confirm('Are you sure you want to cancel this order?');
                if (!confirmed) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection