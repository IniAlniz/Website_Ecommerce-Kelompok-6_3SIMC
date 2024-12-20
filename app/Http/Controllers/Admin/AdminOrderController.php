<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $recentOrders = Order::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.dashboard', compact('recentOrders'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product', 'user')
            ->findOrFail($id);

        return view('admin.orders.details', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->input('status')]);
    
        return redirect()->route('admin.orders')->with('success', 'Order status updated successfully.');
    }

    public function edit($id)
    {
        $order = Order::with('orderItems.product', 'user')->findOrFail($id);

        return view('admin.orders.edit', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Order deleted successfully.');
    }
}
