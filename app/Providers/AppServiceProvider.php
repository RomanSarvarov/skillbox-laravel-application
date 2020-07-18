<?php

namespace App\Providers;

use App\Contracts\Services\PushAll;
use App\Models\Post;
use App\Observers\PostObserver;
use App\Services\ThirdParty\PushAllService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $singletons = [
        PushAll::class => PushAllService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBlade();
        $this->bootObservers();
    }

    /**
     * Регистрация Blade аттрибутов и прочее.
     */
    protected function bootBlade()
    {
        \Blade::include('layout.includes.directives.post-edit-btn', 'postEditBtn');
        \Blade::include('layout.includes.directives.change-history', 'changeHistory');
    }

    /**
     * Регистрация слушателей моделей.
     */
    protected function bootObservers()
    {
        Post::observe(PostObserver::class);
    }
}
