<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class Newsletter extends Notification
{
    use Queueable;

    /**
     * @var Collection
     */
    protected $posts = [];

    /**
     * @var int
     */
    protected $days;

    /**
     * Create a new notification instance.
     *
     * @param  Collection  $posts
     * @param  int  $days
     */
    public function __construct(Collection $posts, int $days)
    {
        $this->posts = $posts;
        $this->days = $days;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $msg = (new MailMessage)
            ->subject('Новиночки за ' . trans_choice(':count день|:count дней', $this->days))
            ->greeting('Новые записи:');

        $this->posts->each(function ($post) use ($msg) {
            $msg->line(
                sprintf(
                    '* [%1$s](%2$s)',
                    $post->title,
                    route('posts.show', ['post' => $post])
                )
            );
        });

        return $msg;
    }
}
