<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use Iqbalatma\LaravelExtend\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function password()
    {
        return Attribute::make(set: fn ($value) => Hash::make($value));
    }
}
