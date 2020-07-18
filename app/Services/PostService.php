<?php

namespace App\Services;

use App\Events\Post\PostCreated;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Throwable;

class PostService
{
    /**
     * @param  PostRequest  $request
     * @param  Post|null  $post
     * @return Post|null
     * @throws Throwable
     */
    public function updateOrCreateFromRequest(PostRequest $request, Post $post = null): Post
    {
        $isEditAction = $post !== null;

        $post = $isEditAction ? $post : app(Post::class);
        $post->fill($request->except('tags'));
        if (!$isEditAction) {
            $post->author_id = optional($request->user())->id;
        }
        $post->save();

        if ($request->has('tags')) {
            /** @var array $requestTags */
            $requestTags = $request->tags;

            $post->syncTagsByTagNames($requestTags);
        }

        return $post;
    }
}
