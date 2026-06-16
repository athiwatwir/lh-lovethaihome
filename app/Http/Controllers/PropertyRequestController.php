<?php

namespace App\Http\Controllers;

use App\Data\LoveThaiHome\AddressData;
use App\Data\LoveThaiHome\CustomerAssetData;
use App\Data\LoveThaiHome\CustomerData;
use App\Http\Requests\StoreCustomerAssetRequest;
use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use App\Services\LoveThaiHome\LoveThaiHomeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PropertyRequestController extends Controller
{
    public function index(LoveThaiHomeService $api): View
    {
        return view('pages.property-requests.index', [
            'propertyTypes' => $this->loadPropertyTypes($api),
        ]);
    }

    public function store(StoreCustomerAssetRequest $request, LoveThaiHomeService $api): RedirectResponse
    {
        $validated = $request->validated();

        $payload = new CustomerAssetData(
            type: 'sell',
            assetTypeId: $validated['asset_type_id'],
            priceAmount: isset($validated['price_amount']) ? (int) $validated['price_amount'] : null,
            pricePerWah: isset($validated['price_per_wah']) ? (int) $validated['price_per_wah'] : null,
            description: $validated['description'] ?? null,
            requestConsultation: (bool) ($validated['isreqconsult'] ?? true),
            customer: new CustomerData(
                fullname: $validated['customer']['fullname'],
                tel: $validated['customer']['tel'],
                email: $validated['customer']['email'] ?? null,
                lineId: $validated['customer']['lineid'] ?? null,
            ),
            address: new AddressData(
                address1: (string) data_get($validated, 'address.address1', ''),
                district: (string) data_get($validated, 'address.district', ''),
                amphur: (string) data_get($validated, 'address.amphur', ''),
                provinceName: (string) data_get($validated, 'address.province_name', ''),
                zipcode: (string) data_get($validated, 'address.zipcode', ''),
            ),
            areaRai: (int) ($validated['area_rai'] ?? 0),
            areaNgan: (int) ($validated['area_ngan'] ?? 0),
            areaWah: (float) ($validated['area_wah'] ?? 0),
            bedroom: isset($validated['bedroom']) ? (int) $validated['bedroom'] : null,
            bathroom: isset($validated['bathroom']) ? (int) $validated['bathroom'] : null,
        );

        try {
            $api->submitCustomerAsset($payload);
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to submit customer asset.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
                'body' => $exception->responseBody,
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'form' => $exception->responseBody['message'] ?? 'ไม่สามารถส่งข้อมูลได้ในขณะนี้ กรุณาลองใหม่อีกครั้ง',
                ]);
        }

        return redirect()
            ->route('property-requests.index')
            ->with('success', 'ส่งข้อมูลฝากขายเรียบร้อยแล้ว ทีมงานจะติดต่อกลับโดยเร็วที่สุด');
    }

    /**
     * @return Collection<int, \App\Data\LoveThaiHome\PropertyTypeData>
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
