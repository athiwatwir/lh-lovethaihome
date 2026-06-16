<?php

namespace App\Data\LoveThaiHome;

readonly class AddressData
{
    public function __construct(
        public string $address1,
        public string $district,
        public string $amphur,
        public string $provinceName,
        public string $zipcode,
    ) {}

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'address1' => $this->address1,
            'district' => $this->district,
            'amphur' => $this->amphur,
            'province_name' => $this->provinceName,
            'zipcode' => $this->zipcode,
        ];
    }
}
