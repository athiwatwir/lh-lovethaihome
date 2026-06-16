<?php

namespace App\Data\LoveThaiHome;

readonly class PaginatedResponse
{
    /**
     * @param  list<array<string, mixed>>  $data
     * @param  array<string, mixed>|null  $links
     * @param  array<string, mixed>|null  $meta
     */
    public function __construct(
        public array $data,
        public ?array $links = null,
        public ?array $meta = null,
    ) {}

    /**
     * @param  array<string, mixed>  $payload
     */
    public static function fromArray(array $payload): self
    {
        return new self(
            data: $payload['data'] ?? [],
            links: $payload['links'] ?? null,
            meta: $payload['meta'] ?? null,
        );
    }
}
