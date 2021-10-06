<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role([
            'name' => 'user'
        ]);
        $role->save();

        $role = new Role([
            'name' => 'manager'
        ]);
        $role->save();

        $role = new Role([
            'name' => 'admin'
        ]);
        $role->save();

        $user = new User([
            'name'=> 'superadmin',
            'password'=> bcrypt('password'),
            'email'=> 'sp@sp.com',
        ]);
        $user->save();
        $user->roles()->attach([1,2,3]);

    }
       
}
