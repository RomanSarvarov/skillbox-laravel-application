<?php

namespace App\Listeners\Post;

use App\Events\Post\PostUpdated;
use App\Notifications\Post\PostUpdated as PostUpdatedNotification;
use Notification;

class SendPostUpdatedNotification
{
    /**
     * Handle the event.
     *
     * @param  PostUpdated  $event
     * @return void
     */
    public function handle(PostUpdated $event)
    {
        Notification::route('mail', config('app.admin_email'))->notify(new PostUpdatedNotification($event->post));
    }
}
