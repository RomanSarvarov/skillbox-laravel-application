<?php

namespace App\Gates;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostGate
{
    public function update(User $user, Post $post)
    {
        return true;
    }
}
