<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddRolesToRolesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'name' => 'Administrator'],
            ['id' => 2, 'name' => 'Moderator'],
            ['id' => 3, 'name' => 'Reader']
        ]);
    }
}