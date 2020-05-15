<?php

namespace App\Repositories\Posts;

interface PostRepositoryInterface
{
    public function getPostsForLoop();
    public function getPostsByUserId(int $userId);
}
