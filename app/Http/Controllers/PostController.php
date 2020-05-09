<?php

namespace App\Http\Controllers;

use App\models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('pages.post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:100',
            'slug' => 'required|alpha_dash|unique:posts',
            'description' => 'required|max:255',
            'content' => 'required',
            'is_posted' => 'boolean',
        ]);

        $post = Post::create($request->input());

        return redirect("/posts/{$post->slug}");
    }

    public function show(Post $post)
    {
        return view('pages.post.show')->with('post', $post);
    }
}
