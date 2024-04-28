<?php

namespace Tests\Feature;

use App\Models\Newsletter;
use App\Models\Subscription;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SubscribeTest extends TestCase
{
    use DatabaseMigrations;

    public function testThrowExceptionWhenANewsletterIsInvalid(): void
    {
        $auth = User::factory()->create();
        $response = $this
            ->actingAs($auth)
            ->postJson('/api/newsletters/321/subscriptions', ['email' => 'danilo@dcorrea.com.br']);

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

    public function testCreateASubscription(): void
    {
        $auth = User::factory()->create();
        $newsletter = Newsletter::factory()
            ->for(Topic::factory()->create())
            ->create();

        $payload = ['email' => 'danilo@dcorrea.com.br'];
        $endpoint = sprintf('/api/newsletters/%s/subscriptions', $newsletter->id);
        $response = $this
            ->actingAs($auth)
            ->postJson($endpoint, $payload);

        $response
            ->assertStatus(201)
            ->assertJson(['data' => $payload]);
    }

    public function testGetSubscriptions(): void
    {
        $auth = User::factory()->create();
        $newsletter = Newsletter::factory()
            ->for(Topic::factory()->create())
            ->create();
        $subscription = Subscription::factory()->count(10)->for($newsletter)->create();

        $endpoint = sprintf('/api/newsletters/%s/subscriptions', $newsletter->id);
        $response = $this
            ->actingAs($auth)
            ->getJson($endpoint);

        $response
            ->assertStatus(200)
            ->assertJson(['data' => $subscription->toArray()]);
    }
}
