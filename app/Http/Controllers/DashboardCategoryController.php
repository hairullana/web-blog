<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Js;

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

    public function categoryPercentage($userId)
    {
        $category = Post::where('user_id', $userId)->get()->groupBy('category.name');

        return response()->json([
            'message' => 'Percentage of Category',
            'data' => $category
        ], 200);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        $posts = Post::where('category_id', $category->id)->get();
        $postController = new DashboardPostController();
        foreach ($posts as $post) {
            $postController->destroy($post->id);
        }

        return response()->json([
            'success' => true,
            'message' => 'Category and it posts has been deleted'
        ], 200);
    }

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
            'name' => ['required', 'min:3'],
            'slug' => ['required', 'min:3']
        ]);

        if ($category) {
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

    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'message' => 'Category Data',
            'data'    => $category
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:3'],
            'slug' => ['required', 'min:3']
        ]);

        $category = Category::create($request->all());

        if ($category) {
            return response()->json([
                'success' => true,
                'message' => 'New category has been created',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'New category failed to save',
            ], 409);
        }
    }
}
