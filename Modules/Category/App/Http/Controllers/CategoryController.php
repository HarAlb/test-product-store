<?php

namespace Modules\Category\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Category\App\Application\GetCategoryListHandler;
use OpenApi\Attributes as OAT;

class CategoryController extends Controller
{
    #[
        OAT\Get(
            path: '/categories',
            operationId: 'getCategories',
            summary: 'Получаем список категориев',
            tags: ['Category'],
            responses: [
                new OAT\Response(
                    response: 201,
                    description: 'Categories list',
                    content: new OAT\JsonContent(
                        type: 'array',
                        items: new OAT\Items(ref: '#/components/schemas/CategoryResult')
                    )
                ),
            ]
        )
    ]
    public function __invoke(GetCategoryListHandler $handler): JsonResponse
    {
        return new JsonResponse($handler->handle());
    }
}
