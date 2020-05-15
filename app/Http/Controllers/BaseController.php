<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\Posts\PostRepositoryInterface;
use App\Services\TagService;

class BaseController extends Controller
{
    public function index(PostRepositoryInterface $postRepository)
    {
        $posts = $postRepository->getPostsForLoop();

        return view('pages.base.homepage', compact('posts'));
    }

    public function about()
    {
        return view('pages.base.about');
    }
}
