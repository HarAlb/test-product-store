<?php

namespace Modules\Auth\App\Application\Register;

use Modules\Auth\App\Contracts\AuthTokenServiceInterface;
use Modules\User\App\Application\UserEntity;
use Modules\User\App\Contracts\UserRepositoryInterface;

final class RegisterHandler
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private AuthTokenServiceInterface $authTokenService
    ) {}

    public function handle(RegisterData $data): RegisterResult
    {
        $userResult = $this->repository->create(
            new UserEntity(
                $data->name,
                $data->phone,
                $data->password,
                $data->address,
            )
        );

        return new RegisterResult($userResult, $this->authTokenService->createTokenById($userResult->getId()));
    }
}
