<?php

namespace App\Contracts\Repositories;

interface PostRepository
{
    public function getPostsForLoop();
    public function getPostsByUserId(int $userId);
}
