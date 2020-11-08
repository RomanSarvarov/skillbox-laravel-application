<?php

namespace App\Repositories\Posts;

use App\Models\News;

/**
 * Class PostRepository
 *
 * Используется исключительно для получения данных по новостям из БД.
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Repositories\Posts
 * @ctime 12.07.2020 11:26
 */
class NewsRepository extends PostRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return News::class;
    }
}
