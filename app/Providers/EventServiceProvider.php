<?php

namespace App\Providers;

use App\Events\Post\PostCreated;
use App\Events\Post\PostDeleted;
use App\Events\Post\PostUpdated;
use App\Listeners\Post\SendPostCreatedNotification;
use App\Listeners\Post\SendPostDeletedNotification;
use App\Listeners\Post\SendPostUpdatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PostCreated::class => [
            SendPostCreatedNotification::class,
        ],
        PostUpdated::class => [
            SendPostUpdatedNotification::class,
        ],
        PostDeleted::class => [
            SendPostDeletedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
