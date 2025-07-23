<?php

namespace Modules\User\App\Application;

final class UserEntity
{
    public string $name;

    public string $phone;

    public string $password;

    public string $address;

    public function __construct(string $name, string $phone, string $password, string $address)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->password = $password;
        $this->address = $address;
    }

    public static function fromArray(array $data): self
    {
        return new self(...$data);
    }
}
