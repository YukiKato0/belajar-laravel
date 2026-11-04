<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::with('category')->orderBy('sort_order')->orderByDesc('created_at')->paginate(15);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['icon_class'] = $validated['icon_class'] ?? 'bi bi-box-seam';
        $validated['rating'] = $validated['rating'] ?? 0;
        $validated['review_count'] = $validated['review_count'] ?? 0;
        $validated['is_new'] = $request->boolean('is_new');
        $validated['is_best_seller'] = $request->boolean('is_best_seller');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Product::create($validated);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $validated = $request->validated();
        $validated['icon_class'] = $validated['icon_class'] ?? 'bi bi-box-seam';
        $validated['rating'] = $validated['rating'] ?? 0;
        $validated['review_count'] = $validated['review_count'] ?? 0;
        $validated['is_new'] = $request->boolean('is_new');
        $validated['is_best_seller'] = $request->boolean('is_best_seller');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $product->update($validated);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus.');
    }
}
