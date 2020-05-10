<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Throwable;

class PostService
{
    /**
     * @param  FormRequest  $request
     * @param  Post|null  $post
     * @return Post|null
     * @throws Throwable
     */
    public function updateOrCreate(FormRequest $request, Post $post = null): Post
    {
        $post = $post ?: app(Post::class);

        $post->fill($request->except('tags'));

        $post->save();

        if ($request->has('tags')) {
            $post->attachTags(
                $request->input('tags')
            );
        }

        return $post;
    }
}
