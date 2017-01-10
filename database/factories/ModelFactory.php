<?php

use Faker\Generator;
use DOLucasDelivery\Models\User;
use DOLucasDelivery\Models\Category;
use DOLucasDelivery\Models\Product;
use DOLucasDelivery\Models\Client;
use DOLucasDelivery\Models\Order;
use DOLucasDelivery\Models\OrderItem;
use DOLucasDelivery\Models\Coupon;
use DOLucasDelivery\Models\OAuthClient;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Category::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(Product::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->numberBetween(10, 50)
    ];
});

$factory->define(Client::class, function (Generator $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => $faker->postcode
    ];
});

$factory->define(Order::class, function (Generator $faker) {
    return [
        'client_id' => rand(1, 10),
        //'user_deliveryman_id' => rand(11, 13),
        'total' => rand(50, 100),
        'status' => 0
    ];
});

$factory->define(OrderItem::class, function (Generator $faker) {
    return [

    ];
});

$factory->define(Coupon::class, function (Generator $faker) {
    return [
        'code' => rand(1000, 9999),
        'value' => rand(50, 100)
    ];
});

$factory->define(OAuthClient::class, function (Generator $faker) {
    return [

    ];
});