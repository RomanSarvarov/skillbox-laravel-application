<?php

namespace App\Providers\EventRegisters;

use App\Events\Post\PostCreated;
use App\Events\Post\PostDeleted;
use App\Events\Post\PostUpdated;
use App\Listeners\Post\SendPostCreatedNotification;
use App\Listeners\Post\SendPostDeletedNotification;
use App\Listeners\Post\SendPostUpdatedNotification;

class PostEvents extends AbstractEventRegister
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
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
}
