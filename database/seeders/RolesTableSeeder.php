<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Roles::create([
            'id'	=> 1,
            'role'	=> 'Senior HRD',
        ]);

        \App\Models\Roles::create([
            'id'	=> 2,
            'role'	=> 'HRD',
        ]);
    }
}
