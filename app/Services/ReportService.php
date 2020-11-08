<?php

namespace App\Services;

use App\Jobs\DispatchReportJob;
use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

/**
 * Class ReportService
 *
 * @todo sarv Дополнить описание класса.
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Services
 * @ctime 01.11.2020 23:44
 */
class ReportService
{
    /**
     * @var int
     */
    public const ITEM_NEWS = 1;

    /**
     * @var int
     */
    public const ITEM_POSTS = 2;

    /**
     * @var int
     */
    public const ITEM_COMMENTS = 3;

    /**
     * @var int
     */
    public const ITEM_TAGS = 4;

    /**
     * @var int
     */
    public const ITEM_USERS = 5;

    /**
     * Генерирует отчёт от правляет его пользователю.
     *
     * @param array $reportData
     * @param User $receiver
     * @return void
     */
    public function dispatch(array $reportData, User $receiver = null)
    {
        dispatch(
            new DispatchReportJob($reportData, $receiver ?: auth()->user())
        );
    }

    /**
     * @param int|null $item
     * @return array|string
     */
    public function getLabelBind(int $item = null)
    {
        $binds = [
            self::ITEM_NEWS => 'Новости',
            self::ITEM_POSTS => 'Статьи',
            self::ITEM_COMMENTS => 'Комментарии',
            self::ITEM_TAGS => 'Тэги',
            self::ITEM_USERS => 'Пользователи',
        ];

        if (! $item) {
            return $binds;
        }

        return $binds[$item] ?? null;
    }

    /**
     * @param int $item
     * @return array|string
     */
    protected function getModelBind(int $item = null)
    {
        $binds = [
            self::ITEM_NEWS => News::class,
            self::ITEM_POSTS => Post::class,
            self::ITEM_COMMENTS => Comment::class,
            self::ITEM_TAGS => Tag::class,
            self::ITEM_USERS => User::class,
        ];

        if (! $item) {
            return $binds;
        }

        return $binds[$item] ?? null;
    }

    /**
     * Генерирует отчёт.
     *
     * @param array $reportData
     * @return array
     */
    public function generateReport(array $reportData)
    {
        $report = [];

        foreach ($reportData as $needle) {
            $report[] = [
                'name' => $this->getLabelBind($needle),
                'count' => $this->getModelBind($needle)::count(),
            ];
        }

        return $report;
    }
}
