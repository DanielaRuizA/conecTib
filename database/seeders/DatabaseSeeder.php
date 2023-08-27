<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        //datos del administrador para iniciar sesión
        User::factory()->create([
            'name' => 'administrador',
            'email' => 'conectib@admin.com',
            'password' => bcrypt('Ab@12345678'),
        ])->assignRole('admin');

        //crear 100 usuarios
        User::factory(100)->create();

        //para que se creen las ciudades, departamentos y ciudades.
        $countries = Country::factory(50)->create();

        foreach ($countries as $country) {
            $states = State::factory(10)->create([
                'country_id' => $country->id,
            ]);

            foreach ($states as $state) {
                City::factory(15)->create([
                    'state_id' => $state->id,
                ]);
            }
        }
    }
}
