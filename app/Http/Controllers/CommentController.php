<?php

namespace App\Http\Controllers;

use App\Contracts\Models\Commentable as CommentableContract;
use App\Http\Requests\CommentStoreRequest;
use App\Models\News;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CommentStoreRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function storePost(CommentStoreRequest $request, Post $post)
    {
        return $this->storeAction($request, $post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentStoreRequest $request
     * @param News $news
     * @return RedirectResponse
     */
    public function storeNews(CommentStoreRequest $request, News $news)
    {
        return $this->storeAction($request, $news);
    }

    /**
     * @param Request $request
     * @param CommentableContract $model
     * @return RedirectResponse
     */
    protected function storeAction(Request $request, CommentableContract $model)
    {
        $model->comments()->create(
            array_merge(
                $request->validated(),
                ['author_id' => auth()->id()],
            )
        );

        return back()->with('success', 'Комментарий был сохранён!');
    }

}
