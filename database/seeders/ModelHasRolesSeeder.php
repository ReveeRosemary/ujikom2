<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 3],
            ['role_id' => 2, 'model_type' => 'App\Models\User', 'model_id' => 4],
        ];
        DB::table('model_has_roles')->insert($role);
    }
}
