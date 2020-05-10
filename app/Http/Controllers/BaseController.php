<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\TagService;

class BaseController extends Controller
{
    private TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;

        view()->share('tagCloud', $tagService->getTagCloud());
    }

    public function index()
    {
        return view('pages.base.homepage')
            ->with('posts', Post::latest()->get());
    }

    public function about()
    {
        return view('pages.base.about');
    }
}
