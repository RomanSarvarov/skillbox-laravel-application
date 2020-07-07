<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Repositories\Posts\PostRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Notification;
use App\Notifications\Newsletter as NewsletterNotification;

class Newsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:run {days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a newsletter';

    /**
     * @var PostRepository
     */
    protected PostRepository $postRepository;

    /**
     * Create a new command instance.
     *
     * @param  PostRepository  $postRepository
     * @param  int  $days
     */
    public function __construct(PostRepository $postRepository)
    {
        parent::__construct();

        $this->postRepository = $postRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Throwable
     */
    public function handle()
    {
        $days = (int) $this->argument('days');

        throw_unless(
            $days,
            \InvalidArgumentException::class,
            'Введите правильное кол-во дней!'
        );

        /**
         * @var Collection $users
         * @var Collection $posts
         */
        $users = User::all();
        $posts = $this->postRepository->getLatestPostsForPeriod($days);

        if ($posts->isEmpty()) {
            $this->info('За выбранный период времени нету постов для рассылки!');

            return;
        }

        Notification::send(
            $users,
            new NewsletterNotification($posts, $days)
        );

        $this->line(
            'Рассылка о новых записях (' . $posts->count() . ') отправлена '
            . trans_choice(':count пользователю|:count пользователям', $users->count())
        );
    }
}
