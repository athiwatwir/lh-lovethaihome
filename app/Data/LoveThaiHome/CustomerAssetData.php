<?php

namespace App\Data\LoveThaiHome;

/**
 * Payload for POST /customer-assets (ฝากขาย/ฝากเช่า).
 */
readonly class CustomerAssetData
{
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
}
