<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([ 
            'username'          => 'AdminTech',
            'password'          => Hash::make('agmtech.co.id'),
            'remember_token'    => str_random(10)

        ]);
    }
}
