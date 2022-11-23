<?php

namespace Database\Seeders;

use App\Models\Roles;
use App\Models\RoleUsers;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #========Create ADmin======
        $Admin = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Admin',
            'slug'       => 'admin',
        ]);

        $SuperAdmin = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Super Admin',
            'slug'       => 'SuperAdmin',
        ]);

        $Admin->users()->attach(Sentinel::registerAndActivate([
            'email'      => '123',
            'password'   => config('auth.password'),
            'full_name'  => 'Alexia',
            'alias_name' => "Alexia Caleb",
            'department' => 1
        ]));

        $SuperAdmin->users()->attach(Sentinel::registerAndActivate([
            'email'      => '12345678',
            'password'   => config('auth.password'),
            'full_name'  => 'Developer',
            'alias_name' => "Developer",
            'department' => 1
        ]));
 
        #========Create Staff====== 

        $employee = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Staff',
            'slug'       => 'staff',
            'permissions'=> config('permission'),
        ]);
        
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => '456',
            'password'   => config('auth.password'),
            'full_name'  => 'Caleb',
            'alias_name' => "Caleb",
            'department' => 1
        ]));
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => '654',
            'password'   => config('auth.password'),
            'full_name'  => 'Cheng',
            'alias_name' => "Cheng",
            'department' => 1
        ]));
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => '321',
            'password'   => config('auth.password'),
            'full_name'  => 'Derrik',
            'alias_name' => "Derrik",
            'department' => 1
        ]));
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => '789',
            'password'   => config('auth.password'),
            'full_name'  => 'Desmond',
            'alias_name' => "Desmond",
            'department' => 2
        ]));
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => '987',
            'password'   => config('auth.password'),
            'full_name'  => 'Dalton',
            'alias_name' => "Dalton",
            'department' => 2
        ]));
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => '741',
            'password'   => config('auth.password'),
            'full_name'  => 'Dale',
            'alias_name' => "Dale",
            'department' => 2
        ]));
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => '852',
            'password'   => config('auth.password'),
            'full_name'  => 'Daylen',
            'alias_name' => "Daylen",
            'department' => 2
        ]));
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => '1654',
            'password'   => config('auth.password'),
            'full_name'  => 'Desmond',
            'alias_name' => "Desmond",
            'department' => 3
        ]));
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => '7523',
            'password'   => config('auth.password'),
            'full_name'  => 'Kenneth',
            'alias_name' => "Kenneth",
            'department' => 3
        ]));
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => '321478',
            'password'   => config('auth.password'),
            'full_name'  => 'Joseph',
            'alias_name' => "Joseph",
            'department' => 3
        ]));
    }
}