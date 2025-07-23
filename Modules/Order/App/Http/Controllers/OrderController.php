<?php

namespace Modules\Order\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Order\App\Application\GetOrderPaginateHandler;
use Modules\Order\App\Application\OrderData;
use Modules\Order\App\Application\OrderFilter;
use Modules\Order\App\Application\StoreOrderHandler;
use Modules\Order\App\Http\Requests\OrderStoreRequest;
use Modules\OrderItem\App\Application\OrderItemData;
use OpenApi\Attributes as OAT;

class OrderController extends Controller
{
    #[
        OAT\Get(
            path: '/orders',
            operationId: 'getOrders',
            summary: 'Получаем список заказов',
            security: [['bearerAuth' => []]],
            tags: ['Orders'],
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
                new OAT\Response(
                    response: 401,
                    description: 'Unauthorized'
                ),
            ]
        )
    ]
    public function index(Request $request, GetOrderPaginateHandler $handler): JsonResponse
    {
        $page = (int) $request->query('page', 1);
        $perPage = (int) $request->query('perPage', 10);

        $filter = new OrderFilter(
            userId: auth()->user()->id,
            search: $request->query('search'),
            status: $request->query('status'),
        );

        return new JsonResponse($handler->handle($page, $perPage, $filter));
    }

    #[
        OAT\Post(
            path: '/orders',
            operationId: 'storeOrder',
            summary: 'Создаём заказ',
            security: [['bearerAuth' => []]],
            requestBody: new OAT\RequestBody(
                required: true,
                content: new OAT\JsonContent(
                    ref: '#/components/schemas/OrderStoreRequestSchema'
                )
            ),
            tags: ['Orders'],
            responses: [
                new OAT\Response(
                    response: 201,
                    description: 'Categories list',
                    content: new OAT\JsonContent(
                        type: 'array',
                        items: new OAT\Items(ref: '#/components/schemas/OrderResult')
                    )
                ),
                new OAT\Response(
                    response: 422,
                    description: 'Validation error',
                    content: new OAT\JsonContent(ref: '#/components/schemas/ValidationResponse')
                ),
                new OAT\Response(
                    response: 401,
                    description: 'Unauthorized'
                ),
            ]
        )
    ]
    public function store(OrderStoreRequest $request, StoreOrderHandler $handler): JsonResponse
    {
        return new JsonResponse($handler->handle(
            new OrderData(
                auth()->user()->id,
                array_map(fn ($item) => new OrderItemData(productId: $item['product_id'], quantity: $item['quantity']), $request->validated('items')),
            )
        ), 201);
    }
}
