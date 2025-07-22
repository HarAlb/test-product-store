<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Auth\App\Application\Login\LoginData;
use Modules\Auth\App\Application\Login\LoginHandler;
use Modules\Auth\App\Application\Register\RegisterData;
use Modules\Auth\App\Application\Register\RegisterHandler;
use Modules\Auth\App\Http\Requests\LoginRequest;
use Modules\Auth\App\Http\Requests\RegisterRequest;
use Modules\User\App\Application\UserResult;
use OpenApi\Attributes as OAT;

class AuthController extends Controller
{
    public function __construct(
        private RegisterHandler $registerHandler,
        private LoginHandler $loginHandler,
    ) {
    }

    #[OAT\Post(
        path: '/auth/register',
        operationId: 'register',
        summary: 'регистрация (телефон, имя, адрес)',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                ref: '#/components/schemas/RegisterRequestSchema'
            )
        ),
        tags: ['Auth'],
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
    public function register(RegisterRequest $request): JsonResponse
    {
        $registerData = $this->registerHandler->handle(
            RegisterData::fromArray($request->validated())
        );

        return new JsonResponse($registerData, 201);
    }

    #[OAT\Post(
        path: '/auth/login',
        operationId: 'login',
        summary: 'авторизация',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                ref: '#/components/schemas/LoginRequestSchema'
            )
        ),
        tags: ['Auth'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Success Register',
                content: new OAT\JsonContent(ref: '#/components/schemas/LoginResult')
            ),
            new OAT\Response(
                response: 422,
                description: 'Validation error',
                content: new OAT\JsonContent(ref: '#/components/schemas/ValidationResponse')
            ),
        ]
    )]
    public function login(LoginRequest $request): JsonResponse
    {
        return new JsonResponse(
            $this->loginHandler->handle(
                LoginData::fromArray($request->validated())
            )
        );
    }

    #[OAT\Post(
        path: '/auth/me',
        operationId: 'getAuthUser',
        summary: 'Получаем информацию авторизованного пользователя',
        security: [['bearerAuth' => []]],
        tags: ['Auth'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Success',
                content: new OAT\JsonContent(ref: '#/components/schemas/UserResult')
            ),
            new OAT\Response(
                response: 401,
                description: 'Unauthorized'
            ),
        ]
    )]
    public function user(): JsonResponse
    {
        return new JsonResponse(
            UserResult::fromModel(request()->user())
        );
    }
}
