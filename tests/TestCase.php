<?php

namespace Tests;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function actAsUser(AuthenticatableContract $authenticatable): AuthenticatableContract
    {
        return Sanctum::actingAs($authenticatable, ['*'], 'api');
    }
}
