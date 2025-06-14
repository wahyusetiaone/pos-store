<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category', 'images');

        // Filter by category if provided
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Search by name if provided
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(15);
        $categories = Category::all();

        if ($request->ajax() || ($request->acceptsJson() && $request->isJson())) {
            return response()->json([
                'products' => $products,
                'html' => view('products.partials.product_grid', compact('products'))->render()
            ]);
        }

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048'
        ]);

        // Create product
        $product = Product::create($validated);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');

            // Create product image record
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => str_replace('public/', '', $imagePath),
                'is_primary' => true
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        $product->load('category', 'images');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048'
        ]);

        // Remove image from validated data as we'll handle it separately
        $productData = collect($validated)->except(['image'])->toArray();

        // Update product
        $product->update($productData);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->images()->exists()) {
                $oldImage = $product->images()->first();
                if (Storage::exists('public/' . $oldImage->image_path)) {
                    Storage::delete('public/' . $oldImage->image_path);
                }
                $oldImage->delete();
            }

            // Upload and save new image
            $imagePath = $request->file('image')->store('public/products');

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => str_replace('public/', '', $imagePath),
                'is_primary' => true
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
