<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OAT;

#[OAT\Schema(title: 'Validation error')]
class ValidationResponse
{
    #[OAT\Property(title: 'message', example: 'Error')]
    public string $message;

    #[
        OAT\Property(
            properties: [
                'email' => new OAT\Property(
                    property: 'email',
                    description: 'Сумма зарплаты за месяц',
                    type: 'array',
                    items: new OAT\Items(type: 'string')
                ),
            ]
        )
    ]
    public object $errors;
}
