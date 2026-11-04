<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $title = 'Management Kategori Produk || PPKD Sticker';
      $categories = Category::orderBy('sort_order')->get();
      return view('admin.category.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $title = 'Tambah Kategori || PPKD Sticker';
      return view('admin.category.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validated = $request->validate([
        'name'=>'required|string',
        'slug'=>'nullable|string|unique:categories,slug',
        'descripton'=>'nullable|icon|string',
        'icon'=>'nullable|string',
        'sort_order'=>'nullable|integer',
      ]);

      $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
      $validated['sort_order'] = $validated['sort_order'] ? 0 : 0;
      Category::create($validated);
      return redirect()->route('admin.category.index')->with('success', 'Kategori Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
      $title = 'Edit Kategori || PPKD Sticker';
      return view('admin.category.edit', compact('category', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
      $validated = $request->validate([
        'name'=>'required|string',
        'slug'=>'nullable|string|unique:categories,slug,'. $category->id,
        'descripton'=>'nullable|icon|string',
        'icon'=>'nullable|string',
        'sort_order'=>'nullable|integer',
      ]);

      $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
      $validated['sort_order'] = $validated['sort_order'] ? 0 : 0;
      $category->update($validated);

      return redirect()->route('admin.category.index')->with('success', 'Kategori Produk berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      Category::find($id)->delete();
      return redirect()->route('admin.category.index')->with('success', 'Kategori Produk berhasil dihapus');
    }
}
