<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->latest()->take(12)->get();
        $popularProducts = Product::with('category')->inRandomOrder()->take(6)->get();

        return view('index', compact('categories', 'products', 'popularProducts'));
    }
}
