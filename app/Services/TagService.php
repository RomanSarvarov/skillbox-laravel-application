<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTagsForCloud()
    {
        return cache()->tags(['tags', 'posts', 'news'])->remember(
            'tags_cloud', now()->addHours(
                config('cache.default_hours')
            ), function () {
                return Tag::has('posts')->orHas('news')->limit(20)->get();
            }
        );
    }
}
