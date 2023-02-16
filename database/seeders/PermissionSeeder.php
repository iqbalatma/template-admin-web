<?php

namespace Database\Seeders;

use App\Statics\PermissionStatic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        foreach (PermissionStatic::PERMISSIONS as $item) {
            Permission::create($item);
        }
        foreach (PermissionStatic::ROLES as $item) {
            Permission::create($item);
        }
    }
}
