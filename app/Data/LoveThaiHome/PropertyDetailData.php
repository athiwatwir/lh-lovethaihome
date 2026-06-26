<?php

namespace App\Data\LoveThaiHome;

readonly class PropertyDetailData
{
    /**
     * @param  array{id: string, name: string}|null  $assetType
     * @param  array{id: string, name: string, code?: string}|null  $agent
     * @param  array{id: string, firstname?: string, lastname?: string, phone?: string, email?: string, lineid?: string, profile_image_url?: string}|null  $user
     * @param  array{id: string, name: string}|null  $zone
     * @param  array<string, bool>|null  $listing
     * @param  list<string>  $images
     * @param  array<string, mixed>|null  $address
     */
    public function __construct(
        public string $id,
        public string $code,
        public string $name,
        public ?array $assetType,
        public ?array $agent,
        public ?array $user,
        public ?array $zone,
        public int $priceAmount,
        public ?int $priceRent,
        public ?array $listing,
        public bool $isRecommend,
        public ?string $thumbnailUrl,
        public int $imagesCount,
        public ?string $createdAt,
        public ?string $description,
        public array $images,
        public ?array $address,
        public ?int $bedroom,
        public ?int $bathroom,
        public ?float $areaRai,
        public ?float $areaNgan,
        public ?float $areaWah,
        public ?int $pricePerWah,
        public ?array $seller,
        public ?float $latitude,
        public ?float $longitude,
        public ?string $youtubeLink,
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
            user: isset($data['user']) ? (array) $data['user'] : null,
            zone: isset($data['zone']) ? (array) $data['zone'] : null,
            priceAmount: (int) ($data['price_amount'] ?? 0),
            priceRent: isset($data['price_rent']) ? (int) $data['price_rent'] : null,
            listing: isset($data['listing']) ? (array) $data['listing'] : null,
            isRecommend: (bool) ($data['is_recommend'] ?? false),
            thumbnailUrl: isset($data['thumbnail_url']) ? (string) $data['thumbnail_url'] : null,
            imagesCount: (int) ($data['images_count'] ?? 0),
            createdAt: isset($data['created_at']) ? (string) $data['created_at'] : null,
            description: isset($data['description']) ? (string) $data['description'] : null,
            images: self::parseImages($data),
            address: isset($data['address']) ? (array) $data['address'] : null,
            bedroom: isset($data['bedroom']) ? (int) $data['bedroom'] : null,
            bathroom: isset($data['bathroom']) ? (int) $data['bathroom'] : null,
            areaRai: isset($data['area_rai']) ? (float) $data['area_rai'] : null,
            areaNgan: isset($data['area_ngan']) ? (float) $data['area_ngan'] : null,
            areaWah: isset($data['area_wah']) ? (float) $data['area_wah'] : null,
            pricePerWah: isset($data['price_per_wah']) ? (int) $data['price_per_wah'] : null,
            seller: isset($data['seller']) ? (array) $data['seller'] : null,
            latitude: self::parseCoordinate($data, 'latitude')
                ?? (isset($data['address']) && is_array($data['address']) ? self::parseCoordinate($data['address'], 'latitude') : null),
            longitude: self::parseCoordinate($data, 'longitude')
                ?? (isset($data['address']) && is_array($data['address']) ? self::parseCoordinate($data['address'], 'longitude') : null),
            youtubeLink: isset($data['youtube_link']) && $data['youtube_link'] !== ''
                ? trim((string) $data['youtube_link'])
                : null,
        );
    }

    public function toPropertyData(): PropertyData
    {
        return PropertyData::fromArray([
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'asset_type' => $this->assetType,
            'agent' => $this->agent,
            'zone' => $this->zone,
            'price_amount' => $this->priceAmount,
            'price_rent' => $this->priceRent,
            'listing' => $this->listing,
            'is_recommend' => $this->isRecommend,
            'thumbnail_url' => $this->thumbnailUrl,
            'images_count' => $this->imagesCount,
            'created_at' => $this->createdAt,
            'address' => $this->address,
            'seller' => $this->seller,
        ]);
    }

    /**
     * @return list<string>
     */
    public function galleryImages(): array
    {
        $images = $this->images;

        if ($this->thumbnailUrl && ! in_array($this->thumbnailUrl, $images, true)) {
            array_unshift($images, $this->thumbnailUrl);
        }

        if ($images === []) {
            return [asset('images/cover/house.webp')];
        }

        return $images;
    }

    public function formattedPrice(): string
    {
        return $this->toPropertyData()->formattedPrice();
    }

    /**
     * @return list<array{label: string, value: string}>
     */
    public function priceDisplayLines(): array
    {
        $lines = [];

        if ($this->priceAmount > 0) {
            $lines[] = [
                'label' => 'ราคา',
                'value' => number_format($this->priceAmount) . ' บาท',
            ];
        }

        if ($this->pricePerWah > 0) {
            $lines[] = [
                'label' => 'ราคาต่อ ตรว.',
                'value' => number_format($this->pricePerWah) . ' บาท',
            ];
        }

        if ($this->priceRent > 0) {
            $lines[] = [
                'label' => 'เช่า',
                'value' => number_format($this->priceRent) . ' บาท/เดือน',
            ];
        }

        return $lines;
    }

    /**
     * @return list<string>
     */
    public function listingLabels(): array
    {
        return $this->toPropertyData()->listingLabels();
    }

    public function formattedArea(): ?string
    {
        $parts = [];

        if ($this->areaRai > 0) {
            $parts[] = rtrim(rtrim(number_format($this->areaRai, 2), '0'), '.') . ' ไร่';
        }

        if ($this->areaNgan > 0) {
            $parts[] = rtrim(rtrim(number_format($this->areaNgan, 2), '0'), '.') . ' งาน';
        }

        if ($this->areaWah > 0) {
            $parts[] = rtrim(rtrim(number_format($this->areaWah, 2), '0'), '.') . ' ตร.วา';
        }

        return $parts === [] ? null : implode(' ', $parts);
    }

    public function renderedDescription(): string
    {
        if (blank($this->description)) {
            return '';
        }

        $allowedTags = '<p><br><br/><strong><b><em><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><a><img><span><div><table><tr><td><th><tbody><thead><blockquote><hr><figure><figcaption>';

        if (str_contains($this->description, '<')) {
            return strip_tags($this->description, $allowedTags);
        }

        return nl2br(e($this->description));
    }

    public function formattedAddress(): ?string
    {
        return $this->toPropertyData()->formattedAddress();
    }

    public function hasMapCoordinates(): bool
    {
        if ($this->latitude === null || $this->longitude === null) {
            return false;
        }

        if (abs($this->latitude) > 90 || abs($this->longitude) > 180) {
            return false;
        }

        return $this->latitude != 0.0 || $this->longitude != 0.0;
    }

    public function googleMapsUrl(): string
    {
        return 'https://www.google.com/maps?q='.$this->latitude.','.$this->longitude;
    }

    public function googleMapsDirectionsUrl(): string
    {
        return 'https://www.google.com/maps/dir/?api=1&destination='.$this->latitude.','.$this->longitude;
    }

    public function youtubeEmbedUrl(): ?string
    {
        if (blank($this->youtubeLink)) {
            return null;
        }

        $videoId = self::extractYoutubeVideoId($this->youtubeLink);

        return $videoId ? 'https://www.youtube.com/embed/'.$videoId : null;
    }

    private static function extractYoutubeVideoId(string $url): ?string
    {
        $url = trim($url);

        if (preg_match('/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|shorts\/|live\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private static function parseCoordinate(array $data, string $key): ?float
    {
        $aliases = $key === 'latitude'
            ? ['latitude', 'lat']
            : ['longitude', 'lng', 'lon', 'long'];

        foreach ($aliases as $alias) {
            if (! array_key_exists($alias, $data) || $data[$alias] === null || $data[$alias] === '') {
                continue;
            }

            $value = (float) $data[$alias];

            if ($value != 0.0) {
                return $value;
            }
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return list<string>
     */
    private static function parseImages(array $data): array
    {
        $raw = $data['images'] ?? [];

        if (! is_array($raw)) {
            return [];
        }

        return collect($raw)
            ->map(function ($item) {
                if (is_string($item)) {
                    return $item;
                }

                if (is_array($item)) {
                    return $item['url'] ?? $item['image_url'] ?? $item['thumbnail_url'] ?? null;
                }

                return null;
            })
            ->filter()
            ->values()
            ->all();
    }
}
