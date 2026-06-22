<?php

namespace App\Data\LoveThaiHome;

readonly class ZoneData
{
    public function __construct(
        public string $id,
        public string $name,
        public int $seq = 0,
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
        );
    }
}
