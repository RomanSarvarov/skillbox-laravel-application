<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Throwable;

class PostService
{
    /**
     * @param Request $request
     * @param Post|null $post
     * @param string $modelName
     * @return Post|null
     * @throws Throwable
     */
    public function updateOrCreateFromRequest(
        Request $request,
        Post $post = null,
        string $modelName = Post::class
    ): Post
    {
        $isEditAction = $post !== null;

        $post = $isEditAction ? $post : app($modelName);

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
