<?php

namespace App\Data\LoveThaiHome;

readonly class ArticleData
{
    /**
     * @param  array{id: string, name: string}|null  $category
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?array $category,
        public ?string $coverImageUrl,
        public int $seq,
        public bool $isGlobal,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            name: (string) ($data['name'] ?? ''),
            category: isset($data['category']) ? (array) $data['category'] : null,
            coverImageUrl: isset($data['cover_image_url']) ? (string) $data['cover_image_url'] : null,
            seq: (int) ($data['seq'] ?? 0),
            isGlobal: (bool) ($data['is_global'] ?? false),
            createdAt: isset($data['created_at']) ? (string) $data['created_at'] : null,
            updatedAt: isset($data['updated_at']) ? (string) $data['updated_at'] : null,
        );
    }

    public function coverOrPlaceholder(): string
    {
        return filled($this->coverImageUrl) ? $this->coverImageUrl : asset('images/cover/no-image.webp');
    }
}
