<?php

namespace App\Data\LoveThaiHome;

readonly class PropertyData
{
    /**
     * @param  array{id: string, name: string}|null  $assetType
     * @param  array{id: string, name: string, code?: string}|null  $agent
     * @param  array{id: string, name: string}|null  $zone
     * @param  array<string, bool>|null  $listing
     * @param  array<string, mixed>|null  $address
     * @param  array<string, mixed>|null  $seller
     */
    public function __construct(
        public string $id,
        public string $code,
        public string $name,
        public ?array $assetType,
        public ?array $agent,
        public ?array $zone,
        public int $priceAmount,
        public ?int $priceRent,
        public ?array $listing,
        public bool $isRecommend,
        public ?string $thumbnailUrl,
        public int $imagesCount,
        public ?string $createdAt,
        public ?array $address,
        public ?array $seller,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            code: trim((string) ($data['code'] ?? '')),
            name: (string) ($data['name'] ?? ''),
            assetType: isset($data['asset_type']) ? (array) $data['asset_type'] : null,
            agent: isset($data['agent']) ? (array) $data['agent'] : null,
            zone: isset($data['zone']) ? (array) $data['zone'] : null,
            priceAmount: (int) ($data['price_amount'] ?? 0),
            priceRent: isset($data['price_rent']) ? (int) $data['price_rent'] : null,
            listing: isset($data['listing']) ? (array) $data['listing'] : null,
            isRecommend: (bool) ($data['is_recommend'] ?? false),
            thumbnailUrl: isset($data['thumbnail_url']) ? (string) $data['thumbnail_url'] : null,
            imagesCount: (int) ($data['images_count'] ?? 0),
            createdAt: isset($data['created_at']) ? (string) $data['created_at'] : null,
            address: isset($data['address']) && is_array($data['address']) ? $data['address'] : null,
            seller: isset($data['seller']) && is_array($data['seller']) ? $data['seller'] : null,
        );
    }

    public function formattedAddress(): ?string
    {
        if (! $this->address) {
            return null;
        }

        $parts = array_filter([
            $this->address['address1'] ?? null,
            $this->address['district'] ?? null,
            $this->address['amphur'] ?? null,
            $this->address['province_name'] ?? null,
            isset($this->address['zipcode']) ? (string) $this->address['zipcode'] : null,
        ]);

        return $parts === [] ? null : trim(implode(' ', $parts));
    }

    public function formattedPrice(): string
    {
        if (($this->listing['rent'] ?? false) && $this->priceRent > 0) {
            return number_format($this->priceRent) . ' บาท/เดือน';
        }

        if ($this->priceAmount > 0) {
            return number_format($this->priceAmount) . ' บาท';
        }

        return 'ติดต่อสอบถาม';
    }

    /**
     * @return list<string>
     */
    public function listingLabels(): array
    {
        $labels = [];

        if ($this->listing['sale'] ?? false) {
            $labels[] = 'ขาย';
        }

        if ($this->listing['rent'] ?? false) {
            $labels[] = 'เช่า';
        }

        if ($this->listing['sale_down'] ?? false) {
            $labels[] = 'ขายดาวน์';
        }

        if ($this->listing['sellout'] ?? false) {
            $labels[] = 'เซลล์เอาท์';
        }

        return $labels;
    }

    public function thumbnailOrPlaceholder(): string
    {
        return $this->thumbnailUrl ?: asset('images/cover/house.webp');
    }
}
