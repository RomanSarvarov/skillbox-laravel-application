<?php

namespace App\Models\Policies;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class NewsPolicy
{
    use HandlesAuthorization;

    public function manipulate(User $user, News $news): Response
    {
        return $news->author_id === $user->id
            ? $this->allow()
            : $this->deny('У вас нет доступа к этой новости!');
    }
}
