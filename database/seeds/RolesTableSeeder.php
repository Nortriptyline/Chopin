<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Administrateur', 'access_level' => 0],
            ['name' => 'Utilisateur', 'access_level' => 1],
        ];
        //
        DB::table('roles')->insert($roles);
    }
}
