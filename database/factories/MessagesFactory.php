<?php

use Faker\Generator as Faker;
use App\User;
use App\Message;

$factory->define(Message::class, function (Faker $faker) {
    do {
        $from = $faker->numberBetween(1, User::count());
        $to   = $faker->numberBetween(1, User::count());
    } while ($from == $to);

    return [
        'from'  =>  $from,
        'to'    =>  $to,
        'text'  =>  $faker->sentence()
    ];
});
