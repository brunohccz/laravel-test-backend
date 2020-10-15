<?php

namespace Tests\Feature\Http\Controllers;

use App\Address;
use App\Property;
use App\PropertyFeatureType;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PropertyControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function testListAllProperties()
    {
        // Arrange
        factory(Property::class)->create();

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('get', '/api/properties');

        // Assert
        $response->assertOk();
        $this->assertCount(1, $response->original);
    }

    /** @test */
    public function testCanCreateAProperty()
    {
        // Arrange
        $payload = [
            'owner_email' => $this->faker->email,
            'title'       => $this->faker->sentence,
            'description' => $this->faker->text(200),
            'address'     => factory(Address::class)->make()->toArray(),
            'features'    => [
                [
                    'type'  => factory(PropertyFeatureType::class)->create()->id,
                    'value' => $this->faker->word,
                ],
            ],
        ];

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('post', '/api/properties', $payload);

        // Assert
        $response->assertOk();

        $this->assertDatabaseHas('properties', [
            'owner_email'   => $payload['owner_email'],
            'title'         => $payload['title'],
            'description'   => $payload['description']
        ]);

        $this->assertDatabaseHas('addresses', $payload['address']);

        $this->assertDatabaseHas('property_features', [
           'property_type_id' => $payload['features'][0]['type'],
           'value'            => $payload['features'][0]['value']
        ]);
    }

    /** @test */
    public function testCanSeeAProperty()
    {
        // Arrange
        $property = factory(Property::class)->create();

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('get', '/api/properties/' . $property->id);

        // Assert
        $response->assertOk();
        $response->assertJsonFragment(['address' => $property->fullAddress]);
    }

    /** @test */
    public function testCanUpdateAProperty()
    {
        // Arrange
        $property = factory(Property::class)->create();

        $payload = $property->toArray() + [
            'description' => 'A new description',
            'address'     => [
                'state' => 'RJ',
                'city'  => 'Rio de Janeiro'
            ]
        ];

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('patch', '/api/properties/' . $property->id, $payload);

        // Assert
        $response->assertOk();

        $this->assertDatabaseHas('properties', [
            'description'   => $payload['description']
        ]);

        $this->assertDatabaseHas('addresses', $payload['address']);
    }

    /** @test */
    public function testCanSoftDeleteAProperty()
    {
        // Arrange
        $property = factory(Property::class)->create();

        // Act
        Sanctum::actingAs(
            factory(User::class)->create()
        );

        $response = $this->json('delete', '/api/properties/' . $property->id);

        // Assert
        $response->assertOk();

        $this->assertSoftDeleted('properties', [
            'id' => $property->id
        ]);
    }
}
