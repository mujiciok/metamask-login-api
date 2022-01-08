<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use JetBrains\PhpStorm\Pure;

class UserController extends Controller
{
    /**
     * @param User $user
     * @return UserResource
     */
    #[Pure]
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }
}
