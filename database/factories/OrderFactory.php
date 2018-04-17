<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
    	'code' => $faker->uuid,
        'customer_id' => rand(1,50),
        'emission' => $faker->date,
        'total_order' => 0, 
        
    ];
});
