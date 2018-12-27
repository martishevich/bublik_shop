<?php

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) {
	return [
		'name' => '123456',
		'email' => '123456@gmail.com',
		'password' => bcrypt('123456'),
		'remember_token' => str_random(10),
	];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
	
	return [
		'category_id' => $faker->numberBetween(1,5),
		'name' => $faker->words(3, true),
		'description' => $faker->paragraphs(3, true),
		'short_disc' => $faker->paragraph(),
		'price' => $faker->randomFloat(2,100,150000),
		'is_active' => $faker->numberBetween(0,1),
		'created_at' => $faker->dateTime()
	];
});
