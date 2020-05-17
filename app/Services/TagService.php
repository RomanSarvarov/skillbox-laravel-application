<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function getTagsForCloud()
    {
        return Tag::has('posts')->limit(20)->get();
    }
}
