<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Post $post)
    {
        return $user->id === 2 ? Response::allow() : Response::deny('Test');
    }

    public function delete(User $user, Post $post)
    {
        return $post->author_id === $user->id;
    }

}
