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

    public function test_it_records_property_view(): void
    {
        Http::fake([
            'https://api.example.com/v1/properties/property-1/views' => Http::response([
                'asset_id' => 'property-1',
                'view_date' => '2026-06-19',
                'total_views' => 1,
                'view_count' => 1,
            ]),
        ]);

        $client = new LoveThaiHomeApiClient;
        $response = $client->recordPropertyView('property-1');

        $this->assertSame('property-1', $response['asset_id']);

        Http::assertSent(function ($request) {
            return $request->method() === 'POST'
                && str_ends_with($request->url(), '/properties/property-1/views');
        });
    }

    public function test_it_fetches_asset_zones(): void
    {
        Http::fake([
            'https://api.example.com/v1/asset-zones' => Http::response([
                'data' => [
                    ['id' => 'zone-1', 'name' => 'โซนทิศเหนือ', 'seq' => 40],
                    ['id' => 'zone-2', 'name' => 'โซนต่างจังหวัด', 'seq' => 60],
                ],
            ]),
        ]);

        $client = new LoveThaiHomeApiClient;
        $zones = $client->zones();

        $this->assertCount(2, $zones);
        $this->assertSame('โซนต่างจังหวัด', $zones[1]->name);
    }

    public function test_it_searches_properties_with_filters(): void
    {
        Http::fake([
            'https://api.example.com/v1/properties/search*' => Http::response([
                'data' => [['id' => 'property-1', 'code' => '690733']],
                'meta' => ['current_page' => 1, 'total' => 1, 'per_page' => 12],
            ]),
        ]);

        $client = new LoveThaiHomeApiClient;
        $response = $client->searchProperties([
            'text' => 'ขายด่วน',
            'asset_type_id' => '185c82af-6b9a-45b1-b4d7-e8b62253dc6b',
            'province' => 'กรุงเทพมหานคร',
            'amphur' => 'บางกะปิ',
            'district' => 'หัวหมาก',
            'price_min' => '1000000',
            'price_max' => '5000000',
            'page' => 1,
            'per_page' => 12,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertSame(1, $response->meta['total']);

        Http::assertSent(function ($request) {
            $query = $request->data();

            return str_contains($request->url(), '/properties/search')
                && ($query['text'] ?? null) === 'ขายด่วน'
                && ($query['price_min'] ?? null) === '1000000'
                && ($query['price_max'] ?? null) === '5000000';
        });
    }

    public function test_it_omits_unlimited_price_max_from_search_query(): void
    {
        Http::fake([
            'https://api.example.com/v1/properties/search*' => Http::response([
                'data' => [],
                'meta' => ['current_page' => 1, 'total' => 0, 'per_page' => 12],
            ]),
        ]);

        $client = new LoveThaiHomeApiClient;
        $client->searchProperties([
            'text' => 'ขายด่วน',
            'price_max' => 'unlimited',
        ]);

        Http::assertSent(function ($request) {
            $query = $request->data();

            return ! array_key_exists('price_max', $query);
        });
    }
}
