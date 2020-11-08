<?php

namespace App\Repositories\Posts;

use App\Contracts\Repositories\PostRepository as PostRepositoryContract;
use App\Models\Post;
use App\Repositories\AbstractRepository;

/**
 * Class PostRepository
 *
 * Используется исключительно для получения данных по записям из БД.
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Repositories\Posts
 * @ctime 12.07.2020 11:26
 */
class PostRepository extends AbstractRepository implements PostRepositoryContract
{
    /**
     * @return mixed
     */
    public function getPostsForLoop()
    {
        return $this->startConditions()
                    ->with('tags')
                    ->posted()
                    ->latest()
                    ->get();
    }

    /**
     * @param  int|null  $userId
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPostsByUserId(int $userId = null)
    {
        $query = $this->startConditions()->with('tags');

        if ($userId !== null) {
            $query->where('author_id', $userId);
        }

        return $query->get();
    }

    /**
     * @param  int  $days
     *
     * @return mixed
     */
    public function getLatestPostsForPeriod(int $days)
    {
        $dateSince = today()->subDays($days);

        return $this->startConditions()
                    ->where('created_at', '>=', $dateSince)
                    ->get();
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Post::class;
    }
}
