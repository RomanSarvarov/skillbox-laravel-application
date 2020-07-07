<?php

namespace App\Listeners\Post;

use App\Contracts\Services\PushAll;
use App\Events\Post\PostCreated as PostCreatedEvent;

class SendPostCreatedPushNotification
{
    /**
     * @var PushAll
     */
    protected PushAll $pushAllService;

    /**
     * Create the event listener.
     *
     * @param PushAll $pushAllService
     */
    public function __construct(PushAll $pushAllService)
    {
        $this->pushAllService = $pushAllService;
    }

    /**
     * Handle the event.
     *
     * @param PostCreatedEvent $event
     * @return void
     */
    public function handle(PostCreatedEvent $event)
    {
        $this->pushAllService->send(
            'Новый пост вышел!',
            $event->post->title,
            route('posts.show', ['post' => $event->post])
        );
    }
}
