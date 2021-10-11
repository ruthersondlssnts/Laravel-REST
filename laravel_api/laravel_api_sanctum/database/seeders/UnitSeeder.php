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
      
    }
}
