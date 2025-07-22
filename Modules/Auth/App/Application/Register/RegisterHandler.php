<?php

namespace Modules\Auth\App\Application\Register;

use Illuminate\Support\Facades\Hash;
use Modules\User\App\Models\User;

final class RegisterHandler
{
    public function handle(RegisterData $data): RegisterResult
    {
        $user = User::create([
            'name'     => $data->name,
            'phone'    => $data->phone,
            'password' => Hash::make($data->password),
            'address' => $data->address,
        ]);

        $token = $user->createToken('api')->plainTextToken;

        return new RegisterResult($user, $token);
    }
}
