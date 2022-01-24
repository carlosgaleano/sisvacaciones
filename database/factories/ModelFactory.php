<?php

use App\Helpers\MyHelper;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


use App\User;
use App\Worker;


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



 

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->username,
        'rol' => 'normal',
        'email' => $faker->safeEmail,
        'password' => bcrypt('123456'),
        'api_token' => str_random(50),
        'remember_token' => str_random(10),
        'role_id' => 2,
    ];
});


$factory->define(App\Worker::class, function (Faker\Generator $faker, $datos) {
  
    
    $faker2 = Faker\Factory::create();

    return [
        'name' => $faker->name,
        'ci' => $faker->ean8,       
        'email' => $faker->email,
        'position' => $faker->jobTitle,
        'photo'=>'/img/tmp/1642537106-myAvatar.png',
        'date_in'=> $faker->dateTimeBetween('-3 years', '-1 years'),
        'area_id' => $faker->numberBetween(1,10),
        'user_id' => MyHelper::getIdUser(),
        'state'=>1,
     /*    'date_in' => $faker->date_in,,
        'date_out' => $faker->date_out,
        'area_id' => $faker->area_id,
        'user_id' => $faker->user_id,
       */
    ];
});