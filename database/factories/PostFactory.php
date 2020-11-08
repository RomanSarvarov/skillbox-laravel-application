<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'slug' => $faker->unique()->slug,
        'title' => $faker->words(3, true),
        'description' => $faker->words(10, true),
        'content' => $faker->text(500),
        'is_posted' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
