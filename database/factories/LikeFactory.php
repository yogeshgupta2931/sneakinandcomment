<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'comment_id' => Comment::all()->random()->id,
        'user_id' => User::all()->random()->id,
    ];
});
