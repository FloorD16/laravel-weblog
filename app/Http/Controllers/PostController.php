<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('categories')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('categories.id', $request->categories);
            });
        }

        $posts = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::All();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // Haalt de gevalideerde gegevens op uit de StorePostRequest class
        $validated = $request->validated();
        
        $post = new Post();

        // Stelt de 'title' and 'body' waarden in op de gevalideerde gegevens
        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->image = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : "";
        $post->is_premium = $validated['premium'] ?? 0;
        $post->user_id = Auth::id() ?? 1;

        $post->save();

        $post->categories()->sync($validated['categories']);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        $comments = Comment::where('post_id', $id)->get();

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function premium()
    {
        $posts = Post::where('is_premium', 1)->latest()->paginate(10);
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }
}
