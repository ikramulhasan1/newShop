<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')
            ->with('sub_category')
            // ->with('products')
            ->where('status', '1')
            ->where('showHome', 'Yes')
            ->get();

        $products = Product::where('is_featured', 'Yes')->where('status', 1)
            ->get();
        return view('frontend.home', compact('categories', 'products'));
    }
}
