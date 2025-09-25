<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Post;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        
        return view('user.index', compact('posts'));
    }
    
    public function upgrade()
    {
        $user = Auth::user();
        $user->is_premium = 1;
        $user->save();

        return redirect()->back();
    }
}