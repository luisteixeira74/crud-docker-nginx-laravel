<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_customer_instance()
    {
        $customer = Customer::factory()->create([
            'name' => 'Maria Oliveira',
            'email' => 'maria@example.com',
        ]);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals('Maria Oliveira', $customer->name);
        $this->assertEquals('maria@example.com', $customer->email);
    }

    /** @test */
    public function it_can_update_customer_information()
    {
        $customer = Customer::factory()->create();

        $customer->update([
            'name' => 'Carlos Souza',
        ]);

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'name' => 'Carlos Souza',
        ]);
    }

    /** @test */
    public function it_can_be_deleted()
    {
        $customer = Customer::factory()->create();

        $customerId = $customer->id;
        $customer->delete();

        $this->assertDatabaseMissing('customers', [
            'id' => $customerId,
        ]);
    }
}
