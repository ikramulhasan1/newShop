<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CategoryRequest;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Contracts\Pagination\Paginator;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::latest();
        if (!empty($request->get('keyword'))) {
            $categories = $categories->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $categories = $categories->paginate(10);
        return view('admin.Category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.Category.create');
    }


    public function uploadImage($name, $image)
    {
        // image name database save
        // main laravel project storage save
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp . '-' . $name . '.' . $image->getClientOriginalExtension();
        $pathToUpload = storage_path() . '/app/public/categories/';

        if (!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }
        Image::make($image)->resize(634, 792)->save($pathToUpload . $file_name);
        return $file_name;
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.Category.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete($category);
        return back();
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.Category.trash', compact('categories'));
    }

    public function restore($id)
    {
        Category::with($id)->restore();
        return back();
    }

    public function delete($id)
    {
        Category::with($id)->forceDelete();
        return back();
    }
}
