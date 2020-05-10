<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\TagService;

class BaseController extends Controller
{
    public function about()
    {
        return view('pages.base.about');
    }
}
