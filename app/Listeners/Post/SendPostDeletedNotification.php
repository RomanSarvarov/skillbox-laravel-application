<?php

namespace App\Listeners\Post;

use App\Events\Post\PostDeleted;
use App\Notifications\Post\PostDeleted as PostDeletedNotification;
use Notification;

class SendPostDeletedNotification
{
    /**
     * Handle the event.
     *
     * @param  PostDeleted  $event
     * @return void
     */
    public function handle(PostDeleted $event)
    {
        Notification::route('mail', config('app.admin_email'))->notify(new PostDeletedNotification($event->post));
    }
}
