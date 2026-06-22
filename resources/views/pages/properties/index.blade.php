@extends('layouts.home')

@push('head')
    <link rel="preconnect" href="https://office.lovethaihome.com" crossorigin>
@endpush

@section('content')
@php
$listQuery = array_filter([
    'user_id' => $currentUser?->id,
    'zone_id' => $zoneId,
    'asset_type_id' => $currentType?->id,
]);
$typeFilterBaseQuery = array_filter([
    'user_id' => $currentUser?->id,
    'zone_id' => $zoneId,
]);
$zonePickerQuery = array_filter([
'user_id' => $currentUser?->id,
'asset_type_id' => $currentType?->id,
]);
$showZoneModal = ! $zoneId;
@endphp

<div class="bg-gray-50 antialiased" x-data="{ zoneModalOpen: @js($showZoneModal) }" @if ($zoneId) @keydown.escape.window="zoneModalOpen = false" @endif>
    {{-- Zone selection modal --}}
    <div x-show="zoneModalOpen" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-labelledby="zone-modal-title">
        <div class="absolute inset-0 bg-blue-950/60 backdrop-blur-sm" aria-hidden="true" @if ($zoneId) @click="zoneModalOpen = false" @endif></div>

        <div class="relative z-10 w-full max-w-3xl overflow-hidden rounded-2xl border border-white/20 bg-white shadow-2xl">
            <div class="relative border-b border-gray-100 bg-linear-to-r from-blue-800 to-blue-600 px-6 py-5 text-white">
                @if ($zoneId)
                <button type="button" @click="zoneModalOpen = false" class="absolute right-4 top-4 rounded-lg p-1 text-white/80 transition hover:bg-white/10 hover:text-white" aria-label="ปิด">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                @endif
                <h2 id="zone-modal-title" class="heading-font text-xl font-bold md:text-2xl">
                    เลือกโซนที่ต้องการค้นหา
                </h2>
                <p class="mt-1 text-sm text-blue-100">
                    กรุณาเลือกโซนบนแผนที่กรุงเทพฯ และปริมณฑลก่อนดูรายการทรัพย์สิน
                </p>
            </div>

            <div class="max-h-[calc(100vh-12rem)] overflow-y-auto p-6">
                <img src="{{ asset('images/zone-map.webp') }}" alt="แผนที่กรุงเทพฯ และปริมณฑล แบ่งตาม 5 โซน" class="mx-auto w-full rounded-xl border border-gray-200 shadow-sm">

                <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                    @php
                    $allZoneStyle = config('lovethaihome_zone_styles.all');
                    @endphp
                    <a href="{{ route('properties.index', array_merge($zonePickerQuery, ['zone_id' => 'all'])) }}" @class([ 'flex items-center gap-3 rounded-xl border-2 px-4 py-3 text-left text-sm font-semibold transition' , $allZoneStyle['button_class'], 'ring-2 ring-blue-700 ring-offset-2'=> $zoneId === 'all',
                        ])>
                        <span @class(['h-3 w-3 shrink-0 rounded-full', $allZoneStyle['dot_class']]) aria-hidden="true"></span>
                        <span>ทั้งหมด</span>
                    </a>

                    @foreach ($zones as $zone)
                    <a href="{{ route('properties.index', array_merge($zonePickerQuery, ['zone_id' => $zone['id']])) }}" @class([ 'flex items-center gap-3 rounded-xl border-2 px-4 py-3 text-left text-sm font-semibold transition' , $zone['button_class'], 'ring-2 ring-blue-700 ring-offset-2'=> $zoneId === $zone['id'],
                        ])>
                        <span @class(['h-3 w-3 shrink-0 rounded-full', $zone['dot_class']]) aria-hidden="true"></span>
                        <span>{{ $zone['name'] }}</span>
                    </a>
                    @endforeach
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="text-sm text-gray-500 transition hover:text-blue-700 hover:underline">
                        กลับหน้าหลัก
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Header --}}
    <section class="border-b border-blue-100 bg-linear-to-r from-blue-800 to-blue-600 text-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <nav class="mb-4 text-sm text-blue-100">
                <a href="{{ route('home') }}" class="hover:text-white">หน้าหลัก</a>
                <span class="mx-2">/</span>
                <span class="text-white">รายการทรัพย์สิน</span>
            </nav>

            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="heading-font text-2xl font-bold md:text-3xl">
                        @if ($currentUser)
                        ทรัพย์ของ {{ $currentUser->fullName() }}
                        @elseif ($currentType)
                        {{ $currentType->name }}
                        @else
                        รายการทรัพย์สินทั้งหมด
                        @endif
                    </h1>

                    @if ($currentZone)
                    <p class="mt-2 text-blue-100">
                        โซน: {{ $currentZone['name'] }}
                    </p>
                    @endif

                    @if ($paginator)
                    <p class="mt-2 text-blue-100">
                        พบ {{ number_format($totalCount) }} รายการ
                        @if ($paginator->currentPage() > 1)
                        — หน้า {{ $paginator->currentPage() }} จาก {{ $paginator->lastPage() }}
                        @endif
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{-- Current zone selector --}}
        <div class="mb-6">
            <button type="button" @click="zoneModalOpen = true" @class([ 'inline-flex w-full items-center justify-between gap-3 rounded-xl border-2 px-4 py-3 text-left text-sm font-semibold shadow-sm transition hover:shadow-md sm:w-auto' , $currentZone ? $currentZone['button_class'] : 'border-dashed border-gray-300 bg-white text-gray-700 hover:border-blue-400 hover:text-blue-700' , ])>
                <span class="flex min-w-0 items-center gap-2.5">
                    @if ($currentZone)
                    <span @class(['h-3 w-3 shrink-0 rounded-full', $currentZone['dot_class']]) aria-hidden="true"></span>
                    <span class="truncate">{{ $currentZone['name'] }}</span>
                    @else
                    <svg class="h-5 w-5 shrink-0 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>เลือกโซน</span>
                    @endif
                </span>
                <span class="flex shrink-0 items-center gap-1 text-xs font-medium text-blue-700">
                    {{ $currentZone ? 'เปลี่ยนโซน' : 'เลือก' }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </button>
        </div>

        {{-- Filter: property types --}}
        @if ($propertyTypes->isNotEmpty())
        {{-- Mobile: dropdown --}}
        <div class="relative mb-8 md:hidden">
            <label for="asset-type-filter" class="mb-2 block text-sm font-medium text-gray-700">ประเภททรัพย์</label>
            <div class="relative">
                <select
                    id="asset-type-filter"
                    class="w-full appearance-none rounded-xl border border-gray-300 bg-white py-3 pl-4 pr-10 text-sm font-medium text-gray-900 shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none"
                    onchange="if (this.value) { window.location.href = this.value; }">
                    <option value="{{ route('properties.index', $typeFilterBaseQuery) }}" @selected(! $currentType)>ทั้งหมด</option>
                    @foreach ($propertyTypes as $type)
                    <option
                        value="{{ route('properties.index', array_merge($typeFilterBaseQuery, ['asset_type_id' => $type->id])) }}"
                        @selected($currentType?->id === $type->id)>
                        {{ $type->name }}
                    </option>
                    @endforeach
                </select>
                <svg class="pointer-events-none absolute right-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>

        {{-- Desktop: chips --}}
        <div class="mb-8 hidden flex-wrap gap-2 md:flex">
            <a href="{{ route('properties.index', $typeFilterBaseQuery) }}" @class([
                'rounded-full border px-4 py-2 text-sm font-medium transition',
                'border-blue-700 bg-blue-700 text-white' => ! $currentType,
                'border-gray-300 bg-white text-gray-700 hover:border-blue-400 hover:text-blue-700' => $currentType,
            ])>
                ทั้งหมด
            </a>
            @foreach ($propertyTypes as $type)
            <a href="{{ route('properties.index', array_merge($typeFilterBaseQuery, ['asset_type_id' => $type->id])) }}" @class([
                'rounded-full border px-4 py-2 text-sm font-medium transition',
                'border-blue-700 bg-blue-700 text-white' => $currentType?->id === $type->id,
                'border-gray-300 bg-white text-gray-700 hover:border-blue-400 hover:text-blue-700' => $currentType?->id !== $type->id,
            ])>
                {{ $type->name }}
            </a>
            @endforeach
        </div>
        @endif

        @if (! $zoneId)
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-12 text-center">
            <p class="text-lg font-medium text-gray-700">กรุณาเลือกโซนเพื่อดูรายการทรัพย์สิน</p>
        </div>
        @elseif ($apiError)
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-6 text-center text-red-700">
            {{ $apiError }}
        </div>
        @elseif ($properties->isEmpty())
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <p class="mt-4 text-lg font-medium text-gray-700">ไม่พบทรัพย์สินในหมวดนี้</p>
            <a href="{{ route('home') }}" class="mt-4 inline-block text-blue-700 hover:underline">กลับหน้าหลัก</a>
        </div>
        @else
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($properties as $property)
            <x-property-card :property="$property" :image-index="$loop->index" />
            @endforeach
        </div>

        @if ($paginator && $paginator->hasPages())
        <div class="mt-10">
            {{ $paginator->onEachSide(1)->links() }}
        </div>
        @endif
        @endif
    </div>
</div>
@endsection
