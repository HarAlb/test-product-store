<?php

namespace Modules\Currency\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Currency\App\Application\GetCurrencyListHandler;
use OpenApi\Attributes as OAT;

class CurrencyController extends Controller
{
    #[
        OAT\Get(
            path: '/currencies',
            operationId: 'getCurrencies',
            summary: 'Получаем список доступных валют',
            tags: ['Currency'],
            responses: [
                new OAT\Response(
                    response: 201,
                    description: 'Currency list',
                    content: new OAT\JsonContent(
                        type: 'array',
                        items: new OAT\Items(ref: '#/components/schemas/CurrencyResult')
                    )
                ),
            ]
        )
    ]
    public function __invoke(GetCurrencyListHandler $handler): JsonResponse
    {
        return new JsonResponse($handler->handle());
    }
}
