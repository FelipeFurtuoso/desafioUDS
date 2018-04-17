<?php

use Faker\Generator as Faker;



$factory->define(App\Customer::class, function (Faker $faker) {
	$name = $faker->unique->randomElement([
        'Hanzo Shimada',
        'Jesse McCree',
        'Fareeha Amari',
        'Gabriel',
        'Genji Shimada',
        'Morrison',
        'Lena Oxton',
        'Autômato de Cerco E54',
        'Jamison Fawkes',
        'Mei-Ling Zhou',
        'Torbjörn Lindholm',
        'Amélie Lacroix',
        'Hana Song',
        'Orisa',
        'Reinhardt Wilhelm',
        'Mako Rutledge',
        'Winston',
        'Aleksandra Zaryanova',
        'Ana Amari',
        'Lúcio Correia dos Santos',
        'Angela Ziegler',
        'Satya Vaswani',
        'Tekhartha Zenyatta',
        'Olivia Colomar',
        'Brigitte Lindholm',
        'Akande Ogundimu',
        'Moira O Deorain',
        
    ]);
	
    return [
        'name' => $name,
        'cpf' => $faker->cpf(false),
        'birthdate' => $faker->date, 
        
    ];
});
