<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    
    $title = $faker->realText(67);
    return [
        'title' => $title,
        'slug'=> Str::slug($title,'-'),
        'content' => $faker->text,
        'active' => $faker->boolean,
    ];
});
