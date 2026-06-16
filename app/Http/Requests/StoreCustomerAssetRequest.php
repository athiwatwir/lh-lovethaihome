<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerAssetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'asset_type_id' => ['required', 'uuid'],
            'price_amount' => ['nullable', 'integer', 'min:0'],
            'price_per_wah' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:5000'],
            'isreqconsult' => ['nullable', 'boolean'],
            'customer.fullname' => ['required', 'string', 'max:255'],
            'customer.tel' => ['required', 'string', 'max:30'],
            'customer.email' => ['nullable', 'email', 'max:255'],
            'customer.lineid' => ['nullable', 'string', 'max:100'],
            'address.address1' => ['nullable', 'string', 'max:500'],
            'address.district' => ['nullable', 'string', 'max:255'],
            'address.amphur' => ['nullable', 'string', 'max:255'],
            'address.province_name' => ['nullable', 'string', 'max:255'],
            'address.zipcode' => ['nullable', 'string', 'max:10'],
            'area_rai' => ['nullable', 'integer', 'min:0'],
            'area_ngan' => ['nullable', 'integer', 'min:0', 'max:3'],
            'area_wah' => ['nullable', 'numeric', 'min:0'],
            'bedroom' => ['nullable', 'integer', 'min:0'],
            'bathroom' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'asset_type_id' => 'ประเภทอสังหาฯ',
            'price_amount' => 'ราคาขาย',
            'price_per_wah' => 'ราคาต่อตร.วา',
            'description' => 'รายละเอียดเพิ่มเติม',
            'customer.fullname' => 'ชื่อ-นามสกุล',
            'customer.tel' => 'เบอร์โทรศัพท์',
            'customer.email' => 'อีเมล',
            'customer.lineid' => 'LINE ID',
            'address.address1' => 'บ้านเลขที่ / ที่อยู่',
            'address.district' => 'ตำบล / แขวง',
            'address.amphur' => 'อำเภอ / เขต',
            'address.province_name' => 'จังหวัด',
            'address.zipcode' => 'รหัสไปรษณีย์',
            'area_rai' => 'ไร่',
            'area_ngan' => 'งาน',
            'area_wah' => 'ตารางวา',
            'bedroom' => 'ห้องนอน',
            'bathroom' => 'ห้องน้ำ',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'isreqconsult' => $this->boolean('isreqconsult'),
        ]);
    }
}
