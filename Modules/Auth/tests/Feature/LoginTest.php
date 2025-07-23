<?php

namespace Modules\Auth\tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test register of user
     *
     * @return void
     */
    public function test_login_success()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'Secret123!'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'phone' => $user->phone,
            'password' => $password,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token', // или см. твой реальный ответ API
                'user' => ['id', 'name', 'phone'],
            ]);
    }

    /**
     * Test register of user
     *
     * @return void
     */
    public function test_login_fail_with_empty_data()
    {
        $response = $this->postJson('/api/auth/login');

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'phone',
                'password',
            ]);
    }

    public function test_login_fail_with_empty_password()
    {
        $response = $this->postJson('/api/auth/login', [
            'phone' => fake()->numerify(str_repeat('#', 16)),
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'password',
            ]);
    }

    public function test_login_fail_with_wrong_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('Secret123!'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'phone' => $user->phone,
            'password' => 'test',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'phone' => [
                    'Invalid phone or password.',
                ],
            ]);
    }
}
