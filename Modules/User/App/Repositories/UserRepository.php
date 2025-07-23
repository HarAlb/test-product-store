<?php

namespace Modules\User\App\Repositories;

use Modules\User\App\Application\UserEntity;
use Modules\User\App\Application\UserResult;
use Modules\User\App\Contracts\UserRepositoryInterface;
use Modules\User\App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(UserEntity $userEntity): UserResult
    {
        $model = new User();
        $model->name = $userEntity->name;
        $model->phone = $userEntity->phone;
        $model->password = $userEntity->password;
        $model->address = $userEntity->address;
        $model->save();

        return new UserResult(
            $model->id,
            $model->name,
            $model->phone,
            $model->address,
            $model->password
        );
    }

    public function findByPhone(string $phone): ?UserResult
    {
        $model = User::where('phone', $phone)->first();

        if (!$model) {
            return null;
        }

        return new UserResult(
            $model->id,
            $model->name,
            $model->phone,
            $model->address,
            $model->password
        );
    }
}
