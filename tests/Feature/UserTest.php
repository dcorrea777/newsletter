<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateNewUser(): void
    {
        $auth = User::factory()->create();
        $user = User::factory()->make();
        $data = ['name' => $user->name, 'email' => $user->email];
        $response = $this->actingAs($auth)->postJson('/api/users', $data);
        $response
            ->assertStatus(201)
            ->assertJson($data);
    }

    public function testCreateAccessToken(): void
    {
        User::factory()->create([
            'email' => 'danilo@dcorrea.com.br',
            'password' => '12danilo34',
        ]);

        $data = ['email' => 'danilo@dcorrea.com.br', 'password' => '12danilo34'];
        $response = $this->postJson('/api/tokens', $data);
        $response
            ->assertStatus(200)
            ->assertJson(['token' => true]);
    }

    public function testFailToGenerateToken(): void
    {
        $data = ['email' => 'danilo@dcorrea.com.br', 'password' => '12danilo34'];
        $response = $this->postJson('/api/tokens', $data);
        $response
            ->assertStatus(400)
            ->assertJson([
                'error' => [
                    'message'   => 'Invalid username and password',
                    'code'      => 400,
                    'title'     => 'AuthException'
                ]
            ]);
    }
}
