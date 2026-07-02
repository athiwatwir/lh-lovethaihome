<?php

namespace App\Http\Controllers;

use App\Data\LoveThaiHome\AgentData;
use App\Data\LoveThaiHome\PropertyData;
use App\Data\LoveThaiHome\PropertyDetailData;
use App\Data\LoveThaiHome\PropertyTypeData;
use App\Support\PropertySeo;
use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use App\Services\LoveThaiHome\LoveThaiHomeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PropertyController extends Controller
{
    public function index(Request $request, LoveThaiHomeService $api): View
    {
        $assetTypeId = $request->string('asset_type_id')->toString() ?: null;
        $agentId = $request->string('agent_id')->toString() ?: null;
        $userId = $request->string('user_id')->toString() ?: null;
        $page = max(1, (int) $request->query('page', 1));
        $perPage = min(max((int) $request->query('per_page', 12), 1), 100);
        $zoneId = $request->string('zone_id')->toString() ?: null;
        $isSearch = $this->isSearchRequest($request);
        $searchQuery = $this->searchQueryFromRequest($request);

        $propertyTypes = $this->loadPropertyTypes($api);
        $zones = $this->loadZones($api);
        $currentZone = $this->resolveCurrentZone($zoneId, $zones);
        $currentType = $assetTypeId
            ? $propertyTypes->first(fn (PropertyTypeData $type) => $type->id === $assetTypeId)
            : null;

        $properties = collect();
        $paginator = null;
        $apiError = null;

        try {
            if ($isSearch) {
                $response = $api->searchProperties(array_merge($searchQuery, [
                    'page' => $page,
                    'per_page' => $perPage,
                ]));

                $properties = collect($response->data)
                    ->map(fn (array $item) => PropertyData::fromArray($item));

                $meta = $response->meta ?? [];

                $paginator = new LengthAwarePaginator(
                    $properties,
                    (int) ($meta['total'] ?? $properties->count()),
                    (int) ($meta['per_page'] ?? $perPage),
                    (int) ($meta['current_page'] ?? $page),
                    [
                        'path' => $request->url(),
                        'query' => $request->query(),
                    ],
                );
            } elseif ($zoneId) {
                $response = $api->properties([
                    'asset_type_id' => $assetTypeId,
                    'agent_id' => $agentId,
                    'user_id' => $userId,
                    'zone_id' => $zoneId === 'all' ? null : $zoneId,
                    'page' => $page,
                    'per_page' => $perPage,
                ]);

                $properties = collect($response->data)
                    ->map(fn (array $item) => PropertyData::fromArray($item));

                $meta = $response->meta ?? [];

                $paginator = new LengthAwarePaginator(
                    $properties,
                    (int) ($meta['total'] ?? $properties->count()),
                    (int) ($meta['per_page'] ?? $perPage),
                    (int) ($meta['current_page'] ?? $page),
                    [
                        'path' => $request->url(),
                        'query' => $request->query(),
                    ],
                );
            }
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to load properties from API.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
                'asset_type_id' => $assetTypeId,
                'user_id' => $userId,
                'search' => $isSearch,
            ]);

            $apiError = 'ไม่สามารถโหลดรายการทรัพย์ได้ในขณะนี้ กรุณาลองใหม่อีกครั้ง';
        }

        $currentUser = $userId ? $api->findAgent($userId) : null;

        return view('pages.properties.index', [
            'properties' => $properties,
            'paginator' => $paginator,
            'propertyTypes' => $propertyTypes,
            'currentType' => $currentType,
            'currentUser' => $currentUser,
            'apiError' => $apiError,
            'totalCount' => $paginator?->total() ?? 0,
            'zoneId' => $zoneId,
            'zones' => $zones,
            'currentZone' => $currentZone,
            'isSearch' => $isSearch,
            'searchQuery' => $searchQuery,
        ]);
    }

    public function show(string $property, LoveThaiHomeService $api): View
    {
        try {
            $detail = $api->property($property);
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to load property detail from API.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
                'property_id' => $property,
            ]);

            if ($exception->statusCode === 404) {
                throw new NotFoundHttpException('ไม่พบทรัพย์สินที่ต้องการ');
            }

            abort(503, 'ไม่สามารถโหลดข้อมูลทรัพย์ได้ในขณะนี้');
        }

        $user = $this->resolveUser($api, $detail);

        PropertySeo::apply($detail);

        return view('pages.properties.show', [
            'property' => $detail,
            'user' => $user,
        ]);
    }

    public function recordView(string $property, LoveThaiHomeService $api): Response
    {
        try {
            $api->recordPropertyView($property);
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to record property view.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
                'property_id' => $property,
            ]);
        }

        return response()->noContent();
    }

    private function resolveUser(LoveThaiHomeService $api, PropertyDetailData $detail): ?AgentData
    {
        if ($detail->user) {
            return AgentData::fromArray($detail->user);
        }

        if ($detail->seller) {
            return AgentData::fromArray($detail->seller);
        }

        $agentId = $detail->agent['id'] ?? null;

        if ($agentId) {
            $matched = $api->findAgent($agentId);

            if ($matched) {
                return $matched;
            }
        }

        if ($detail->agent) {
            return new AgentData(
                id: (string) ($detail->agent['id'] ?? ''),
                firstName: (string) ($detail->agent['name'] ?? 'ตัวแทนขาย'),
                lastName: '',
                phone: null,
                email: null,
                lineId: null,
                profileImageUrl: $detail->agent['profile_image_url'] ?? null,
            );
        }

        return null;
    }

    /**
     * @return array{
     *     text?: string,
     *     asset_type_id?: string,
     *     province?: string,
     *     district?: string,
     *     amphur?: string,
     *     price_min?: string,
     *     price_max?: string,
     * }
     */
    private function searchQueryFromRequest(Request $request): array
    {
        $text = $request->string('text')->toString()
            ?: $request->string('q')->toString();

        $priceMax = $request->string('price_max')->toString();

        return array_filter([
            'text' => $text ?: null,
            'asset_type_id' => $request->string('asset_type_id')->toString() ?: null,
            'province' => $request->string('province')->toString() ?: null,
            'district' => $request->string('district')->toString() ?: null,
            'amphur' => $request->string('amphur')->toString() ?: null,
            'price_min' => $request->string('price_min')->toString() ?: null,
            'price_max' => $priceMax !== '' ? $priceMax : null,
        ], fn ($value) => $value !== null && $value !== '');
    }

    private function isSearchRequest(Request $request): bool
    {
        if ($request->boolean('search')) {
            return true;
        }

        return $request->hasAny([
            'text',
            'q',
            'province',
            'district',
            'amphur',
            'price_min',
            'price_max',
        ]);
    }

    /**
     * @return Collection<int, PropertyTypeData>
     */
    private function loadPropertyTypes(LoveThaiHomeService $api): Collection
    {
        try {
            return $api->propertyTypes();
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to load property types from API.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
            ]);

            return collect();
        }
    }

    /**
     * @return Collection<int, array{id: string, name: string, button_class: string, dot_class: string}>
     */
    private function loadZones(LoveThaiHomeService $api): Collection
    {
        return $api->zones()
            ->map(fn ($zone) => $this->formatZoneOption($zone->id, $zone->name))
            ->values();
    }

    /**
     * @param  Collection<int, array{id: string, name: string, button_class: string, dot_class: string}>  $zones
     * @return array{id: string, name: string, button_class: string, dot_class: string}|null
     */
    private function resolveCurrentZone(?string $zoneId, Collection $zones): ?array
    {
        if (! $zoneId) {
            return null;
        }

        if ($zoneId === 'all') {
            return $this->formatZoneOption('all', 'ทั้งหมด');
        }

        return $zones->first(fn (array $zone) => $zone['id'] === $zoneId);
    }

    /**
     * @return array{id: string, name: string, button_class: string, dot_class: string}
     */
    private function formatZoneOption(string $id, string $name): array
    {
        $style = config('lovethaihome_zone_styles.zones.'.$id)
            ?? config('lovethaihome_zone_styles.'.$id)
            ?? config('lovethaihome_zone_styles.default');

        return [
            'id' => $id,
            'name' => $name,
            'button_class' => $style['button_class'],
            'dot_class' => $style['dot_class'],
        ];
    }
}
