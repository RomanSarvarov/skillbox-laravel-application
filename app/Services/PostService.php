<?php

namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Throwable;

class PostService
{
    /**
     * @param  PostRequest  $request
     * @param  Post|null  $post
     * @return Post|null
     * @throws Throwable
     */
    public function updateOrCreate(PostRequest $request, Post $post = null): Post
    {
        $post = $post ?: app(Post::class);

        $post->fill($request->except('tags'));

        $post->save();

        if ($request->has('tags')) {
            $post->syncTagsByTagNames(
                $request->tags
            );
        }

        return $post;
    }
}
