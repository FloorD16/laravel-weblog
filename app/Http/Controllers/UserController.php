<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;

use Illuminate\Http\Request;
use App\Models\Post;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $user_id)
    {
        $posts = Post::where('user_id', $user_id)->get();
        
        return view('user.index', compact('posts', 'user_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $user_id, string $post_id)
    {
        $post = Post::find($post_id);

        return view('user.edit', compact('post', 'user_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $user_id, Post $post)
    {
        // Valideert de inkomende gegevens
        $validated = $request->validated();
        
        // Werkt het item bij met de gevalideerde gegevens
        $post->update($validated);

        return redirect()->route('user.index', ['user_id' => $user_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
