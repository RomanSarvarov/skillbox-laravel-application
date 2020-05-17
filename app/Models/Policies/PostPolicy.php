<?php

namespace App\Models\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    public function manipulate(User $user, Post $post): Response
    {
        return $post->author_id === $user->id
            ? $this->allow()
            : $this->deny('У вас нет доступа к этой записи!')
        ;
    }
}
