<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('');
        $this->command->info('Database seeding starting..');

        // \App\Models\User::factory(10)->create();
        $this->call([
                        UserSeeder::class,
                        ChannelSeeder::class,
                        VideoSeeder::class,
                    ]);
    }

}
