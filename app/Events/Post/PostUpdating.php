<?php

namespace App\Events\Post;

use App\Helpers\ModalMessageHelper;
use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class PostUpdating
 *
 * @todo sarv Дополнить описание класса.
 *
 * @author Roman Sarvarov <roman@sarvarov.dev>
 * @package App\Events\Post
 * @ctime 07.11.2020 20:29
 */
class PostUpdating implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Post
     */
    public Post $post;

    /**
     * @var array
     */
    public array $dirtyData;

    /**
     * Create a new event instance.
     *
     * @param  Post  $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->dirtyData = $post->getDirty();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.Admin');
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'events.post-updating';
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return ModalMessageHelper::postUpdatingModal(
            $this->post, $this->dirtyData
        );
    }

    /**
     * @return bool
     */
    public function broadcastWhen()
    {
        return $this->post->isDirty();
    }
}
