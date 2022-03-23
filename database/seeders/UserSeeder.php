<?php

namespace Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $credentials = [
            'email'      => '123',
            'password'   => config('auth.password'),
            'first_name' => 'admin',
            'last_name'  => 'user'
        ];
        $userDb = Sentinel::registerAndActivate( $credentials );
    }
}