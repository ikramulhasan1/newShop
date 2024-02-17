<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.SubCategory.index', compact('categories', 'subCategories'));
    }


    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.SubCategory.create', compact('categories'));
    }


    public function store(SubCategoryRequest $request)
    {
        // dd($request->all());

        SubCategory::create($request->all());
        return redirect()->route('subcategories.index');
    }


    public function show(SubCategory $subCategory)
    {
        //
    }


    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('admin.SubCategory.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $subCategory->update($request->all());
        return redirect()->route('subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory, $id)
    {
        $subCategory->destroy($id);
        return back();
    }
}
