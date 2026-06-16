<?php

namespace App\Http\Controllers;

use App\Data\LoveThaiHome\AgentData;
use App\Data\LoveThaiHome\PropertyData;
use App\Data\LoveThaiHome\PropertyDetailData;
use App\Data\LoveThaiHome\PropertyTypeData;
use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use App\Services\LoveThaiHome\LoveThaiHomeService;
use Illuminate\Http\Request;
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
        $perPage = min(max((int) $request->query('per_page', 30), 1), 100);

        $propertyTypes = $this->loadPropertyTypes($api);
        $currentType = $assetTypeId
            ? $propertyTypes->first(fn (PropertyTypeData $type) => $type->id === $assetTypeId)
            : null;

        $properties = collect();
        $paginator = null;
        $apiError = null;

        try {
            $response = $api->properties([
                'asset_type_id' => $assetTypeId,
                'agent_id' => $agentId,
                'user_id' => $userId,
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
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to load properties from API.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
                'asset_type_id' => $assetTypeId,
                'user_id' => $userId,
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

        return view('pages.properties.show', [
            'property' => $detail,
            'user' => $user,
        ]);
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
}
