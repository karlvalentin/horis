<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Customer;
use App\Models\Entry;
use App\Models\Project;
use Illuminate\Database\Seeder;

/**
 * Database seeder.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);

        while (Customer::count() < 20) {
            try {
                Customer::factory()
                    ->create();
            } catch (\Exception $e) {
                //
            }
        }

        while (Project::count() < 20) {
            try {
                Project::factory()
                    ->create();
            } catch (\Exception $e) {
                //
            }
        }

        Activity::create(['name' => 'Entwicklung Backend'])
            ->save();

        Activity::create(['name' => 'Entwicklung Frontend'])
            ->save();

        $this->call(EntrySeeder::class);
    }
}
