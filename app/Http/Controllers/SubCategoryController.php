<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('admin.SubCategory.index', compact('subcategories'));
    }

    public function create()
    {
        return view('admin.SubCategory.create');
    }

    public function store(Request $request)
    {
        $request->create($request);
        return redirect()->route('subcategories.index');
    }

    public function show(SubCategory $subCategory)
    {
        //
    }

    public function edit(SubCategory $subCategory)
    {
        //
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    public function destroy(SubCategory $subCategory)
    {
        //
    }
}
