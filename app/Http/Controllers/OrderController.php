<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
    
        $cart = session()->get('cart', []);

        \Log::info('User ID: ' . auth()->id());
        \Log::info('User Name: ' . auth()->user()->name);

        $ordersQuery = auth()->user()->orders();
        \Log::info('Orders Query SQL: ' . $ordersQuery->toSql());
    
        $orders = $ordersQuery->latest()->paginate(10);

        \Log::info('Orders Count: ' . $orders->count());
        \Log::info('Total Orders: ' . $orders->total());
    
        return view('order', compact('orders', 'cart'));

        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('cart', compact('orders'));
    }
    /**
     * Display the specified order details.
     */
    public function show($orderId)
    {
        $order = Order::with('orderItems.product')
            ->where('user_id', auth()->id())
            ->findOrFail($orderId);

        return view('orders.details', compact('order'));
    }

    /**
     * Cancel the specified order.
     */
    public function cancel($orderId)
    {
        $order = Order::where('user_id', auth()->id())
            ->findOrFail($orderId);

        if ($order->status === 'pending') {
            $order->update(['status' => 'cancelled']);
            return redirect()->route('user.orders')
                ->with('success', 'Order has been cancelled successfully.');
        }

        return redirect()->route('user.orders')
            ->with('error', 'This order cannot be cancelled.');
    }

    /**
     * Handle the checkout process.
     */
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('user.orders')->with('error', 'Your cart is empty.');
        }

        \DB::beginTransaction();

        try {
            $order = auth()->user()->orders()->create([
                'status' => 'pending',
                'total' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
            ]);

            foreach ($cart as $productId => $item) {
                $product = Product::findOrFail($productId);
                $order->orderItems()->create([
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            session()->forget('cart');
            \DB::commit();

            return redirect()->route('user.orders')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->route('user.orders')->with('error', 'Failed to place the order. Please try again.');
        }
    }

    public function showOrders()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->paginate(10);
        return view('user.orders', compact('orders'));
    }

    public function adminIndex()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('login');
        }

        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function destroy($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->delete();

        return redirect()->route('admin.order.index')->with('success', 'Order deleted successfully.');
    }
}
