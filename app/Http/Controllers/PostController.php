<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $premium = $request->filled('premium') && $request->premium === "1";
        
        $query = Post::query()->where('is_premium', $premium ? 1 : 0);
        
        if ($request->filled('categories')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('categories.id', $request->categories);
            });
        }
        
        $posts = $query->latest()->paginate(10)->withQueryString();

        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories', 'premium'));
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
        $validated = $request->validated();

        $validated['image'] = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : "";
        $validated['user_id'] = Auth::id() ?? 1;
        $validated['is_premium'] = $validated['premium'] ?? 0;
        
        $post = Post::create($validated);

        $post->categories()->sync($validated['categories']);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get();

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::All();

        return view('user.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            // Store the new image
            $validated['image'] = $request->file('image')->store('images', 'public');
        
        } else {
            // Delete the old image if no new one is uploaded
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $validated['image'] = null;
        }
        
        $validated['is_premium'] = $request->has('premium') ? 1 : 0;

        $post->update($validated);

        $post->categories()->sync($validated['categories']);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('user.index');
    }

    public function premium(string $premium)
    {
        $posts = Post::where('is_premium', 1)->latest()->paginate(10);
        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories', 'premium'));
    }
}
