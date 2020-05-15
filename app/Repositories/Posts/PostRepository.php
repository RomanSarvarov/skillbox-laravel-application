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

    public function getPostsByUserId(int $userId = null)
    {
        $query = $this->startConditions()->with('tags');

        if ($userId !== null) {
            $query->where('author_id', $userId);
        }

        return $query->get();
    }
}
