<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TagService;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        return view('pages.tag.show')->with('tag', $tag);
    }
}
