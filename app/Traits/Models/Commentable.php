<?php

namespace App\Traits\Models;

use App\Models\Comment;

/**
 * Class Commentable
 *
 * @todo sarv Дополнить описание класса.
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Traits\Models
 * @ctime 02.08.2020 14:15
 */
trait Commentable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
