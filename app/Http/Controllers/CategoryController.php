<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_ASPNET_CORE');
    }

    public function index()
    {
        $response = Http::get("{$this->apiUrl}/categories");

        if ($response->successful()) {
            $categories = $response->json();
        } else {
            return redirect()->route('category.index')->with('error', 'Failed to retrieve categories.');
        }

        Log::debug('Categories:', $categories);

        if (empty($categories)) {
            return redirect()->route('category.index')->with('error', 'No categories found.');
        }

        return view('pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $response = Http::post("{$this->apiUrl}/categories", [
            'name' => $request->name,
            'status' => (bool) $request->status,
        ]);

        if ($response->successful()) {
            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }

    public function edit($id)
    {
        $response = Http::get("{$this->apiUrl}/categories/{$id}");
        $category = $response->json();

        if (empty($category)) {
            return redirect()->route('category.index')->with('error', 'Category not found.');
        }

        return view('pages.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category->update($validatedData);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }


    public function destroy($id)
    {
        $response = Http::delete("{$this->apiUrl}/categories/{$id}");

        if ($response->successful()) {
            return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->route('category.index')->with('error', 'Failed to delete category.');
        }
    }
}
