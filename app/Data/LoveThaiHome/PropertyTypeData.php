<?php

namespace App\Data\LoveThaiHome;

readonly class PropertyTypeData
{
    public function __construct(
        public string $id,
        public string $name,
        public int $seq,
        public ?string $imageUrl,
        public ?string $createdAt,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            name: (string) $data['name'],
            seq: (int) ($data['seq'] ?? 0),
            imageUrl: isset($data['image_url']) ? (string) $data['image_url'] : null,
            createdAt: isset($data['created_at']) ? (string) $data['created_at'] : null,
        );
    }
}
