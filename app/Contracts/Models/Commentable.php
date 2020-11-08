<?php

namespace App\Contracts\Models;

/**
 * Interface Commentable
 *
 * @todo sarv Дополнить описание интерфейса.
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Contracts\Models
 * @ctime 02.08.2020 15:06
 */
interface Commentable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments();
}