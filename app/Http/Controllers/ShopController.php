<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')
            ->with('sub_category')
            ->orderBy('id', 'DESC')
            // ->with('products')
            ->where('status', 1)
            ->where('showHome', 'Yes')
            ->get();

        $brands = Brand::orderBy('name', 'ASC')
            ->where('status', 1)
            ->get();

        $products = Product::orderBy('id', 'DESC')
            ->where('status', 1)
            ->get();

        $data['categories'] =  $categories;
        $data['brands'] =  $brands;
        $data['products'] =  $products;

        return view('frontend.shop', $data);
    }
}
