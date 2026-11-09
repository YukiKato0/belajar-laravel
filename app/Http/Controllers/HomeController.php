<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('sort_order')->orderBy('name')->get();

        $newProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_new', true)
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        $bestSellerProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_best_seller', true)
            ->orderByDesc('review_count')
            ->limit(4)
            ->get();

        return view('home.index', compact('categories', 'newProducts', 'bestSellerProducts'));
    }

    public function catalog(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'categories' => ['sometimes', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],
            'min_price' => ['nullable', 'integer', 'min:0'],
            'max_price' => ['nullable', 'integer', 'min:0'],
            'sort' => ['nullable', 'in:relevance,newest,price_asc,price_desc,bestselling'],
        ]);

        $productsQuery = Product::query()
            ->with('category')
            ->where('is_active', true);

        if (filled($filters['q'] ?? null)) {
            $productsQuery->where('name', 'like', '%'.$filters['q'].'%');
        }

        if (! empty($filters['categories'])) {
            $productsQuery->whereIn('category_id', $filters['categories']);
        }

        if (isset($filters['min_price'])) {
            $productsQuery->where('price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $productsQuery->where('price', '<=', $filters['max_price']);
        }

        match ($filters['sort'] ?? 'relevance') {
            'newest' => $productsQuery->orderByDesc('created_at'),
            'price_asc' => $productsQuery->orderBy('price'),
            'price_desc' => $productsQuery->orderByDesc('price'),
            'bestselling' => $productsQuery->orderByDesc('sold_count')->orderByDesc('review_count'),
            default => $productsQuery->orderBy('sort_order')->orderByDesc('created_at'),
        };

        $products = $productsQuery->paginate(12)->withQueryString();
        $categories = Category::query()
            ->withCount(['products' => fn (Builder $query) => $query->where('is_active', true)])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        $selectedCategoryIds = array_map('intval', $filters['categories'] ?? []);

        return view('products.index', compact('products', 'categories', 'filters', 'selectedCategoryIds'));
    }
}
