<?php

namespace Modules\Auth\App\Application\Register;

final class RegisterData
{
    public function __construct(
        public readonly string $name,
        public readonly string $phone,
        public readonly string $address,
        public readonly string $password
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            phone: $data['phone'],
            address: $data['address'],
            password: $data['password'],
        );
    }
}
