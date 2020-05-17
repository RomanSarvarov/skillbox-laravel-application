<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PostRepository;
use Gate;

class BaseController extends Controller
{
    /**
     * @param  PostRepository  $postRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
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
