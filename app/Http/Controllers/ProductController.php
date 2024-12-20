<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    protected $products;

    public function __construct(Product $product)
    {
        $this->products = $product;
    }

    public function index()
    {
        $products = Product::with('category')->paginate(12);
        $categories = Category::pluck('name', 'id');

        return view('pages.products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productname' => 'required|max:255',
            'cat_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('products', 'public');
            $validatedData['photo'] = $imagePath;
        }

        Product::create($validatedData);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
        }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::pluck('name', 'id');

        return view('pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'productname' => 'required|max:255',
            'cat_id' => 'required|exists:categories,id',
            'description' => 'required|string|max:1000',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'size' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('images'), $filename);
            $validatedData['photo'] = $filename;
        } else {
            $validatedData['photo'] = $product->photo;
        }

        $product->update($validatedData);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}