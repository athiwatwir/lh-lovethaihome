<?php

namespace App\Http\Controllers;

use App\Services\LoveThaiHome\Exceptions\LoveThaiHomeApiException;
use App\Services\LoveThaiHome\LoveThaiHomeService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(LoveThaiHomeService $api): \Illuminate\View\View
    {
        $propertyTypes = $this->loadPropertyTypes($api);

        return view('pages.home.index', compact('propertyTypes'));
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
