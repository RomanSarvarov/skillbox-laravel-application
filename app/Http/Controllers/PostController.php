<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('pages.base.homepage')
            ->with('posts', Post::latest()->get());
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
        $post = $postService->updateOrCreate($request);

        return redirect()->route('posts.show', $post, false);
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
        $postService->updateOrCreate($request, $post);

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
