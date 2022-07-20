<?php

namespace Database\Seeders;

use App\Models\User;
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
            'email'         => '123',
            'password'      => config('auth.password'),
            'full_name'     => 'Christopher',
            'alias_name'    => 'christopher',
        ];
        $userDb = Sentinel::registerAndActivate( $credentials );

        #======Create Role=======
        Sentinel::getRoleRepository()->createModel()->create( [
            'name'       => 'Super Admin',
            'slug'       => 'admin',
        ])->users()->attach($userDb);
 
        Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'System Admin',
            'slug'       => 'system-admin',
            'permissions'=> config('permission'),
        ]);

        $employee = Sentinel::getRoleRepository()->createModel()->create([
            'name'       => 'Staff',
            'slug'       => 'staff',
            'permissions'=> config('permission'),
        ]);

        $employee->users()->attach(Sentinel::registerAndActivate(['email' => '456','password'   => config('auth.password'),'full_name' => 'Anthony', 'alias_name' => "Anton"]));
        $employee->users()->attach(Sentinel::registerAndActivate(['email' => '678','password'   => config('auth.password'),'full_name' => 'Christopher', 'alias_name' => "Chris"]));
 
  
        User::create([
            'email'         => '1231223',
            'password'      => config('auth.password'),
            'full_name'     => 'Mark Antony',
            'alias_name'    => 'mark',
            'department'    => 2,
        ]); 
    }
}