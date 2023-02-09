<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataRole = [
            [
                'name' => 'Superadmin',
            ],
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Operator',
            ],
        ];

        foreach ($dataRole as $key => $role) {
            Role::create($role);
        }
    }
}
