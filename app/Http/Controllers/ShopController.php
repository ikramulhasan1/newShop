<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null)
    {
        $categorySelected = '';
        $subCategorySelected = '';
        $brandsArray = [];

        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
        }

        $categories = Category::orderBy('name', 'ASC')->with('sub_category')->where('status', 1)->get();
        $brands = Brand::orderBy('name', 'ASC')->where('status', 1)->get();
        $products = Product::where('status', 1);

        // Apply filters here 
        if (!empty($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->first();
            $products = $products->where('category_id', $category->id);
            $categorySelected = $category->id;
        }

        if (!empty($subCategorySlug)) {
            $subCategory = SubCategory::where('slug', $subCategorySlug)->first();
            $products = $products->where('sub_category_id', $subCategory->id);
            $subCategorySelected = $subCategory->id;
        }

        $products = Product::orderBy('id', 'DESC');
        $products = $products->paginate(10);

        $data['categories'] =  $categories;
        $data['brands'] =  $brands;
        $data['products'] =  $products;
        $data['categorySelected'] =  $categorySelected;
        $data['subCategorySelected'] =  $subCategorySelected;
        $data['brandsArray'] =  $brandsArray;
        // dd($products);
        return view('frontend.shop', $data);
    }

    public function product($slug)
    {
        $products = Product::where('slug', $slug)->first();
        if ($products == null) {
            abort(404);
        }
        $categories = Category::orderBy('name', 'ASC')->with('sub_category')->orderBy('id', 'DESC')
            ->where('status', 1)->where('showHome', 'Yes')->get();

        return view('frontend.product', compact('products', 'categories'));
    }
}
