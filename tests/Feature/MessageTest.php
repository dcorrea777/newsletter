<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\Newsletter;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use DatabaseMigrations;

    public function testThrowExceptionWhenANewsletterIsInvalid(): void
    {
        $auth = User::factory()->create();
        $payload = ['subject' => 'php the right way', 'content' => 'php ...'];
        $response = $this
            ->actingAs($auth)
            ->getJson('/api/newsletters/654654654/messages', $payload);
        $response
            ->assertStatus(400)
            ->assertJson([
                'error' => [
                    'message'   => 'Newsletter not found',
                    'code'      => 400,
                    'title'     => 'ResourceNotFoundException'
                ]
            ]);
    }

    public function testThrowAnExceptionWhenTryingToCreateAMessageWithANewsletterInvalidates(): void
    {
        $auth = User::factory()->create();
        $payload = ['subject' => 'php the right way', 'content' => 'php ...'];
        $response = $this
            ->actingAs($auth)
            ->postJson('/api/newsletters/654654654/messages', $payload);
        $response
            ->assertStatus(400)
            ->assertJson([
                'error' => [
                    'message'   => 'Newsletter not found',
                    'code'      => 400,
                    'title'     => 'ResourceNotFoundException'
                ]
            ]);
    }

    public function testGetMessages(): void
    {
        $auth = User::factory()->create();
        $newsletter = Newsletter::factory()
            ->for(Topic::factory()->create())
            ->create();

        $messages = Message::factory()->count(10)->for($newsletter)->create();
        $endpoint = sprintf('/api/newsletters/%s/messages', $newsletter->id);
        $response = $this
            ->actingAs($auth)
            ->getJson($endpoint);

        $response
            ->assertStatus(200)
            ->assertJson(['data' => $messages->toArray()]);
    }

    public function testCreateMessage(): void
    {
        $auth = User::factory()->create();
        $newsletter = Newsletter::factory()
            ->for(Topic::factory()->create())
            ->create();
        $payload = ['subject' => 'php the right way', 'content' => 'php...'];
        $endpoint = sprintf('/api/newsletters/%s/messages', $newsletter->id);
        $response = $this
            ->actingAs($auth)
            ->postJson($endpoint, $payload);

        $response
            ->assertStatus(201)
            ->assertJson(['data' => $payload]);
    }    
}
