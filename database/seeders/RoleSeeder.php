<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            ['id' => 1, 'name' => 'Admin', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'Seller', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'Buyer', 'guard_name' => 'web', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];
        DB::table('roles')->insert($role);
    }
}
