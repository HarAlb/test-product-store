<?php

namespace Modules\Auth\App\Application\Register;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'RegisterRequestSchema',
    required: ['name', 'address', 'phone', 'password'],
    properties: [
        new OAT\Property(property: 'name', type: 'string', maxLength: 255, example: 'Иван Иванов'),
        new OAT\Property(property: 'address', type: 'string', example: 'г. Москва, ул. Ленина, д. 1'),
        new OAT\Property(property: 'phone', type: 'string', example: '79991234567'),
        new OAT\Property(property: 'password', type: 'string', example: 'secret123'),
        new OAT\Property(property: 'password_confirmation', type: 'string', example: 'secret123'),
    ]
)]
class RegisterRequestSchema
{

}
