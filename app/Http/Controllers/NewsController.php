<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Repositories\Posts\NewsRepository;
use App\Services\PostService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @var NewsRepository
     */
    private NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->middleware('auth')->except('show');
        $this->middleware('can:manipulate,news')->only(['edit', 'update', 'destroy']);

        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $userId = auth()->id();

        $news = cache()->tags('news')->remember(
            "news|user_$userId", now()->addHours(config('cache.default_hours')),
            function () use ($userId) {
                return $this->newsRepository->getPostsByUserId($userId);
            }
        );

        return view('pages.news.index')->withNews($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsRequest $request
     * @param PostService $postService
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(NewsRequest $request, PostService $postService)
    {
        $news = $postService->updateOrCreateFromRequest($request, null, News::class);

        return redirect()->route('news.show', $news)
            ->with('success', 'News was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('pages.news.show')->withNews($news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('pages.news.edit')->withNews($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\News $news
     * @param PostService $postService
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function update(NewsRequest $request, News $news, PostService $postService)
    {
        $postService->updateOrCreateFromRequest($request, $news, News::class);

        return redirect()->back()
            ->with('success', 'News was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Успешно удалено!');
    }
}
