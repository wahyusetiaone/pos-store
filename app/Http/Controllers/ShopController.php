<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Validasi: param 'store' wajib ada
        if (!$request->has('store') || empty($request->store)) {
            abort(404);
        }

        // Cari store berdasarkan nama
        $storeName = $request->store;
        $store = \App\Models\Store::where('name', $storeName)->first();
        if (!$store) {
            abort(404);
        }

        $query = Product::with(['store', 'images', 'category'])
                       ->where('status', true)
                       ->where('store_id', $store->id);

        // Search by name
        if ($request->search) {
            $query->whereRaw('LOWER(name) like ?', ['%' . strtolower($request->search) . '%']);
        }

        // Filter by category (hanya untuk produk di store ini)
        if ($request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('id', $request->category);
            });
        }
        $products = $query->paginate(12)->withQueryString();

        // Ambil kategori hanya milik store ini
        $categories = Category::where('store_id', $store->id)->get();

        return view('shop.index', compact('store','products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['store', 'images', 'category']);

        // Get related products from same category, excluding current product
        $relatedProducts = Product::with(['store', 'images', 'category'])
            ->where('status', true)
            ->where('id', '!=', $product->id)
            ->when($product->category_id, function($query) use ($product) {
                return $query->where('category_id', $product->category_id);
            })
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}
