<?php

namespace App\Services;

use App\Models\News;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class StatisticsService
 *
 * @todo sarv Дополнить описание класса.
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Services
 * @ctime 02.08.2020 15:20
 */
class StatisticsService
{
    /**
     * @return array
     * @throws \Exception
     */
    public function generateReport()
    {
        return cache()->tags(['posts', 'news', 'comments'])->remember(
            'statistics',
            now()->addHours(config('cache.default_hours')),
            function () {
                $data = [];

                /* Общее количество статей */
                $data[] = ['parameter' => 'Общее количество статей', 'value' => Post::count()];

                /* Общее количество новостей */
                $data[] = ['parameter' => 'Общее количество новостей', 'value' => News::count()];

                /* Самый популярный автор статей */
                /** @var User $userWithMaxPosts */
                $userWithMaxPosts = User::has('news')
                    ->withCount('news')
                    ->orderByDesc('news_count')
                    ->first();

                $data[] = [
                    'parameter' => 'Больше всего статей у',
                    'value' => "{$userWithMaxPosts->name} (ID: $userWithMaxPosts->id)",
                ];

                /* Самая длинная статья */
                /** @var Post $postWithMaxContentLength */
                $postWithMaxContentLength = Post::orderByRaw('CHAR_LENGTH(content) DESC')->first();

                $data[] = [
                    'parameter' => 'Самая длинная статья',
                    'value' => sprintf(
                        '<a href="%s">%s</a> (длина: %d)',
                        $postWithMaxContentLength->url,
                        $postWithMaxContentLength->title,
                        mb_strlen($postWithMaxContentLength->content)
                    ),
                ];

                /* Самая короткая статья */
                /** @var Post $postWithMinContentLength */
                $postWithMinContentLength = Post::orderByRaw('CHAR_LENGTH(content)')->first();

                $data[] = [
                    'parameter' => 'Самая короткая статья',
                    'value' => sprintf(
                        '<a href="%s">%s</a> (длина: %d)',
                        $postWithMinContentLength->url,
                        $postWithMinContentLength->title,
                        mb_strlen($postWithMinContentLength->content)
                    ),
                ];

                /* Среднее количество статей у “активных” пользователей */
                $averagePostByActiveUsersCount = Post::whereHas('author', function (Builder $query) {
                    $query->has('posts', '>', 1);
                })->groupBy('author_id')
                    ->selectRaw('count(*) as count')
                    ->get()
                    ->avg('count');

                $data[] = [
                    'parameter' => 'Среднее количество статей у активных пользователей',
                    'value' => $averagePostByActiveUsersCount,
                ];

                /* Самая обновляемая статья */
                $postWithMostUpdates = Post::has('history')
                    ->withCount('history')
                    ->orderByDesc('history_count')
                    ->first();

                $data[] = [
                    'parameter' => 'Самая обновляемая статья',
                    'value' => sprintf(
                        '<a href="%s">%s</a> (обновлений: %d)',
                        $postWithMostUpdates->url,
                        $postWithMostUpdates->title,
                        $postWithMostUpdates->history_count
                    ),
                ];

                /* Самая обсуждаемая статья */
                $postWithMostComments = Post::has('comments')
                    ->withCount('comments')
                    ->orderByDesc('comments_count')
                    ->first();

                $data[] = [
                    'parameter' => 'Самая обсуждаемая статья',
                    'value' => sprintf(
                        '<a href="%s">%s</a> (комментариев: %d)',
                        $postWithMostComments->url,
                        $postWithMostComments->title,
                        $postWithMostComments->comments_count
                    ),
                ];

                return $data;
            }
        );
    }
}
