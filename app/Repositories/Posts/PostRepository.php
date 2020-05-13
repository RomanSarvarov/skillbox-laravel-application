<?php

namespace App\Repositories\Posts;

use App\Models\Post;
use App\Repositories\AbstractRepository;

class PostRepository extends AbstractRepository implements PostRepositoryInterface
{
    protected function getModelClass(): string
    {
        return Post::class;
    }

    public function getPostsForLoop()
    {
        return $this->startConditions()->with('tags')->get();
    }
}
