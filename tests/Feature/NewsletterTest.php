<?php

namespace Tests\Feature;

use App\Models\Newsletter;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class NewsletterTest extends TestCase
{
    use DatabaseMigrations;

    public function testErrorWhenCreatingNewsletterForNonAdminUser(): void
    {
        $auth = User::factory()->create([
            'is_admin' => false
        ]);

        $data = ['name' => 'php', 'description' => 'laravel', 'topic_id' => 1];
        $response = $this->actingAs($auth)->postJson('/api/newsletters', $data);
        $response
            ->assertStatus(403)
            ->assertJson([
                'error' => [
                    'message' => 'Access denied',
                    'code' => 403,
                    'title' => 'AccessDeniedException',
                ]
            ]);
    }

    public function testCreateNewsletterWhenTheUserIsAdmin(): void
    {
        $topic  = Topic::factory()->create();
        $auth   = User::factory()->create(['is_admin' => true]);
        $data   = ['name' => 'Semana php', 'description' => 'lista php', 'topic_id' => $topic->id];

        $response = $this->actingAs($auth)->postJson('/api/newsletters', $data);
        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => $data
            ]);
    }

    public function testThrowAnExceptionWhenTopicIsNotValid(): void
    {
        $auth   = User::factory()->create(['is_admin' => true]);
        $data   = ['name' => 'Semana php', 'description' => 'lista php', 'topic_id' => 321];

        $response = $this->actingAs($auth)->postJson('/api/newsletters', $data);
        $response
            ->assertStatus(400)
            ->assertJson([
                'error' => [
                    'message'   => 'Topic not found',
                    'code'      => 400,
                    'title'     => 'ResourceNotFoundException'
                ]
            ]);
    }
}
