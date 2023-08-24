<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        User::factory()->create([
        'name' => 'admi1',
        'email' => 'i@admin.com',
        'password' => bcrypt('123456'),
        ])->assignRole('admin');
        
        User::factory(100)->create();
    }
}
