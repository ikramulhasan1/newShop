<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $subcategories = SubCategory::paginate(5);
        return view('admin.SubCategory.index', compact('categories', 'subcategories'));
    }


    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.SubCategory.create', compact('categories'));
    }


    public function store(SubCategoryRequest $request)
    {
        //return $request->all();
        $category_name = Category::find($request->category_id)->name;
        $subCategory = new SubCategory();
        $subCategory->fill($request->all());
        $subCategory->category = $category_name;

        $subCategory->save();

        return redirect()->route('subcategories.index');
    }


    public function show(SubCategory $subcategory)
    {
        //
    }


    public function edit(SubCategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.SubCategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, SubCategory $subcategory)
    {
        // dd($request);
        $subcategory->update($request->all());
        return redirect()->route('subcategories.index');
    }

    public function destroy(SubCategory $subCategory, $id)
    {
        $subCategory->destroy($id);
        return back();
    }

    public function trash()
    {
        $subcategories = SubCategory::onlyTrashed()->get();
        return view('admin.SubCategory.trash', compact('subcategories'));
    }

    public function restore($id)
    {
        SubCategory::withTrashed()->find($id)->restore();
        return back();
    }

    public function delete($id)
    {
        SubCategory::withTrashed()->find($id)->forceDelete();
        return back();
    }
}
