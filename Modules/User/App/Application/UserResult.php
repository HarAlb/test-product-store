<?php

namespace Modules\User\App\Application;

use Modules\User\App\Models\User;
use OpenApi\Attributes as OAT;

#[
    OAT\Schema(
        schema: 'UserResult',
        title: 'User response',
        properties: [
            new OAT\Property(property: 'id', type: 'integer', example: 123),
            new OAT\Property(property: 'name', type: 'string', example: 'Иван Иванов'),
            new OAT\Property(property: 'phone', type: 'string', example: '79991234567'),
            new OAT\Property(property: 'address', type: 'string', example: 'г. Москва, ул. Ленина, д. 1'),
        ],
        type: 'object'
    )
]
final class UserResult implements \JsonSerializable
{
    public function __construct(
        private int $id,
        private string $name,
        private string $phone,
        private string $address,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            phone: $user->phone,
            address: $user->address,
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
        ];
    }
}
