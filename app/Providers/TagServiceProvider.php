<?php

namespace App\Providers;

use App\Services\TagService;
use Illuminate\Support\ServiceProvider;
use View;

class TagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @param  TagService  $tagService
     * @return void
     */
    public function boot(TagService $tagService)
    {
        View::composer('layout.template-parts.sidebar', function (\Illuminate\View\View $view) use ($tagService) {
            $view->with('tagsCloud', $tagService->getTagsForCloud());
        });
    }
}
