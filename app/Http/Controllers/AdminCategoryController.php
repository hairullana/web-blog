<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminCategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Categories Data',
            'data'    => Category::latest()->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required'],
            'slug' => ['required', 'unique:categories']
        ]);

        Category::create($validate);

        return redirect('/dashboard/categories')->with('success', 'Category has been added!');
    }
    
    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'message' => 'Category Data',
            'data'    => $category
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            'name' => ['required'],
            'slug' => ['required']
        ]);

        Category::where('id', $category->id)->update($validate);
        
        return redirect('/dashboard/categories')->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        Post::where('category_id', $category->id)->delete();
        return redirect('/dashboard/categories')->with('success', 'Category and it`s posts has been deleted');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
