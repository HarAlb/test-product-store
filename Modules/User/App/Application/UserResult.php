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
        private string $password,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            phone: $user->phone,
            address: $user->address,
            password: $user->password,
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
