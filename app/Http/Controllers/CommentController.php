<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, string $id)
    {
        $validated = $request->validated();

        $validated['post_id'] = $id;
        $validated['user_id'] = Auth::id() ?? 1;

        Comment::create($validated);

        return redirect()->route('posts.show', $id);
    }
}
