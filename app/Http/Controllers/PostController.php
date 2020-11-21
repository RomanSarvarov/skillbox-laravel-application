<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\PostRepository;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Throwable;

class PostController extends Controller
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->middleware('auth')->except('show');
        $this->middleware('can:manipulate,post')->only(['edit', 'update', 'destroy']);

        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     * @throws \Exception
     */
    public function index()
    {
        $userId = auth()->id();

        $posts = cache()->tags('posts')->remember(
            "posts|user_$userId", now()->addHours(config('cache.default_hours')),
            function () use ($userId) {
                return $this->postRepository->getPostsByUserId($userId);
            }
        );

        return view('pages.base.homepage', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('pages.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @param  PostService  $postService
     * @return RedirectResponse|Redirector
     * @throws Throwable
     */
    public function store(PostRequest $request, PostService $postService)
    {
        $post = $postService->updateOrCreateFromRequest($request);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return Factory|View
     */
    public function show(Post $post)
    {
        return view('pages.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return Factory|View
     * @throws Throwable
     */
    public function edit(Post $post)
    {
        return view('pages.posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostRequest  $request
     * @param  Post  $post
     * @param  PostService  $postService
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(PostRequest $request, Post $post, PostService $postService): RedirectResponse
    {
        $postService->updateOrCreateFromRequest($request, $post);

        return redirect()->back()
            ->with('success', 'Post was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Успешно удалено!');
    }
}
