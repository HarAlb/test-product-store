<?php

namespace Modules\Product\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OAT;

class ProductController extends Controller
{
    public function __construct(

    ) {}

    #[OAT\Get(
        path: '/products',
        operationId: 'getProducts',
        summary: 'получить список всех товаров',
        tags: ['Products'],
        responses: [
            new OAT\Response(
                response: 201,
                description: 'Success Register',
                content: new OAT\JsonContent(ref: '#/components/schemas/RegisterResult')
            ),
            new OAT\Response(
                response: 422,
                description: 'Validation error',
                content: new OAT\JsonContent(ref: '#/components/schemas/ValidationResponse')
            ),
        ]
    )]
    public function register(): JsonResponse
    {

        return new JsonResponse([], 201);
    }
}
