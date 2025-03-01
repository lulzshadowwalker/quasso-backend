<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\GuestResource;
use App\Models\Guest;

class AuthController extends ApiController
{
    public function guest()
    {
        $guest = Guest::create();

        $token = $guest->createToken('guest')->plainTextToken;

        return GuestResource::make($guest)->token($token);
    }
}
