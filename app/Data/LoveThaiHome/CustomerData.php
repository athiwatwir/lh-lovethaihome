<?php

namespace App\Data\LoveThaiHome;

readonly class CustomerData
{
    public function __construct(
        public string $fullname,
        public string $tel,
        public ?string $email = null,
        public ?string $lineId = null,
    ) {}

    /**
     * @return array<string, string|null>
     */
    public function toArray(): array
    {
        return [
            'fullname' => $this->fullname,
            'tel' => $this->tel,
            'email' => $this->email,
            'lineid' => $this->lineId,
        ];
    }
}
