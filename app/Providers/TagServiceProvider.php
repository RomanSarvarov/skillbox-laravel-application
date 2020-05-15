<?php

namespace App\Providers;

use App\Http\View\Composers\TagsCloudComposer;
use App\Services\TagService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View as ViewFacade;

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
     * @return void
     */
    public function boot()
    {
        ViewFacade::composer('layout.includes.tags-cloud', TagsCloudComposer::class);
    }
}
