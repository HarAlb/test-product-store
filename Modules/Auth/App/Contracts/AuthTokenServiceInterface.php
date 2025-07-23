<?php

namespace Modules\Auth\App\Contracts;

interface AuthTokenServiceInterface
{
    /**
     * Создает токен для пользователя.
     */
    public function createTokenById(int $userId): string;
}
