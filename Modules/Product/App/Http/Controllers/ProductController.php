<?php

namespace Modules\Product\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Product\App\Application\GetProductPaginateHandler;
use Modules\Product\App\Application\ProductFilter;
use OpenApi\Attributes as OAT;

class ProductController extends Controller
{
    public function __construct(
        private readonly GetProductPaginateHandler $handler
    ) {}

    #[OAT\Get(
        path: '/products',
        operationId: 'getProducts',
        summary: 'получить список всех товаров',
        tags: ['Products'],
        parameters: [
            new OAT\Parameter(
                name: 'page',
                description: 'Page number',
                in: 'query',
                required: false,
                schema: new OAT\Schema(type: 'integer', default: 1)
            ),
            new OAT\Parameter(
                name: 'perPage',
                description: 'Items per page',
                in: 'query',
                required: false,
                schema: new OAT\Schema(type: 'integer', default: 10)
            ),
            new OAT\Parameter(
                name: 'search',
                description: 'Filter by resource name and description',
                in: 'query',
                required: false,
                schema: new OAT\Schema(type: 'string')
            ),
        ],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Paginated list of products',
                content: new OAT\JsonContent(ref: '#/components/schemas/PaginatedList')
            ),
        ]
    )]
    public function __invoke(Request $request): JsonResponse
    {
        $page = (int) $request->query('page', 1);
        $perPage = (int) $request->query('perPage', 10);

        $filter = new ProductFilter(
            search: $request->query('search'),
        );

        return new JsonResponse($this->handler->handle($page, $perPage, $filter));
    }
}
