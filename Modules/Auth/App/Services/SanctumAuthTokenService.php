<?php

namespace Modules\Auth\App\Services;

use Modules\Auth\App\Contracts\AuthTokenServiceInterface;
use Modules\User\App\Models\User;

class SanctumAuthTokenService implements AuthTokenServiceInterface
{
    public function createTokenById(int $userId): string
    {
        $user = User::findOrFail($userId);
        return $user->createToken('api')->plainTextToken;
    }
}
