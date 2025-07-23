<?php

namespace Modules\Auth\App\Application\Login;

final class LoginData
{
    public function __construct(
        public readonly string $phone,
        public readonly string $password
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            phone: $data['phone'],
            password: $data['password'],
        );
    }
}
