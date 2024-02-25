<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;


class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::paginate(5);
        return view('admin.Brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.Brand.create');
    }

    public function store(BrandRequest $request)
    {
        // dd($request->all());
        Brand::create($request->all());
        return redirect()->route('brands.index');
    }

    public function show(Brand $brand)
    {
        //
    }

    public function edit(Brand $brand)
    {
        return view('admin.Brand.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->all());
        return redirect()->route('brands.index');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete($brand);
        return back();
    }
}
