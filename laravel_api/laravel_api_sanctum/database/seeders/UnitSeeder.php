<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Country Branches
        $unit = new Unit([
            'name' => 'Philippines',
            'selectable'=> false
        ]);
        $unit->save();
        $unit = new Unit([
            'name' => 'USA',
            'selectable'=> false
        ]);
        $unit->save();
        //City Branches
        $unit = new Unit([
            'name' => 'Manila',
            'ascendants' => '1,',
            'selectable'=> false
        ]);
        $unit->save();
        $unit = new Unit([
            'name' => 'Davao',
            'ascendants' => '1,',
            'selectable'=> false

        ]);
        $unit->save();
        $unit = new Unit([
            'name' => 'IT',
            'ascendants' => '1,3,',
            'selectable'=> true

        ]);
        $unit->save();
        $unit = new Unit([
            'name' => 'HR',
            'ascendants' => '1,3,',
            'selectable'=> true
        ]);
        $unit->save();
        $unit = new Unit([
            'name' => 'Marketing',
            'ascendants' => '1,3,',
            'selectable'=> true
        ]);
        $unit->save();
    }
}
