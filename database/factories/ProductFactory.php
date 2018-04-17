<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {

	$name = $faker->unique->randomElement([
        'Arco Composto',
        'Metraladora',
        'Escudo',
        'Bomba Magnetica',
        'Katana',
        'Shuriken',
        'Teletransportador',
        'Torre',
        'Rocket Jump',
        'Martelo',
        'Amplificador Sônico',
        'Aniquilador Endotérmico',
        'Canhão de Mão',
        'Pistolas Eletromagnéticas',
        'Punho Biótico',
        'Mecha',
        'Bastão de Caduceu',
        'Mangual a Jato',
        
        
    ]);

     return [
     	
     	'code' => $faker->randomNumber($nbDigits = 4),
        'name' => $name,
        'price' => 50,
        
        
    ];
});
