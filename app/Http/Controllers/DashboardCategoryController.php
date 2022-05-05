<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardCategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Categories Data',
            'data'    => Category::latest()->get()
        ], 200);
    }

    public function store(Request $request)
    {
        
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

    public function update(Request $request, Category $category)
    {
        // validate
        $validate = $request->validate([
            'name' => ['required'],
            'slug' => ['required']
        ]);

        if($category) {
            //update category
            $category->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Post Updated',
                'data'    => $category  
            ], 200);
        }

        //data category not found
        return response()->json([
            'success' => false,
            'message' => 'Post Not Found',
        ], 404);
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
