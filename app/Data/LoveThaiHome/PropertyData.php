<?php

namespace App\Data\LoveThaiHome;

readonly class PropertyData
{
    /**
     * @param  array{id: string, name: string}|null  $assetType
     * @param  array{id: string, name: string, code?: string}|null  $agent
     * @param  array{id: string, name: string}|null  $zone
     * @param  array<string, bool>|null  $listing
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
        );
    }

    public function formattedPrice(): string
    {
        if (($this->listing['rent'] ?? false) && $this->priceRent > 0) {
            return number_format($this->priceRent).' บาท/เดือน';
        }

        if ($this->priceAmount > 0) {
            if ($this->priceAmount >= 1_000_000) {
                $millions = $this->priceAmount / 1_000_000;

                return rtrim(rtrim(number_format($millions, 2), '0'), '.').' ล้านบาท';
            }

            return number_format($this->priceAmount).' บาท';
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
