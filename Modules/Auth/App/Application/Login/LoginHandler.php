<?php

namespace Modules\Auth\App\Application\Login;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\User\App\Models\User;

final class LoginHandler
{
    public function handle(LoginData $data): LoginResult
    {
        $user = User::where('phone', $data->phone)->first();

        if (!$user || !Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['Invalid phone or password.'],
            ]);
        }

        $token = $user->createToken('api')->plainTextToken;

        return new LoginResult($user, $token);
    }
}
