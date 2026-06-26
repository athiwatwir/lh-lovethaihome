<?php

namespace App\Data\LoveThaiHome;

readonly class AgentData
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public ?string $phone,
        public ?string $email,
        public ?string $lineId,
        public ?string $profileImageUrl,
        public ?int $seq,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) ($data['id'] ?? ''),
            firstName: (string) ($data['firstname'] ?? $data['first_name'] ?? ''),
            lastName: (string) ($data['lastname'] ?? $data['last_name'] ?? ''),
            phone: isset($data['phone']) ? (string) $data['phone'] : null,
            email: isset($data['email']) ? (string) $data['email'] : null,
            lineId: isset($data['lineid']) ? (string) $data['lineid'] : (isset($data['line_id']) ? (string) $data['line_id'] : null),
            profileImageUrl: isset($data['profile_image_url']) ? (string) $data['profile_image_url'] : null,
            seq: isset($data['seq']) ? (int) $data['seq'] : 0,
        );
    }

    public function fullName(): string
    {
        return trim($this->firstName . ' ' . $this->lastName);
    }

    public function profileImageOrPlaceholder(): string
    {
        return $this->profileImageUrl ?: asset('images/logo/logo.png');
    }

    public function telLink(): ?string
    {
        if (! $this->phone) {
            return null;
        }

        return 'tel:' . preg_replace('/\D+/', '', $this->phone);
    }
}
