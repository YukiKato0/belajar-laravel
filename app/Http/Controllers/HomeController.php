<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
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

        return view('home.index', compact('newProducts', 'bestSellerProducts'));
    }
}
