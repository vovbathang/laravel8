<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\Tag;
use App\User;
use App\Category;
use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'order' => rand(-100, 100),
        'parent' => 0
    ];
});

$factory->define(Tag::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'name' => $name,
        'slug' => str_slug($name),
    ];
});

$factory->define(Order::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'user_id' => rand(1, 50),
        'address' => $faker->text(80),
        'email' =>$faker->email,
        'phone'=>$faker->phoneNumber
    ];
});

$factory->define(Product::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'code'=>strtoupper( str_random(6)),
        'content'=>$faker->text,
        'regular_price'=> rand(2001, 3000),
        'sale_price' => rand(1001, 2000),
        'original_price' => rand(1, 1000),
        'quantity'=> rand(1, 100),
        'attributes' => '',
        'image' => '',
        'user_id' => rand(1, 50),
        'category_id' => rand(1, 50)
    ];
});


