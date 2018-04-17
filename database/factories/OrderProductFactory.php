<?php

use Faker\Generator as Faker;



$factory->define(App\OrderProduct::class, function (Faker $faker) {
    
    return 
    	[
        'order_id' => rand(1,50),
        'product_id' => rand(1,50),
        'quantity' => rand(1),
        'discount' => 10,
      	'total' => 0,  
    	];

});
