<?php

namespace Modules\Auth\tests\Feature;

use Modules\User\App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test register of user
     *
     * @return void
     */
    public function testLoginSuccess()
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
    public function testLoginFailWithEmptyData()
    {
        $response = $this->postJson('/api/auth/login');

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'phone',
                'password'
            ]);
    }

    public function testLoginFailWithEmptyPassword()
    {
        $response = $this->postJson('/api/auth/login', [
            'phone' => fake()->numerify(str_repeat('#', 16)),
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'password',
            ]);
    }

    public function testLoginFailWithWrongPassword()
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
                    'Invalid phone or password.'
                ],
            ]);
    }
}
