<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class,2)->create();

        DB::table('users')->insert([
           [
            'name' => 'admin',
            'username' => 'admin',
            'rol' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'api_token' => str_random(60),
            'role_id' => 1,
        ],
        [

            'name' => 'cristoffer',
            'username' => 'cristoffer',
            'rol' => 'normal',
            'email' => 'cristoffer@gmail.com',
            'password' => bcrypt('123456'),
            'api_token' => str_random(60),
            'role_id' => 2,
        ]

    ]);


    factory(App\User::class,10)->create();

    $i=10;
    for ($i=0; $i < 10; $i++) { 
        factory(App\Worker::class,1)->create();

        } 
  

           
    }
}
