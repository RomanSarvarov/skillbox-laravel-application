<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BaseController extends Controller
{
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
