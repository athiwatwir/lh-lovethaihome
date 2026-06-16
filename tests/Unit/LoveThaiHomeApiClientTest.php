<?php

namespace Tests\Unit;

use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use App\Services\LoveThaiHome\LoveThaiHomeApiClient;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LoveThaiHomeApiClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'lovethaihome_api.base_url' => 'https://api.example.com/v1',
            'lovethaihome_api.token' => 'test-token',
        ]);
    }

    public function test_it_fetches_property_types_with_bearer_token(): void
    {
        Http::fake([
            'https://api.example.com/v1/property-types' => Http::response([
                'data' => [
                    [
                        'id' => '185c82af-6b9a-45b1-b4d7-e8b62253dc6b',
                        'name' => 'บ้านเดี่ยว',
                        'seq' => 10,
                        'image_url' => 'https://example.com/house.webp',
                        'created_at' => '2016-12-17T21:18:59+00:00',
                    ],
                ],
            ]),
        ]);

        $client = new LoveThaiHomeApiClient;
        $types = $client->propertyTypes();

        $this->assertCount(1, $types);
        $this->assertSame('บ้านเดี่ยว', $types[0]->name);

        Http::assertSent(function ($request) {
            return $request->hasHeader('Authorization', 'Bearer test-token')
                && str_ends_with($request->url(), '/property-types');
        });
    }

    public function test_it_fetches_paginated_properties(): void
    {
        Http::fake([
            'https://api.example.com/v1/properties*' => Http::response([
                'data' => [['id' => 'property-1', 'code' => '690733']],
                'meta' => ['current_page' => 1, 'total' => 1],
            ]),
        ]);

        $client = new LoveThaiHomeApiClient;
        $response = $client->properties([
            'asset_type_id' => '185c82af-6b9a-45b1-b4d7-e8b62253dc6b',
            'page' => 1,
            'per_page' => 30,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertSame(1, $response->meta['total']);
    }

    public function test_it_throws_when_api_is_not_configured(): void
    {
        config(['lovethaihome_api.token' => null]);

        $this->expectException(LoveThaiHomeApiException::class);

        (new LoveThaiHomeApiClient)->propertyTypes();
    }
}
