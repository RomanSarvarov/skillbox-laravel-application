<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function getTagCloud()
    {
        return Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(20)->get();
    }
}
