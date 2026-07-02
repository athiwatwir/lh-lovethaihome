<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ThaiAddressService
{
    private const DATA_BASE_URL = 'https://raw.githubusercontent.com/kongvut/thai-province-data/refs/heads/master/api/latest';

    /**
     * @return Collection<int, array{id: int, name: string}>
     */
    public function provinces(): Collection
    {
        return collect($this->dataset('province'))
            ->map(fn (array $item) => [
                'id' => (int) $item['id'],
                'name' => (string) $item['name_th'],
            ])
            ->sortBy('name', SORT_NATURAL)
            ->values();
    }

    /**
     * @return Collection<int, array{id: int, name: string}>
     */
    public function districts(int $provinceId): Collection
    {
        return collect($this->dataset('district'))
            ->filter(fn (array $item) => (int) $item['province_id'] === $provinceId)
            ->map(fn (array $item) => [
                'id' => (int) $item['id'],
                'name' => (string) $item['name_th'],
            ])
            ->sortBy('name', SORT_NATURAL)
            ->values();
    }

    /**
     * @return Collection<int, array{id: int, name: string}>
     */
    public function subDistricts(int $districtId): Collection
    {
        return collect($this->dataset('sub_district'))
            ->filter(fn (array $item) => (int) $item['district_id'] === $districtId)
            ->map(fn (array $item) => [
                'id' => (int) $item['id'],
                'name' => (string) $item['name_th'],
            ])
            ->sortBy('name', SORT_NATURAL)
            ->values();
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function dataset(string $type): array
    {
        $file = match ($type) {
            'province' => 'province.json',
            'district' => 'district.json',
            'sub_district' => 'sub_district.json',
            default => throw new \InvalidArgumentException("Unknown Thai address dataset [{$type}]."),
        };

        return Cache::remember("thai_address.{$type}", now()->addMonth(), function () use ($file) {
            $response = Http::timeout(30)->get(self::DATA_BASE_URL.'/'.$file);

            if (! $response->successful()) {
                return [];
            }

            $data = $response->json();

            return is_array($data) ? $data : [];
        });
    }
}
