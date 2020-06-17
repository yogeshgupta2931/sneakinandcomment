<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Comment;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->text(),
        'user_id' => User::all()->random()->id,
    ];
});
