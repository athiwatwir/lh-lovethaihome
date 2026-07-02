@props([
    'propertyTypes',
])

@php
$fieldClass = 'w-full rounded-xl border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none disabled:cursor-not-allowed disabled:bg-gray-50 disabled:opacity-60';
$selectClass = $fieldClass . ' appearance-none pr-9';
$labelClass = 'mb-1.5 block text-xs font-semibold tracking-wide text-gray-600';
$searchText = request('text', request('q', ''));
@endphp

<div x-data="propertySearchAddress({
    provincesUrl: @js(route('api.thai-addresses.provinces')),
    districtsUrl: @js(route('api.thai-addresses.districts')),
    subDistrictsUrl: @js(route('api.thai-addresses.sub-districts')),
    initialProvince: @js(request('province', '')),
    initialAmphur: @js(request('amphur', '')),
    initialDistrict: @js(request('district', '')),
})">
<form
    method="GET"
    action="{{ route('properties.index') }}"
    class="flex flex-col gap-5 transition-opacity duration-200"
    :class="submitting ? 'pointer-events-none opacity-70' : ''"
    @submit="submitting = true"
>
    <input type="hidden" name="search" value="1">
    <input type="hidden" name="province" :value="provinceName">
    <input type="hidden" name="amphur" :value="amphurName">
    <input type="hidden" name="district" :value="districtName">

    {{-- ค้นหา + หมวดหมู่ --}}
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-[7fr_3fr] sm:items-end">
        <div class="min-w-0">
            <label for="property-search-text" class="{{ $labelClass }}">คำค้นหา</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-gray-400" aria-hidden="true">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input
                    id="property-search-text"
                    type="search"
                    name="text"
                    value="{{ $searchText }}"
                    class="{{ $fieldClass }} pl-10"
                    placeholder="รหัสทรัพย์, หมู่บ้าน, ถนน, ทำเล..."
                >
            </div>
        </div>
        <div class="min-w-0">
            <label for="property-search-type" class="{{ $labelClass }}">หมวดหมู่ทรัพย์</label>
            <div class="relative">
                <select id="property-search-type" name="asset_type_id" class="{{ $selectClass }}">
                    <option value="">ทั้งหมด</option>
                    @foreach ($propertyTypes as $type)
                        <option value="{{ $type->id }}" @selected(request('asset_type_id') === $type->id)>{{ $type->name }}</option>
                    @endforeach
                </select>
                <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
    </div>

    {{-- ที่อยู่ --}}
    <div>
        <p class="{{ $labelClass }} mb-2">ที่อยู่</p>
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
            <div class="relative min-w-0">
                <select
                    class="{{ $selectClass }}"
                    aria-label="จังหวัด"
                    x-model="provinceId"
                    @change="onProvinceChange()"
                    :disabled="loadingProvinces"
                >
                    <option value="">จังหวัด (ทั้งหมด)</option>
                    <template x-for="province in provinces" :key="province.id">
                        <option :value="province.id" x-text="province.name"></option>
                    </template>
                </select>
                <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div class="relative min-w-0">
                <select
                    class="{{ $selectClass }}"
                    aria-label="เขตหรืออำเภอ"
                    x-model="districtId"
                    @change="onDistrictChange()"
                    :disabled="! provinceId || loadingDistricts"
                >
                    <option value="" x-text="provinceId ? (loadingDistricts ? 'กำลังโหลด...' : 'เขต/อำเภอ (ทั้งหมด)') : 'เลือกจังหวัดก่อน'"></option>
                    <template x-for="district in districts" :key="district.id">
                        <option :value="district.id" x-text="district.name"></option>
                    </template>
                </select>
                <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div class="relative min-w-0">
                <select
                    class="{{ $selectClass }}"
                    aria-label="แขวงหรือตำบล"
                    x-model="subDistrictId"
                    :disabled="! districtId || loadingSubDistricts"
                >
                    <option value="" x-text="districtId ? (loadingSubDistricts ? 'กำลังโหลด...' : 'แขวง/ตำบล (ทั้งหมด)') : 'เลือกเขต/อำเภอก่อน'"></option>
                    <template x-for="subDistrict in subDistricts" :key="subDistrict.id">
                        <option :value="subDistrict.id" x-text="subDistrict.name"></option>
                    </template>
                </select>
                <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
    </div>

    {{-- ช่วงราคา --}}
    <div x-data="propertySearchPrice({
        min: @js(request('price_min', '')),
        max: @js(request('price_max', '')),
    })">
        <div class="mb-2.5 flex flex-wrap items-center justify-between gap-2">
            <p class="{{ $labelClass }} mb-0">ช่วงราคา</p>
            <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700 ring-1 ring-blue-100" x-text="priceSummary"></span>
        </div>

        <div class="-mx-1 mb-3 flex gap-2 overflow-x-auto px-1 pb-1 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <template x-for="preset in presets" :key="preset.label">
                <button
                    type="button"
                    class="shrink-0 rounded-full border px-3 py-1.5 text-xs font-medium transition focus:outline-none focus:ring-2 focus:ring-blue-500/30"
                    :class="isPresetActive(preset)
                        ? 'border-blue-600 bg-blue-600 text-white shadow-sm'
                        : 'border-gray-200 bg-white text-gray-600 hover:border-blue-300 hover:text-blue-700'"
                    @click="applyPreset(preset)"
                    x-text="preset.label"
                ></button>
            </template>
        </div>

        <div class="grid grid-cols-1 gap-3 sm:grid-cols-[1fr_auto_1fr] sm:items-end">
            <div class="min-w-0">
                <label for="price_min" class="{{ $labelClass }}">ราคาต่ำสุด</label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-sm font-medium text-gray-400" aria-hidden="true">฿</span>
                    <select id="price_min" name="price_min" x-model="priceMin" @change="onManualChange()" class="{{ $selectClass }} pl-8">
                        <option value="">ไม่จำกัด</option>
                        <option value="500000">500,000</option>
                        <option value="1000000">1 ล้าน</option>
                        <option value="2000000">2 ล้าน</option>
                        <option value="3000000">3 ล้าน</option>
                        <option value="5000000">5 ล้าน</option>
                        <option value="10000000">10 ล้าน</option>
                        <option value="20000000">20 ล้าน</option>
                        <option value="50000000">50 ล้าน</option>
                    </select>
                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <div class="hidden items-center justify-center pb-2.5 sm:flex">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-xs font-semibold text-gray-500">ถึง</span>
            </div>

            <div class="min-w-0">
                <label for="price_max" class="{{ $labelClass }}">ราคาสูงสุด</label>
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3.5 flex items-center text-sm font-medium text-gray-400" aria-hidden="true">฿</span>
                    <select id="price_max" name="price_max" x-model="priceMax" @change="onManualChange()" class="{{ $selectClass }} pl-8">
                        <option value="">ไม่จำกัด</option>
                        <option value="1000000">1 ล้าน</option>
                        <option value="2000000">2 ล้าน</option>
                        <option value="3000000">3 ล้าน</option>
                        <option value="5000000">5 ล้าน</option>
                        <option value="10000000">10 ล้าน</option>
                        <option value="20000000">20 ล้าน</option>
                        <option value="50000000">50 ล้าน</option>
                        <option value="100000000">100 ล้าน</option>
                        <option value="unlimited">ไม่จำกัด</option>
                    </select>
                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <button
        type="submit"
        class="inline-flex w-full items-center justify-center gap-2.5 rounded-xl bg-blue-700 px-6 py-3 text-base font-semibold text-white shadow-md transition hover:bg-blue-800 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:cursor-wait disabled:bg-blue-600 sm:w-auto sm:self-center sm:px-12"
        :disabled="submitting"
        :aria-busy="submitting"
    >
        <svg x-show="! submitting" class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <svg x-show="submitting" class="h-5 w-5 shrink-0 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span x-text="submitting ? 'กำลังค้นหา...' : 'ค้นหาทรัพย์สิน'"></span>
    </button>
</form>

<div
    x-show="submitting"
    x-cloak
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    class="fixed inset-0 z-[200] flex items-center justify-center bg-blue-950/45 p-4 backdrop-blur-sm"
    role="alertdialog"
    aria-modal="true"
    aria-labelledby="property-search-loading-title"
    aria-busy="true"
>
    <div class="w-full max-w-sm rounded-2xl border border-white/20 bg-white/95 px-8 py-10 text-center shadow-2xl">
        <div class="relative mx-auto mb-6 flex h-20 w-20 items-center justify-center">
            <span class="absolute inset-0 rounded-full border-2 border-blue-400/50 animate-search-ring" aria-hidden="true"></span>
            <span class="absolute inset-0 rounded-full border-2 border-blue-500/35 animate-search-ring-delayed" aria-hidden="true"></span>
            <span class="relative flex h-14 w-14 items-center justify-center rounded-full bg-linear-to-br from-blue-600 to-blue-700 text-white shadow-lg animate-search-icon-bounce" aria-hidden="true">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
        </div>

        <h2 id="property-search-loading-title" class="heading-font text-lg font-bold text-blue-900">
            กำลังค้นหาทรัพย์สิน
        </h2>
        <p class="mt-1 text-sm text-gray-500">รวบรวมผลลัพธ์ที่ตรงกับเงื่อนไขของคุณ</p>

        <div class="mt-5 flex items-center justify-center gap-1.5" aria-hidden="true">
            <span class="h-2 w-2 rounded-full bg-blue-600 animate-search-dot"></span>
            <span class="h-2 w-2 rounded-full bg-blue-500 animate-search-dot-delay-1"></span>
            <span class="h-2 w-2 rounded-full bg-blue-400 animate-search-dot-delay-2"></span>
        </div>
    </div>
</div>
</div>
