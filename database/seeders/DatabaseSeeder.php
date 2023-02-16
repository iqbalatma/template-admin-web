<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Iqbalatma\LaravelTelegramBotChannelAsync\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Log::notice("Database seeder is running");
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class
        ]);
        // $this->call([
        //     UserSeeder::class,
        // ]);
    }
}
