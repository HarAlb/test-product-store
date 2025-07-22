<?php

namespace Tests;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function actAsUser(AuthenticatableContract $authenticatable): AuthenticatableContract
    {
        return Sanctum::actingAs($authenticatable, ['*'], 'api');
    }
}
