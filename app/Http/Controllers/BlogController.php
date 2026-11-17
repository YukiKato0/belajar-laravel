<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('q')->trim()->toString();
        $category = $request->string('category')->toString();
        $query = Blog::published()
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('excerpt', 'like', '%'.$search.'%');
            }))
            ->when($category !== '', fn ($query) => $query->where('category', $category))
            ->orderByDesc('published_at')
            ->orderByDesc('id');

        $featuredBlog = (clone $query)->first();
        $blogListQuery = clone $query;
        if ($featuredBlog instanceof Blog) {
            $blogListQuery->whereKeyNot($featuredBlog->getKey());
        }
        $blogs = $blogListQuery->paginate(9)->withQueryString();
        $categories = Blog::published()->select('category')->distinct()->orderBy('category')->pluck('category');
        $categoryCounts = Blog::published()
            ->selectRaw('category, count(*) as aggregate')
            ->groupBy('category')
            ->pluck('aggregate', 'category');
        $totalPublished = Blog::published()->count();

        return view('blogs.index', compact('blogs', 'categories', 'categoryCounts', 'featuredBlog', 'search', 'category', 'totalPublished'));
    }

    public function show(Blog $blog): View
    {
        abort_unless(
            $blog->is_published && $blog->published_at && $blog->published_at->lte(now()),
            404,
        );

        $relatedBlogs = Blog::published()
            ->whereKeyNot($blog->getKey())
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();
        $blogContent = Str::markdown($blog->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return view('blogs.show', compact('blog', 'blogContent', 'relatedBlogs'));
    }
}
