<?php

namespace App\Data\LoveThaiHome;

use Illuminate\Support\Str;

readonly class PropertyData
{
    /**
     * @param  array{id: string, name: string, code?: string}|null  $assetType
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
        public ?int $pricePerWah,
        public ?array $listing,
        public bool $isRecommend,
        public ?string $thumbnailUrl,
        public int $imagesCount,
        public ?string $createdAt,
        public ?array $address,
        public ?array $seller,
        public ?string $slug,
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
            pricePerWah: isset($data['price_per_wah']) ? (int) $data['price_per_wah'] : null,
            listing: isset($data['listing']) ? (array) $data['listing'] : null,
            isRecommend: (bool) ($data['is_recommend'] ?? false),
            thumbnailUrl: isset($data['thumbnail_url']) ? (string) $data['thumbnail_url'] : null,
            imagesCount: (int) ($data['images_count'] ?? 0),
            createdAt: isset($data['created_at']) ? (string) $data['created_at'] : null,
            address: isset($data['address']) && is_array($data['address']) ? $data['address'] : null,
            seller: isset($data['seller']) && is_array($data['seller']) ? $data['seller'] : null,
            slug: isset($data['slug']) ? (string) $data['slug'] : null,
        );
    }

    public function formattedAddress(): ?string
    {
        if (! $this->address) {
            return null;
        }

        $soi = $this->withPrefix($this->address['soi'] ?? null, 'ซอย');
        $isBangkok = $this->isBangkokProvince($this->address['province'] ?? null);

        $parts = array_filter([
            $this->address['address1'] ?? null,
            $soi,
            $this->withPrefix($this->address['street'] ?? null, 'ถนน'),
            $this->withPrefix($this->address['district'] ?? null, $isBangkok ? 'แขวง' : 'ตำบล'),
            $this->withPrefix($this->address['amphur'] ?? null, $isBangkok ? 'เขต' : 'อำเภอ'),
            $this->address['province'] ?? null,
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

        return '';
    }

    public function formattedSalePrice(): string
    {
        if ($this->priceAmount > 0) {
            return number_format($this->priceAmount) . ' บาท';
        }

        return '';
    }

    public function formattedPriceRent(): ?string
    {
        if ($this->priceRent > 0) {
            return number_format($this->priceRent) . ' บาท/เดือน';
        }

        return null;
    }

    public function formattedPricePerWah(): ?string
    {
        if ($this->pricePerWah > 0) {
            return number_format($this->pricePerWah) . ' บาท/ตรว.';
        }

        return null;
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

        /*

        if ($this->listing['rent'] ?? false) {
            $labels[] = 'เช่า';
        }
            */


        return $labels;
    }

    public function thumbnailOrPlaceholder(): string
    {
        return $this->thumbnailUrl ?: asset('images/cover/no-image.webp');
    }

    public function urlSlug(): string
    {
        $slug = trim((string) ($this->slug ?? ''));

        if ($slug !== '') {
            return $slug;
        }

        $fromName = Str::slug($this->name);

        return $fromName !== '' ? $fromName : $this->code;
    }

    public function propertyTypeUrlSegment(): ?string
    {
        $name = trim((string) ($this->assetType['name'] ?? ''));

        if ($name !== '') {
            return self::normalizeTypeSegment($name);
        }

        $code = trim((string) ($this->assetType['code'] ?? ''));

        return $code !== '' ? self::normalizeTypeSegment($code) : null;
    }

    public static function normalizeTypeSegment(string $value): string
    {
        $value = rawurldecode(trim($value));
        $value = str_replace(['/', '\\'], '-', $value);
        $value = preg_replace('/\s+/u', '-', $value) ?? '';
        $value = preg_replace('/-+/u', '-', $value) ?? '';

        return trim($value, '-');
    }

    public function detailUrl(): string
    {
        $propertyTypeSegment = $this->propertyTypeUrlSegment();

        if ($propertyTypeSegment && $this->code !== '') {
            $params = [
                'propertyTypeCode' => $propertyTypeSegment,
                'propertyCode' => $this->code,
            ];

            $slug = $this->urlSlug();
            if ($slug !== '') {
                $params['slug'] = $slug;
            }

            return route('pages.properties.showByCode', $params);
        }

        return route('properties.show', $this->id);
    }

    private function isBangkokProvince(mixed $province): bool
    {
        $province = trim((string) ($province ?? ''));

        return $province !== '' && str_contains($province, 'กรุงเทพ');
    }

    private function withPrefix(mixed $value, string $prefix): ?string
    {
        $value = trim((string) ($value ?? ''));

        if ($value === '') {
            return null;
        }

        if (str_starts_with($value, $prefix)) {
            return $value;
        }

        return $prefix . $value;
    }
}
