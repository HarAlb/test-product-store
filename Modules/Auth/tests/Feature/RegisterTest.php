<?php

namespace Modules\Auth\tests\Feature;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Test register of user
     *
     * @return void
     */
    public function test_validation_error_with_empty()
    {
        $response = $this->postJson('/api/auth/register');

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors',
        ]);
    }

    /**
     * Test register of user
     *
     * @return void
     */
    public function test_success_register()
    {
        $password = 'fakePass123';

        $response = $this->postJson('/api/auth/register', [
            'phone' => fake()->numerify(str_repeat('#', 16)),
            'name' => fake()->name,
            'address' => fake()->address,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('users', [
            'phone' => $response->json('user.phone'),
            'name' => $response->json('user.name'),
        ]);
    }
}
