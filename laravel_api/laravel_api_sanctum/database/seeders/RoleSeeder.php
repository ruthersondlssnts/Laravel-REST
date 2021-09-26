<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

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
            'name' => 'Admin'
        ]);
        $role->save();
        $role = new Role([
            'name' => 'Manager'
        ]);
        $role->save();
        $role = new Role([
            'name' => 'User'
        ]);
        $role->save();
    }
}
