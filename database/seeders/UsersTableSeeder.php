<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'testuser',
        //     'email' => 'testuser@testuser.com',
        //     'password' => Hash::make('testuser')
        // ]);

        for ($i=0; $i < 10; $i++) {
            User::create([
                'name' => 'testuser'.$i,
                'email' => 'testuser'.$i.'@testuser.com',
                'password' => 'testuser'
            ]);
        }
    }
}
