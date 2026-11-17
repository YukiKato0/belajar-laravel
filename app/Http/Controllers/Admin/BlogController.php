<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $blogs = Blog::query()->latest('updated_at')->paginate(15);

        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['published_at']
            ?? ($validated['is_published'] ? now() : null);

        Blog::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog): View
    {
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['published_at']
            ?? ($validated['is_published'] ? ($blog->published_at ?? now()) : null);
        $blog->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
