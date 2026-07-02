<?php

namespace App\Services\LoveThaiHome;

use App\Contracts\LoveThaiHomeApiClientInterface;
use App\Data\LoveThaiHome\AgentData;
use App\Data\LoveThaiHome\ArticleDetailData;
use App\Data\LoveThaiHome\ArticlesPaginatedResponse;
use App\Data\LoveThaiHome\CustomerAssetData;
use App\Data\LoveThaiHome\PaginatedResponse;
use App\Data\LoveThaiHome\PropertyDetailData;
use App\Data\LoveThaiHome\ZoneData;
use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
            fn() => collect($this->client->propertyTypes()),
        );
    }

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
    public function properties(array $filters = []): PaginatedResponse
    {
        return $this->client->properties($filters);
    }

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
    public function searchProperties(array $filters = []): PaginatedResponse
    {
        return $this->client->searchProperties($filters);
    }

    public function property(string $id): PropertyDetailData
    {
        return $this->client->property($id);
    }

    /**
     * @return array<string, mixed>
     */
    public function recordPropertyView(string $id): array
    {
        return $this->client->recordPropertyView($id);
    }

    /**
     * @return Collection<int, ZoneData>
     */
    public function zones(): Collection
    {
        return Cache::remember(
            'lovethaihome.api.asset-zones',
            config('lovethaihome_api.cache_ttl'),
            function () {
                try {
                    return collect($this->client->zones());
                } catch (LoveThaiHomeApiException $exception) {
                    Log::warning('Failed to load asset zones from API, using fallback config.', [
                        'message' => $exception->getMessage(),
                        'status' => $exception->statusCode,
                    ]);

                    return collect(config('lovethaihome_zones'))
                        ->map(fn(array $zone) => ZoneData::fromArray($zone));
                }
            },
        );
    }

    public function findAgent(?string $agentId): ?AgentData
    {
        if (blank($agentId)) {
            return null;
        }

        $seller = $this->sellers()->first(fn(array $item) => ($item['id'] ?? null) === $agentId);

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
            fn() => collect($this->client->agents()),
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
            fn() => collect($this->client->sellers()),
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

    /**
     * @param  array{
     *     category_id?: string|null,
     *     page?: int,
     *     per_page?: int,
     * }  $filters
     */
    public function articles(array $filters = []): ArticlesPaginatedResponse
    {
        //dd($filters);
        return $this->client->articles($filters);
    }

    public function article(string $id): ArticleDetailData
    {
        return $this->client->article($id);
    }
}
