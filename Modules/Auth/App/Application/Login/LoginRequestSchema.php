<?php

namespace Modules\Auth\App\Application\Login;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'LoginRequestSchema',
    required: ['phone', 'password'],
    properties: [
        new OAT\Property(property: 'phone', type: 'string', example: '79991234567'),
        new OAT\Property(property: 'password', type: 'string', example: 'secret123'),
    ]
)]
class LoginRequestSchema
{

}
