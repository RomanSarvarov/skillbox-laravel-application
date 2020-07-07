<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class RandomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 2)->create();

        $tags = factory(Tag::class, 5)->create();

        $posts = factory(Post::class, 20)
            ->create(['author_id' => fn() => $users->random()])
            ->each(function ($post) use ($tags) {
                $post
                    ->tags()
                    ->attach(
                        $tags->random(random_int(0, 5))
                    );
            });
    }
}
