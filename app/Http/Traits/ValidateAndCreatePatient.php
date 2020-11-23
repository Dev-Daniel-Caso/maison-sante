<?php

namespace App\Http\Traits;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Traits\ValidateAndCreatePatient;

trait ValidateAndCreatePatient
{
    protected function validator(array $data)
    {
        return Validator::make($data, User::$rules);
    }

    protected function create(array $data)
    {
        return User::createPatient($data);
    }
}
