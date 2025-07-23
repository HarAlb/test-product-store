<?php

namespace Modules\User\App\Contracts;

use Modules\User\App\Application\UserEntity;
use Modules\User\App\Application\UserResult;

interface UserRepositoryInterface
{
    public function create(UserEntity $user): UserResult;

    public function findByPhone(string $phone): ?UserResult;
}
