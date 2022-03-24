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
        
        #========Create User======
        $credentials = [
            'email'      => '123',
            'password'   => config('auth.password'),
            'first_name' => 'Christopher',
        ];
        $userDb = Sentinel::registerAndActivate( $credentials );

        #======Create Role=======
        Sentinel::getRoleRepository()->createModel()->create( [
            'name'       => 'Admin',
            'slug'       => 'admin',
        ])->users()->attach($userDb);

        Sentinel::getRoleRepository()->createModel()->create( [
            'name'       => 'User',
            'slug'       => 'user',
            'permissions'=> ['dashboard' => true],
        ] );

        $manager = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Manager',
            'slug'       => 'manager',
            'permissions'=> ["manager.dashboard" => true],
        ]);

        $employee = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Employee',
            'slug'       => 'employee',
            'permissions'=> ["employee.dashboard" => true],
        ]);

        $employee->users()->attach(Sentinel::registerAndActivate(['email' => '324','password'   => config('auth.password'),'first_name' => 'Anthony',]));
        $employee->users()->attach(Sentinel::registerAndActivate(['email' => '321','password'   => config('auth.password'),'first_name' => 'Christopher',]));
    }
}