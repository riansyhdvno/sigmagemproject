<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            'full_name' => 'test',
            'email' => 'test@mail.com',
            'no_hp' => '0812345678',  
            'password' => 'test1234',
        ]);
    }
}
