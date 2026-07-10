<?php

namespace App\Data\LoveThaiHome;

use Illuminate\Http\UploadedFile;

/**
 * Payload for POST /customer-assets (ฝากขาย/ฝากเช่า).
 */
readonly class CustomerAssetData
{
    /**
     * @param  list<UploadedFile>  $images
     */
    public function __construct(
        public string $type,
        public string $assetTypeId,
        public ?int $priceAmount,
        public ?int $pricePerWah,
        public ?string $description,
        public bool $requestConsultation,
        public CustomerData $customer,
        public AddressData $address,
        public int $areaRai = 0,
        public int $areaNgan = 0,
        public float $areaWah = 0,
        public ?int $bedroom = null,
        public ?int $bathroom = null,
        public array $images = [],
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'asset_type_id' => $this->assetTypeId,
            'price_amount' => $this->priceAmount,
            'price_per_wah' => $this->pricePerWah,
            'description' => $this->description,
            'isreqconsult' => $this->requestConsultation ? 'Y' : 'N',
            'customer' => $this->customer->toArray(),
            'address' => $this->address->toArray(),
            'area_rai' => $this->areaRai,
            'area_ngan' => $this->areaNgan,
            'area_wah' => $this->areaWah,
            'bedroom' => $this->bedroom,
            'bathroom' => $this->bathroom,
        ], fn ($value) => $value !== null);
    }

    /**
     * @return list<array{name: string, contents: string|resource, filename?: string}>
     */
    public function toMultipart(): array
    {
        $parts = [];

        foreach ($this->toArray() as $name => $value) {
            if (is_array($value)) {
                continue;
            }

            $parts[] = [
                'name' => $name,
                'contents' => (string) $value,
            ];
        }

        foreach ($this->customer->toArray() as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $parts[] = [
                'name' => 'customer['.$key.']',
                'contents' => (string) $value,
            ];
        }

        foreach ($this->address->toArray() as $key => $value) {
            if ($value === '') {
                continue;
            }

            $parts[] = [
                'name' => 'address['.$key.']',
                'contents' => (string) $value,
            ];
        }

        foreach ($this->images as $image) {
            $parts[] = [
                'name' => 'images[]',
                'contents' => fopen($image->getRealPath(), 'r'),
                'filename' => $image->getClientOriginalName(),
            ];
        }

        return $parts;
    }
}
