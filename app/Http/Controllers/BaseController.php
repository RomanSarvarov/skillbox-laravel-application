<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PostRepository;
use App\Services\StatisticsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class BaseController extends Controller
{
    /**
     * @param PostRepository $postRepository
     * @return Factory|View
     * @throws \Exception
     */
    public function index(PostRepository $postRepository)
    {
        $posts = cache()->tags(['posts', 'comments', 'tags'])->remember(
            "posts_index", now()->addHours(config('cache.default_hours')),
            function () use ($postRepository) {
                return $postRepository->getPostsForLoop();
            }
        );

        return view('pages.base.homepage', compact('posts'));
    }

    /**
     * @return Factory|View
     */
    public function about()
    {
        return view('pages.base.about');
    }

    /**
     * @param StatisticsService $statisticsService
     * @return Factory|View
     */
    public function statistics(StatisticsService $statisticsService)
    {
        return view('pages.base.statistics')
            ->withReport($statisticsService->generateReport());
    }
}
