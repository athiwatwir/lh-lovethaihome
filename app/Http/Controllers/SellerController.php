<?php

namespace App\Http\Controllers;

use App\Data\LoveThaiHome\AgentData;
use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use App\Services\LoveThaiHome\LoveThaiHomeService;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class SellerController extends Controller
{
    public function index(LoveThaiHomeService $api): View
    {
        $sellers = collect();
        $apiError = null;

        try {
            $sellers = $api->sellers()
                ->map(fn(array $item) => AgentData::fromArray($item))
                ->filter(fn(AgentData $seller) => $seller->id !== '' && $seller->fullName() !== '')
                ->sortBy(fn(AgentData $seller) => $seller->seq)
                ->values();
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to load sellers from API.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
            ]);

            $apiError = 'ไม่สามารถโหลดรายชื่อตัวแทนขายได้ในขณะนี้ กรุณาลองใหม่อีกครั้ง';
        }

        $sellersForView = $sellers->map(fn(AgentData $seller) => [
            'id' => $seller->id,
            'name' => $seller->fullName(),
            'phone' => $seller->phone,
            'email' => $seller->email,
            'lineId' => $seller->lineId,
            'profileImageUrl' => $seller->profileImageOrPlaceholder(),
            'propertiesUrl' => route('properties.index', ['user_id' => $seller->id, 'zone_id' => 'all']),
            'telLink' => $seller->telLink(),
        ])->values()->all();

        return view('pages.sellers.index', [
            'sellers' => $sellers,
            'sellersForView' => $sellersForView,
            'apiError' => $apiError,
        ]);
    }
}
