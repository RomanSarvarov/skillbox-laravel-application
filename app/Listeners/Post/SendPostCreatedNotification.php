<?php

namespace App\Listeners\Post;

use App\Events\Post\PostCreated as PostCreatedEvent;
use App\Notifications\Post\PostCreated as PostCreatedNotification;
use Notification;

class SendPostCreatedNotification
{
    /**
     * Handle the event.
     *
     * @param  PostCreatedEvent  $event
     * @return void
     */
    public function handle(PostCreatedEvent $event)
    {
        Notification::route('mail', config('app.admin_email'))->notify(new PostCreatedNotification($event->post));
    }
}
