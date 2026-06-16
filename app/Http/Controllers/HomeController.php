<?php

namespace App\Http\Controllers;

use App\Data\LoveThaiHome\AgentData;
use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use App\Services\LoveThaiHome\LoveThaiHomeService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(LoveThaiHomeService $api): \Illuminate\View\View
    {
        $propertyTypes = $this->loadPropertyTypes($api);
        $sellers = $this->loadSellers($api);

        return view('pages.home.index', compact('propertyTypes', 'sellers'));
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

    /**
     * @return Collection<int, array{id: string, name: string}>
     */
    private function loadSellers(LoveThaiHomeService $api): Collection
    {
        try {
            return $api->sellers()
                ->map(fn (array $item) => AgentData::fromArray($item))
                ->map(fn (AgentData $agent) => [
                    'id' => $agent->id,
                    'name' => $agent->fullName(),
                ])
                ->filter(fn (array $seller) => $seller['id'] !== '' && $seller['name'] !== '')
                ->values();
        } catch (LoveThaiHomeApiException $exception) {
            Log::warning('Failed to load sellers from API.', [
                'message' => $exception->getMessage(),
                'status' => $exception->statusCode,
            ]);

            return collect();
        }
    }
}
