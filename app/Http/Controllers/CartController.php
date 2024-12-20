<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$validatedData['product_id']])) {
            $cart[$validatedData['product_id']]['quantity'] += $validatedData['quantity'];
        } else {
            $product = Product::findOrFail($validatedData['product_id']);
            $cart[$validatedData['product_id']] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => $validatedData['quantity'],
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('user.orders')->with('success', 'Your cart has been cleared.');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart');
        if (!$cart || count($cart) === 0) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
    
        try {

            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => collect($cart)->sum(function ($item) {
                    return $item['price'] * $item['quantity'];
                }),
                'status' => 'pending',
            ]);

            foreach ($cart as $id => $item) {
                $product = Product::find($id);

                if (!$product || $product->stock < $item['quantity']) {
                    throw new \Exception("Insufficient stock for product: {$item['name']}");
                }

                $product->decrement('stock', $item['quantity']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
    
            session()->forget('cart');

            DB::commit();
    
            return redirect()->route('user.orders')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Item removed from cart');
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        $orders = auth()->user()->orders()->latest()->paginate(10);

        return view('cart', compact('cart', 'orders'));
    }

}