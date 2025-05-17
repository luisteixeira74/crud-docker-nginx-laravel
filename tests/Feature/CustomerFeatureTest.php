<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;
use PHPUnit\Framework\Attributes\Test;

class CustomerFeatureTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_creates_a_new_customer(): void
    {
        $payload = [
            'name' => 'Maria Oliveira',
            'email' => 'maria@example.com',
            'phone' => '11988887777',
        ];

        $response = $this->postJson('/api/customers', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['email' => 'maria@example.com']);

        $this->assertDatabaseHas('customers', [
            'email' => 'maria@example.com',
        ]);
    }
}
