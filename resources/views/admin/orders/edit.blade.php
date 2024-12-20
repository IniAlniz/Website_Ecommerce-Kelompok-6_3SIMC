@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Order #{{ $order->id }}</h1>
    
    <!-- Edit Form -->
    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <!-- Order Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <!-- Save Changes Button -->
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>

    <!-- Delete Form -->
    <form action="{{ route('admin.dashboard', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash-alt me-2"></i> Delete
        </button>
    </form>
</div>
@endsection
