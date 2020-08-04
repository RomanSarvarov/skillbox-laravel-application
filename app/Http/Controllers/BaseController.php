<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PostRepository;
use App\Services\StatisticsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class BaseController extends Controller
{
    /**
     * @param  PostRepository  $postRepository
     * @return Factory|View
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->getPostsForLoop();

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
