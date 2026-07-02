<?php

namespace App\Http\Controllers;

use App\Services\ThaiAddressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThaiAddressController extends Controller
{
    public function provinces(ThaiAddressService $addresses): JsonResponse
    {
        return response()->json($addresses->provinces());
    }

    public function districts(Request $request, ThaiAddressService $addresses): JsonResponse
    {
        $provinceId = (int) $request->query('province_id', 0);

        if ($provinceId <= 0) {
            return response()->json([]);
        }

        return response()->json($addresses->districts($provinceId));
    }

    public function subDistricts(Request $request, ThaiAddressService $addresses): JsonResponse
    {
        $districtId = (int) $request->query('district_id', 0);

        if ($districtId <= 0) {
            return response()->json([]);
        }

        return response()->json($addresses->subDistricts($districtId));
    }
}
