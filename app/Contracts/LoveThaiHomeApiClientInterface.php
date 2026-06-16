<?php

namespace App\Contracts;

use App\Data\LoveThaiHome\CustomerAssetData;
use App\Data\LoveThaiHome\PaginatedResponse;
use App\Data\LoveThaiHome\PropertyDetailData;
use App\Data\LoveThaiHome\PropertyTypeData;

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
     *     page?: int,
     *     per_page?: int,
     * }  $filters
     */
    public function properties(array $filters = []): PaginatedResponse;

    public function property(string $id): PropertyDetailData;

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
