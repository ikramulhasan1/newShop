<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\Pagination\Paginator;

use function PHPUnit\Framework\isEmpty;

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

    public function store(CategoryRequest $request)
    {
        // dd($request);
        Category::create($request->all());
        // $request->create($request);

      
        $imageName = time().'.'.$request->images->getClientOriginalExtension();  
         
        $request->images->move(public_path('images'), $imageName);
        
        // $request->images->storeAs('images', $imageName);
        /* 
            Write Code Here for
            Store $imageName name in DATABASE from HERE 
        */
        
        return redirect()->route('categories.index')
                    ->with('success', 'You have successfully upload image.')
                    ->with('images', $imageName);

        
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
        $category->update($request->except('status'));
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete($category);
        return back();
    }
}
