<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('admin.Product.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $subCategories = SubCategory::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();

        return view('admin.Product.create', compact('categories', 'subCategories', 'brands'));
    }


    public function uploadImage($name, $image)
    {
        // image name database save
        // main laravel project storage save
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp . '-' . $name . '.' . $image->getClientOriginalExtension();
        $pathToUpload = storage_path() . '/app/public/product-images/';

        if (!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }
        Image::make($image)->resize(634, 792)->save($pathToUpload . $file_name);
        return $file_name;
    }


    public function store(Request $request)
    {


        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $this->uploadImage($request->name, $request->image);
            $data['image'] = $image;
        }
        // Product::create($request->all());
        Product::create($data);

        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
