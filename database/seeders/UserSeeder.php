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
            'name'       => 'Super Admin',
            'slug'       => 'admin',
        ]);

        $SuperAdmin = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Dso Admin',
            'slug'       => 'dso-admin',
        ]);

        $Admin->users()->attach(Sentinel::registerAndActivate([
            'email'      => '123',
            'password'   => config('auth.password'),
            'full_name'  => 'Alexia',
            'alias_name' => "Alexia Caleb",
            'department' => 1
        ]));

        $SuperAdmin->users()->attach(Sentinel::registerAndActivate([
            'email'      => 'DSOPw#456',
            'password'   => config('auth.password'),
            'full_name'  => 'Shizuka',
            'alias_name' => "Shizuka",
            'department' => 1
        ]));
 
        #========Create Staff====== 

        $employee = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Staff',
            'slug'       => 'staff',
            'permissions'=> config('permission'),
        ]);
        
        $employee->users()->attach(Sentinel::registerAndActivate([
            'email'      => 'DSOPwStaff@234',
            'password'   => config('auth.password'),
            'full_name'  => 'Himawari Nohara',
            'alias_name' => "Himawari Nohara",
            'department' => 1
        ]));
    }
}