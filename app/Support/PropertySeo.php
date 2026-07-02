<?php

namespace App\Support;

use App\Data\LoveThaiHome\PropertyDetailData;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Str;

class PropertySeo
{
    public static function apply(PropertyDetailData $property): void
    {
        $canonicalUrl = route('properties.show', $property->id);
        $title = self::title($property);
        $description = self::description($property);
        $image = self::primaryImage($property);

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($canonicalUrl);

        OpenGraph::setTitle($title);
        OpenGraph::setDescription($description);
        OpenGraph::setUrl($canonicalUrl);
        OpenGraph::setType('website');
        OpenGraph::setSiteName(config('seotools.meta.defaults.title', 'Love Thai Home'));

        if ($image) {
            OpenGraph::addImage($image);
        }

        TwitterCard::setType('summary_large_image');
        TwitterCard::setTitle($title);
        TwitterCard::setDescription($description);

        if ($image) {
            TwitterCard::setImage($image);
        }

        JsonLdMulti::setType('RealEstateListing');
        JsonLdMulti::setTitle($property->name);
        JsonLdMulti::setDescription($description);
        JsonLdMulti::setUrl($canonicalUrl);

        $listing = array_filter([
            '@id' => $canonicalUrl,
            'name' => $property->name,
            'url' => $canonicalUrl,
            'description' => $description,
            'image' => self::images($property),
        ]);

        if ($offer = self::offer($property)) {
            $listing['offers'] = $offer;
        }

        if ($address = self::postalAddress($property)) {
            $listing['address'] = $address;
        }

        if ($property->hasMapCoordinates()) {
            $listing['geo'] = [
                '@type' => 'GeoCoordinates',
                'latitude' => $property->latitude,
                'longitude' => $property->longitude,
            ];
        }

        if ($image) {
            JsonLdMulti::setImage($image);
        }

        JsonLdMulti::addValues($listing);
    }

    public static function title(PropertyDetailData $property): string
    {
        $title = $property->name;

        if ($property->code !== '') {
            $title .= ' #'.$property->code;
        }

        return $title;
    }

    public static function description(PropertyDetailData $property): string
    {
        $chunks = array_filter([
            $property->assetType['name'] ?? null,
            $property->zone['name'] ?? null,
            $property->formattedAddress(),
            collect($property->priceDisplayLines())
                ->map(fn (array $line) => $line['label'].': '.$line['value'])
                ->implode(' '),
            self::plainDescriptionExcerpt($property, 100),
        ]);

        $description = $chunks !== []
            ? implode(' · ', $chunks)
            : $property->name;

        return Str::limit($description, 160, '…');
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function breadcrumbItems(PropertyDetailData $property): array
    {
        $items = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'หน้าหลัก',
                'item' => route('home'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'รายการทรัพย์สิน',
                'item' => route('properties.index', array_filter([
                    'zone_id' => 'all',
                    'asset_type_id' => $property->assetType['id'] ?? null,
                ])),
            ],
        ];

        $items[] = [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $property->code !== '' ? '#'.$property->code : $property->name,
            'item' => route('properties.show', $property->id),
        ];

        return $items;
    }

    /**
     * @return list<string>
     */
    public static function images(PropertyDetailData $property): array
    {
        return collect($property->galleryImages())
            ->map(fn (string $url) => self::absoluteImageUrl($url))
            ->filter()
            ->unique()
            ->take(10)
            ->values()
            ->all();
    }

    public static function primaryImage(PropertyDetailData $property): ?string
    {
        return self::images($property)[0] ?? null;
    }

    /**
     * @return array<string, mixed>|null
     */
    private static function offer(PropertyDetailData $property): ?array
    {
        if ($property->priceAmount > 0) {
            return [
                '@type' => 'Offer',
                'price' => (string) $property->priceAmount,
                'priceCurrency' => 'THB',
                'availability' => 'https://schema.org/InStock',
            ];
        }

        if ($property->priceRent > 0) {
            return [
                '@type' => 'Offer',
                'price' => (string) $property->priceRent,
                'priceCurrency' => 'THB',
                'availability' => 'https://schema.org/InStock',
            ];
        }

        return null;
    }

    /**
     * @return array<string, mixed>|null
     */
    private static function postalAddress(PropertyDetailData $property): ?array
    {
        if (! $property->address) {
            return null;
        }

        $address = array_filter([
            '@type' => 'PostalAddress',
            'streetAddress' => $property->address['address1'] ?? null,
            'addressLocality' => $property->address['district'] ?? null,
            'addressRegion' => $property->address['amphur'] ?? $property->address['province_name'] ?? null,
            'postalCode' => isset($property->address['zipcode']) ? (string) $property->address['zipcode'] : null,
            'addressCountry' => 'TH',
        ], fn ($value) => $value !== null && $value !== '');

        return count($address) > 1 ? $address : null;
    }

    private static function absoluteImageUrl(string $url): ?string
    {
        $url = trim($url);

        if ($url === '') {
            return null;
        }

        if (str_starts_with($url, '//')) {
            return 'https:'.$url;
        }

        if (str_starts_with($url, '/')) {
            return url($url);
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }

        return url($url);
    }

    private static function plainDescriptionExcerpt(PropertyDetailData $property, int $limit): ?string
    {
        if (blank($property->description)) {
            return null;
        }

        $plain = trim(preg_replace('/\s+/u', ' ', strip_tags($property->description)) ?? '');

        return $plain !== '' ? Str::limit($plain, $limit, '…') : null;
    }
}
