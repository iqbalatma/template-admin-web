<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public const DATA_USER = [
        [
            "name" => "iqbal atma muliawan",
            "email" => "iqbalatma@gmail.com",
            "email_verified_at" => "2023-12-31 08:38:35",
            "password" => "admin"
        ],
        [
            "name" => "admin",
            "email" => "admin@gmail.com",
            "email_verified_at" => "2023-12-31 08:38:35",
            "password" => "admin"
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::DATA_USER as $key => $user) {
            $user["password"] = Hash::make($user["password"]);
            $createdUser = User::create($user);

            if ($createdUser->email === "iqbalatma@gmail.com") {
                $createdUser->assignRole(Role::SUPERADMIN->value);
            }

            if ($createdUser->email === "admin@gmail.com") {
                $createdUser->assignRole(Role::ADMIN->value);
            }
        }

        User::factory()->count(100)->create();
    }
}
