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

        $categories = $categories->paginate(5);
        return view('admin.Category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.Category.create');
    }


    public function uploadImage($name, $images)
    {

        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp . '-' . $name . '.' . $images->getClientOriginalExtension();
        $pathToUpload = storage_path() . '/app/public/category-images/';

        if (!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }
        Image::make($images)->resize(634, 792)->save($pathToUpload . $file_name);
        return $file_name;
    }


    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('images')) {
            $images = $this->uploadImage($request->name, $request->images);
            $data['images'] = $images;
        }

        Category::create($data);

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('admin.Category.edit', compact('category'));
    }


    public function update(CategoryRequest $request, Category $category)
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
        Category::withTrashed()->find($id)->restore();
        return back();
    }

    public function delete($id)
    {
        Category::withTrashed()->find($id)->forceDelete();
        return back();
    }
}
