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

            'name' => 'carlos',
            'username' => 'carlos',
            'rol' => 'normal',
            'email' => '',
            'password' => bcrypt('123456'),
            'api_token' => str_random(60),
            'role_id' => 2,
        ]

    ]);
        
        ;

           
    }
}
