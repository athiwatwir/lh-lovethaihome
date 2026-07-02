<?php

namespace App\Contracts;

use App\Data\LoveThaiHome\CustomerAssetData;
use App\Data\LoveThaiHome\PaginatedResponse;
use App\Data\LoveThaiHome\PropertyDetailData;
use App\Data\LoveThaiHome\PropertyTypeData;
use App\Data\LoveThaiHome\ZoneData;

interface LoveThaiHomeApiClientInterface
{
    /**
     * @return list<PropertyTypeData>
     */
    public function propertyTypes(): array;

    /**
     * @param  array{
     *     asset_type_id?: string|null,
     *     agent_id?: string|null,
     *     user_id?: string|null,
     *     zone_id?: string|null,
     *     page?: int,
     *     per_page?: int,
     * }  $filters
     */
    public function properties(array $filters = []): PaginatedResponse;

    /**
     * @param  array{
     *     text?: string|null,
     *     asset_type_id?: string|null,
     *     province?: string|null,
     *     district?: string|null,
     *     amphur?: string|null,
     *     price_min?: string|int|null,
     *     price_max?: string|int|null,
     *     page?: int,
     *     per_page?: int,
     * }  $filters
     */
    public function searchProperties(array $filters = []): PaginatedResponse;

    public function property(string $id): PropertyDetailData;

    /**
     * @return list<ZoneData>
     */
    public function zones(): array;

    /**
     * @return array<string, mixed>
     */
    public function recordPropertyView(string $id): array;

    /**
     * @return list<array<string, mixed>>
     */
    public function agents(): array;

    /**
     * @return list<array<string, mixed>>
     */
    public function sellers(): array;

    /**
     * @param  array<string, mixed>|CustomerAssetData  $payload
     * @return array<string, mixed>
     */
    public function createCustomerAsset(array|CustomerAssetData $payload): array;
}
