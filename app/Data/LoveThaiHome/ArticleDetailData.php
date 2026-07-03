<?php

namespace App\Data\LoveThaiHome;

use App\Support\RichHtml;

readonly class ArticleDetailData
{
    /**
     * @param  array{id: string, name: string}|null  $category
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?string $text,
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
            text: isset($data['text']) ? (string) $data['text'] : null,
            category: isset($data['category']) ? (array) $data['category'] : null,
            coverImageUrl: isset($data['cover_image_url']) ? (string) $data['cover_image_url'] : null,
            seq: (int) ($data['seq'] ?? 0),
            isGlobal: (bool) ($data['is_global'] ?? false),
            createdAt: isset($data['created_at']) ? (string) $data['created_at'] : null,
            updatedAt: isset($data['updated_at']) ? (string) $data['updated_at'] : null,
        );
    }

    public function renderedText(): string
    {
        return RichHtml::render($this->text);
    }
}
