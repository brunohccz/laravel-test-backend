<?php

namespace Tests\Feature\Http\Controllers;

use App\Contract;
use App\Customer;
use App\Property;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ContractControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function testListAllContracts()
    {
        // Arrange
        factory(Contract::class)->create();

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('get', '/api/contracts');

        // Assert
        $response->assertOk();
        $this->assertCount(1, $response->original);
    }

    /** @test */
    public function testCanCreateAContract()
    {
        // Arrange
        $property = factory(Property::class)->create();
        $customer = factory(Customer::class)->create();

        $payload = [
            'property' => $property->id,
            'customer' => $customer->id
        ];

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('post', '/api/contracts/', $payload);

        // Assert
        $response->assertCreated();

        $this->assertDatabaseHas('contracts', [
            'property_id' => $property->id,
            'customer_id' => $customer->id
        ]);
    }

    /** @test */
    public function testCanSeeAContract()
    {
        // Arrange
        $contract = factory(Contract::class)->create();

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('get', '/api/contracts/' . $contract->id);

        // Assert
        $response->assertOk();
        $response->assertJsonFragment([
            'property' => [
                'address' => $contract->property->fullAddress
            ],
            'customer' => [
                'name'  => $contract->customer->name,
                'email' => $contract->customer->email
            ]
        ]);
    }

    /** @test */
    public function testCantCreateContractAlreadyExists()
    {
        // Arrange
        $property = factory(Property::class)->create();
        $customer = factory(Customer::class)->create();

        factory(Contract::class)->create([
           'property_id' => $property->id,
           'customer_id' => $customer->id
        ]);

        $payload = [
            'property' => $property->id,
            'customer' => $customer->id
        ];

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('post', '/api/contracts/', $payload);

        // Assert
        $response->assertStatus(Response::HTTP_BAD_REQUEST);

        $response->assertJson(['message' => 'Property unavailable']);

        $this->assertDatabaseCount('contracts', 1);
    }
}
