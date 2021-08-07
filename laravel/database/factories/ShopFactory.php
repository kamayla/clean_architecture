<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Shop::class, function (Faker $faker) {
    $user = factory(User::class)->create();

    return [
        'id' => Str::orderedUuid()->toString(),
        'name' => $faker->name,
        'user_id' => $user->id,
    ];
});
