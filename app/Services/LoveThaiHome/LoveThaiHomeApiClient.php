<?php

namespace App\Services\LoveThaiHome;

use App\Contracts\LoveThaiHomeApiClientInterface;
use App\Data\LoveThaiHome\CustomerAssetData;
use App\Data\LoveThaiHome\PaginatedResponse;
use App\Data\LoveThaiHome\PropertyDetailData;
use App\Data\LoveThaiHome\PropertyTypeData;
use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class LoveThaiHomeApiClient implements LoveThaiHomeApiClientInterface
{
    public function propertyTypes(): array
    {
        $payload = $this->get('property-types');

        return collect($payload['data'] ?? [])
            ->map(fn (array $item) => PropertyTypeData::fromArray($item))
            ->sortBy('seq')
            ->values()
            ->all();
    }

    public function properties(array $filters = []): PaginatedResponse
    {
        $query = array_filter([
            'asset_type_id' => $filters['asset_type_id'] ?? null,
            'agent_id' => $filters['agent_id'] ?? null,
            'user_id' => $filters['user_id'] ?? null,
            'page' => $filters['page'] ?? 1,
            'per_page' => min(max((int) ($filters['per_page'] ?? 30), 1), 100),
        ], fn ($value) => $value !== null && $value !== '');

        return PaginatedResponse::fromArray(
            $this->get('properties', $query)
        );
    }

    public function property(string $id): PropertyDetailData
    {
        $payload = $this->get('properties/'.urlencode($id));
        $data = $payload['data'] ?? $payload;

        if (! is_array($data) || ! isset($data['id'])) {
            throw new LoveThaiHomeApiException('Property not found.', statusCode: 404);
        }

        return PropertyDetailData::fromArray($data);
    }

    public function agents(): array
    {
        return $this->get('agents')['data'] ?? [];
    }

    public function sellers(): array
    {
        return $this->get('seller')['data'] ?? [];
    }

    public function createCustomerAsset(array|CustomerAssetData $payload): array
    {
        if ($payload instanceof CustomerAssetData) {
            $payload = $payload->toArray();
        }

        return $this->post('customer-assets', $payload);
    }

    /**
     * @return array<string, mixed>
     */
    protected function get(string $path, array $query = []): array
    {
        return $this->request('get', $path, ['query' => $query]);
    }

    /**
     * @return array<string, mixed>
     */
    protected function post(string $path, array $payload = []): array
    {
        return $this->request('post', $path, ['json' => $payload]);
    }

    /**
     * @param  array<string, mixed>  $options
     * @return array<string, mixed>
     */
    protected function request(string $method, string $path, array $options = []): array
    {
        $this->ensureConfigured();

        try {
            $response = $this->http()
                ->{$method}($this->endpoint($path), $options['json'] ?? $options['query'] ?? [])
                ->throw();

            $json = $response->json();

            return is_array($json) ? $json : [];
        } catch (ConnectionException $exception) {
            throw new LoveThaiHomeApiException(
                'Unable to connect to Love Thai Home API.',
                previous: $exception,
            );
        } catch (RequestException $exception) {
            $response = $exception->response;

            throw new LoveThaiHomeApiException(
                $response?->json('message') ?? $exception->getMessage(),
                statusCode: $response?->status(),
                responseBody: $response?->json(),
                previous: $exception,
            );
        }
    }

    protected function http(): PendingRequest
    {
        $retry = config('lovethaihome_api.retry');

        return Http::baseUrl(config('lovethaihome_api.base_url'))
            ->acceptJson()
            ->asJson()
            ->timeout(config('lovethaihome_api.timeout'))
            ->withToken(config('lovethaihome_api.token'))
            ->retry(
                $retry['times'],
                $retry['sleep_ms'],
                throw: false,
            );
    }

    protected function endpoint(string $path): string
    {
        return '/'.ltrim($path, '/');
    }

    protected function ensureConfigured(): void
    {
        if (blank(config('lovethaihome_api.base_url')) || blank(config('lovethaihome_api.token'))) {
            throw new LoveThaiHomeApiException(
                'Love Thai Home API is not configured. Set LOVE_THAI_HOME_API_URL and LOVE_THAI_HOME_API_TOKEN in .env.'
            );
        }
    }
}
