<?php

namespace Modules\Currency\App\Application;

use Modules\Currency\App\Models\Currency;
use OpenApi\Attributes as OAT;

#[
    OAT\Schema(
        schema: 'CurrencyResult',
        title: 'Currency response',
        properties: [
            new OAT\Property(property: 'id', type: 'integer', example: 123),
            new OAT\Property(property: 'code', type: 'string', example: 'USD'),
            new OAT\Property(property: 'name', type: 'string', example: 'US Dollar'),
            new OAT\Property(property: 'symbol', type: 'string', example: '$'),
        ],
        type: 'object'
    )
]
final class CurrencyResult implements \JsonSerializable
{
    public function __construct(
        private int $id,
        private string $code,
        private string $name,
        private string $symbol,
    ) {}

    public static function fromModel(Currency $currency): self
    {
        return new self(
            id: $currency->id,
            code: $currency->code,
            name: $currency->name,
            symbol: $currency->symbol,
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'symbol' => $this->symbol,
        ];
    }
}
