<?php

namespace Tests\Feature\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function testListAllCustomers()
    {
        // Arrange
        factory(Customer::class)->create();

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('get', '/api/customers');

        // Assert
        $response->assertOk();
        $this->assertCount(1, $response->original);
    }

    /** @test */
    public function testCanCreateACustomer()
    {
        // Arrange
        $payload = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->email,
            'type'     => Customer::NATURAL_PERSON,
            'document' => '75908913049',
        ];

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('post', '/api/customers', $payload);

        // Assert
        $response->assertCreated();

        $this->assertDatabaseHas('customers', $payload);
    }

    /** @test */
    public function testCantCreateACustomer()
    {
        // Arrange
        $payload = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->email,
            'type'     => Customer::NATURAL_PERSON,
            'document' => '99999999999',
        ];

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('post', '/api/customers', $payload);

        // Assert
        $response->assertStatus(422);

        $response->assertJsonFragment(['document' => ["CPF or CNPJ is invalid."]]);

        $this->assertDatabaseMissing('customers', $payload);
    }

    /** @test */
    public function testCanSeeACustomer()
    {
        // Arrange
        $customer = factory(Customer::class)->create();

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('get', '/api/customers/' . $customer->id);

        // Assert
        $response->assertOk();
        $response->assertJsonFragment($customer->toArray());
    }

    /** @test */
    public function testCanDeleteACustomer()
    {
        // Arrange
        $customer = factory(Customer::class)->create();

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('delete', '/api/customers/' . $customer->id);

        // Assert
        $response->assertOk();

        $this->assertDatabaseMissing('customers', $customer->toArray());
    }
}
