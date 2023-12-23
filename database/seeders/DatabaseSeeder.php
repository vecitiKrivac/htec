<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CountrySeeder::class,
            CitySeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /*
        $message = 'Test message';
        $this->command->info($message);
        $this->command->line($message);
        $this->command->comment($message);
        $this->command->question($message);
        $this->command->error($message);
        $this->command->warn($message);
        $this->command->alert($message);
        */
    }
}
