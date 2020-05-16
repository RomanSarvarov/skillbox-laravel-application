<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PostRepository;

class BaseController extends Controller
{
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->getPostsForLoop();

        return view('pages.base.homepage', compact('posts'));
    }

    public function about()
    {
        return view('pages.base.about');
    }
}
