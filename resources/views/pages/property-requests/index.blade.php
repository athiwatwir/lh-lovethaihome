@extends('layouts.home')

@section('content')
<div class="bg-gray-50 antialiased">
    <section class="border-b border-blue-100 bg-linear-to-r from-blue-800 to-blue-600 text-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <nav class="mb-4 text-sm text-blue-100">
                <a href="{{ route('home') }}" class="hover:text-white">หน้าหลัก</a>
                <span class="mx-2">/</span>
                <span class="text-white">รับฝากขายบ้าน-ที่ดิน</span>
            </nav>

            <h1 class="heading-font text-2xl font-bold md:text-3xl">แบบฟอร์มรับฝากขายบ้าน-ที่ดิน</h1>
            <p class="mt-2 max-w-2xl text-blue-100">
                กรอกข้อมูลทรัพย์และช่องทางติดต่อ ทีมงานจะติดต่อกลับเพื่อให้คำปรึกษาฟรี ไม่มีค่าใช้จ่าย
            </p>
        </div>
    </section>

    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-4 text-emerald-800" role="status">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->has('form'))
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-red-700" role="alert">
                <p class="font-semibold">{{ $errors->first('form') }}</p>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('property-requests.store') }}"
            class="space-y-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm md:p-8"
        >
            @csrf

            {{-- ข้อมูลทรัพย์ --}}
            <section>
                <h2 class="heading-font text-lg font-bold text-blue-900">ข้อมูลทรัพย์</h2>

                <div class="mt-4 space-y-4">
                    <div>
                        <label for="asset_type_id" class="mb-1 block text-sm font-medium text-gray-700">ประเภทอสังหาฯ <span class="text-red-500">*</span></label>
                        <select
                            id="asset_type_id"
                            name="asset_type_id"
                            required
                            class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none"
                        >
                            <option value="">เลือกประเภทอสังหาฯ</option>
                            @foreach ($propertyTypes as $type)
                                <option value="{{ $type->id }}" @selected(old('asset_type_id') === $type->id)>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('asset_type_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="price_amount" class="mb-1 block text-sm font-medium text-gray-700">ราคาขาย (บาท)</label>
                            <input
                                type="number"
                                id="price_amount"
                                name="price_amount"
                                value="{{ old('price_amount') }}"
                                min="0"
                                step="1"
                                placeholder="เช่น 3500000"
                                class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none"
                            >
                            @error('price_amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="price_per_wah" class="mb-1 block text-sm font-medium text-gray-700">ราคาต่อตร.วา (บาท)</label>
                            <input
                                type="number"
                                id="price_per_wah"
                                name="price_per_wah"
                                value="{{ old('price_per_wah') }}"
                                min="0"
                                step="1"
                                placeholder="เช่น 50000"
                                class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none"
                            >
                            @error('price_per_wah')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label for="area_rai" class="mb-1 block text-sm font-medium text-gray-700">ไร่</label>
                            <input type="number" id="area_rai" name="area_rai" value="{{ old('area_rai', 0) }}" min="0" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('area_rai')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="area_ngan" class="mb-1 block text-sm font-medium text-gray-700">งาน</label>
                            <input type="number" id="area_ngan" name="area_ngan" value="{{ old('area_ngan', 0) }}" min="0" max="3" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('area_ngan')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="area_wah" class="mb-1 block text-sm font-medium text-gray-700">ตร.วา</label>
                            <input type="number" id="area_wah" name="area_wah" value="{{ old('area_wah', 0) }}" min="0" step="0.01" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('area_wah')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="bedroom" class="mb-1 block text-sm font-medium text-gray-700">ห้องนอน</label>
                            <input type="number" id="bedroom" name="bedroom" value="{{ old('bedroom') }}" min="0" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('bedroom')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="bathroom" class="mb-1 block text-sm font-medium text-gray-700">ห้องน้ำ</label>
                            <input type="number" id="bathroom" name="bathroom" value="{{ old('bathroom') }}" min="0" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('bathroom')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="mb-1 block text-sm font-medium text-gray-700">รายละเอียดเพิ่มเติม</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="บอกรายละเอียดทรัพย์ ทำเล จุดเด่น หรือข้อมูลอื่นๆ"
                            class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none"
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- ที่อยู่ทรัพย์ --}}
            <section class="border-t border-gray-100 pt-6">
                <h2 class="heading-font text-lg font-bold text-blue-900">ที่อยู่ทรัพย์</h2>

                <div class="mt-4 space-y-4">
                    <div>
                        <label for="address_address1" class="mb-1 block text-sm font-medium text-gray-700">บ้านเลขที่ / ที่อยู่</label>
                        <input type="text" id="address_address1" name="address[address1]" value="{{ old('address.address1') }}" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                        @error('address.address1')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="address_district" class="mb-1 block text-sm font-medium text-gray-700">ตำบล / แขวง</label>
                            <input type="text" id="address_district" name="address[district]" value="{{ old('address.district') }}" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('address.district')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="address_amphur" class="mb-1 block text-sm font-medium text-gray-700">อำเภอ / เขต</label>
                            <input type="text" id="address_amphur" name="address[amphur]" value="{{ old('address.amphur') }}" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('address.amphur')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="address_province_name" class="mb-1 block text-sm font-medium text-gray-700">จังหวัด</label>
                            <input type="text" id="address_province_name" name="address[province_name]" value="{{ old('address.province_name') }}" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('address.province_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="address_zipcode" class="mb-1 block text-sm font-medium text-gray-700">รหัสไปรษณีย์</label>
                            <input type="text" id="address_zipcode" name="address[zipcode]" value="{{ old('address.zipcode') }}" maxlength="10" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('address.zipcode')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </section>

            {{-- ข้อมูลติดต่อ --}}
            <section class="border-t border-gray-100 pt-6">
                <h2 class="heading-font text-lg font-bold text-blue-900">ข้อมูลติดต่อ</h2>

                <div class="mt-4 space-y-4">
                    <div>
                        <label for="customer_fullname" class="mb-1 block text-sm font-medium text-gray-700">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
                        <input type="text" id="customer_fullname" name="customer[fullname]" value="{{ old('customer.fullname') }}" required class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                        @error('customer.fullname')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="customer_tel" class="mb-1 block text-sm font-medium text-gray-700">เบอร์โทรศัพท์ <span class="text-red-500">*</span></label>
                            <input type="tel" id="customer_tel" name="customer[tel]" value="{{ old('customer.tel') }}" required placeholder="0812345678" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('customer.tel')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="customer_lineid" class="mb-1 block text-sm font-medium text-gray-700">LINE ID</label>
                            <input type="text" id="customer_lineid" name="customer[lineid]" value="{{ old('customer.lineid') }}" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                            @error('customer.lineid')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="customer_email" class="mb-1 block text-sm font-medium text-gray-700">อีเมล</label>
                        <input type="email" id="customer_email" name="customer[email]" value="{{ old('customer.email') }}" class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
                        @error('customer.email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <div class="border-t border-gray-100 pt-6">
                <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-blue-100 bg-blue-50/60 px-4 py-3">
                    <input
                        type="checkbox"
                        name="isreqconsult"
                        value="1"
                        class="mt-1 h-4 w-4 rounded border-gray-300 text-blue-700 focus:ring-blue-500"
                        @checked(session()->has('errors') ? (bool) old('isreqconsult') : true)
                    >
                    <span class="text-sm text-gray-700">
                        <span class="font-semibold text-blue-900">ต้องการให้ติดต่อกลับเพื่อปรึกษา</span>
                        <span class="mt-0.5 block text-gray-500">ทีมงานจะโทรหรือติดต่อกลับโดยเร็วที่สุด ไม่มีค่าใช้จ่าย</span>
                    </span>
                </label>
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    class="heading-font w-full rounded-xl bg-blue-700 px-6 py-3.5 text-base font-bold text-white shadow-md transition hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    ส่งข้อมูลฝากขาย
                </button>
                <p class="mt-3 text-center text-xs text-gray-500">
                    ข้อมูลของคุณจะถูกส่งไปยังทีมงาน Lovethaihome เพื่อดำเนินการต่อ
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
