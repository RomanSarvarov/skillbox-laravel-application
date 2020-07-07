<?php

namespace App\Providers;

use App\Contracts\Services\PushAll;
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
	    \Blade::include('layout.includes.directives.post-edit-btn', 'postEditBtn');
    }
}
