<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function login(?string $role = "superadmin"): TestCase
    {
        $user = User::factory()->create();
        if ($role) {
            $user->assignRole($role);
        }
        $this->actingAs($user);

        return $this;
    }
}
