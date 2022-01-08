<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetamaskLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;

class MetamaskLoginController extends Controller
{
    /**
     * @param MetamaskLoginRequest $request
     * @return array
     */
    #[ArrayShape(['token' => "string", 'user' => "\App\Http\Resources\UserResource"])]
    public function login(MetamaskLoginRequest $request): array
    {
        $requestData = $request->validated();

        /** @var User $user */
        $user = User::query()->firstOrCreate([
            'eth_address' => $requestData['address'],
        ]);

        Auth::login($user);
        $token = $user->createToken(env('APP_NAME'));

        return [
            'token' => $token->plainTextToken,
            'user' => new UserResource($user),
        ];
    }

}
