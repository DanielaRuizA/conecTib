<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
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
        

        $countries = Country::factory(50)->create();

        foreach ($countries as $country) {
            $states = State::factory(2)->create([
                'country_id' => $country->id,
            ]);

            foreach ($states as $state) {
                City::factory(1)->create([
                    'state_id' => $state->id,
                ]);
            }
        }
    }
}
