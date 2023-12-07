<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            "name" => "iqbal atma muliawan",
            "email" => "iqbalatma@gmail.com",
            "email_verified_at" => now(),
            "password" => "admin"
        ]);
        $superadmin->assignRole(RoleEnum::SUPERADMIN->value);

        $admin = User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "email_verified_at" => now(),
            "password" => "admin"
        ]);
        $admin->assignRole(RoleEnum::ADMIN->value);

        User::factory()->count(100)->create();
    }
}
