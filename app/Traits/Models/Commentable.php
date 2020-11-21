<?php

namespace App\Traits\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @param bool $cache
     * @return Collection
     * @throws \Exception
     */
    public function getComments($cache = true)
    {
        if (! $cache) {
            return $this->comments;
        }

        return cache()->tags('comments')->remember(
            $this->getCommentsCacheKey(),
            now()->addHours(config('cache.default_hours')),
            function () {
                return $this->comments;
            }
        );
    }

    /**
     * @return string
     */
    public function getCommentsCacheKey()
    {
        return 'comments|' . get_class($this) . "|{$this->id}";
    }
}
