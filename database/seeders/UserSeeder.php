<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Ensure you include the User model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'toko_id' => null, // Admin doesn't have a toko_id
            ],
            // [
            //     'name' => 'Toko 1',
            //     'email' => 'toko1@gmail.com',
            //     'password' => Hash::make('password'),
            //     'role' => 'seller',
            //     'toko_id' => 1, // Assign toko_id to Toko 1
            // ],
            // [
            //     'name' => 'Toko 2',
            //     'email' => 'toko2@gmail.com',
            //     'password' => Hash::make('password'),
            //     'role' => 'seller',
            //     'toko_id' => 2, // Assign toko_id to Toko 2
            // ],
            [
                'name' => 'Buyer',
                'email' => 'buyer@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'buyer',
                'toko_id' => null, // Buyer doesn't have a toko_id
            ],
        ];
    
        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // Unique identifier for the user
                [
                    'name' => $user['name'],
                    'password' => $user['password'],
                    'role' => $user['role'],
                    // 'toko_id' => $user['toko_id'], // Set toko_id if available, null for others
                ]
            );
        }
    }    
    
}
