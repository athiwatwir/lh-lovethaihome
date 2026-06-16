<?php

namespace App\Services\LoveThaiHome;

use App\Contracts\LoveThaiHomeApiClientInterface;
use App\Data\LoveThaiHome\AgentData;
use App\Data\LoveThaiHome\CustomerAssetData;
use App\Data\LoveThaiHome\PaginatedResponse;
use App\Data\LoveThaiHome\PropertyDetailData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class LoveThaiHomeService
{
    public function __construct(
        private readonly LoveThaiHomeApiClientInterface $client,
    ) {}

    /**
     * @return Collection<int, \App\Data\LoveThaiHome\PropertyTypeData>
     */
    public function propertyTypes(): Collection
    {
        return Cache::remember(
            'lovethaihome.api.property-types',
            config('lovethaihome_api.cache_ttl'),
            fn () => collect($this->client->propertyTypes()),
        );
    }

    /**
     * @param  array{
     *     asset_type_id?: string|null,
     *     agent_id?: string|null,
     *     user_id?: string|null,
     *     page?: int,
     *     per_page?: int,
     * }  $filters
     */
    public function properties(array $filters = []): PaginatedResponse
    {
        return $this->client->properties($filters);
    }

    public function property(string $id): PropertyDetailData
    {
        return $this->client->property($id);
    }

    public function findAgent(?string $agentId): ?AgentData
    {
        if (blank($agentId)) {
            return null;
        }

        $seller = $this->sellers()->first(fn (array $item) => ($item['id'] ?? null) === $agentId);

        return $seller ? AgentData::fromArray($seller) : null;
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    public function agents(): Collection
    {
        return Cache::remember(
            'lovethaihome.api.agents',
            config('lovethaihome_api.cache_ttl'),
            fn () => collect($this->client->agents()),
        );
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    public function sellers(): Collection
    {
        return Cache::remember(
            'lovethaihome.api.sellers',
            config('lovethaihome_api.cache_ttl'),
            fn () => collect($this->client->sellers()),
        );
    }

    /**
     * @param  array<string, mixed>|CustomerAssetData  $payload
     * @return array<string, mixed>
     */
    public function submitCustomerAsset(array|CustomerAssetData $payload): array
    {
        return $this->client->createCustomerAsset($payload);
    }
}
