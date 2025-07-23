<?php

namespace Modules\Auth\App\Application\Login;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Auth\App\Contracts\AuthTokenServiceInterface;
use Modules\User\App\Contracts\UserRepositoryInterface;

final class LoginHandler
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private AuthTokenServiceInterface $authTokenService
    ) {}

    public function handle(LoginData $data): LoginResult
    {
        $userResult = $this->repository->findByPhone($data->phone);

        if (! $userResult || ! Hash::check($data->password, $userResult->getPassword())) {
            throw ValidationException::withMessages([
                'phone' => ['Invalid phone or password.'],
            ]);
        }

        return new LoginResult($userResult, $this->authTokenService->createTokenById($userResult->getId()));
    }
}
