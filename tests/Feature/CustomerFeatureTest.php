<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_customer_with_valid_data()
    {
        $data = [
            'name' => 'João Silva',
            'email' => 'joao@example.com',
        ];

        $response = $this->postJson('/api/customers', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('customers', $data);
    }

    /** @test */
    public function it_fails_to_create_a_customer_with_invalid_data()
    {
        $data = [
            'name' => '',
            'email' => 'invalid-email',
        ];

        $response = $this->postJson('/api/customers', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email']);
    }

}
