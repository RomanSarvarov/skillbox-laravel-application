<?php

namespace App\Gates;

use App\Models\Post;
use App\Models\User;

class PostGate
{
    public function update(User $user, Post $post)
    {
        return true;
    }
}
