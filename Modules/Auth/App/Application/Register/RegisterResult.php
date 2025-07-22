<?php

namespace Modules\Auth\App\Application\Register;

use Modules\User\App\Application\UserResult;
use Modules\User\App\Models\User;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'RegisterResult',
    title: 'User after register response',
    properties: [
        'user' => new OAT\Property(
            property: 'user',
            ref: "#/components/schemas/UserResult"
        ),
        'token' => new OAT\Property(
            property: 'token',
            type: 'string',
            example: '1|8kavRLZCsGepEU80kb3jkiJv6QZjNvdT2x1GnKime49cb2b6'
        )
    ],
    type: 'object'
)]
final class RegisterResult implements \JsonSerializable
{
    public function __construct(
        public readonly User $user,
        public readonly string $token,
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'user' => UserResult::fromModel($this->user),
            'token' => $this->token
        ];
    }
}
