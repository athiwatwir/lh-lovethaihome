@extends('layouts.home')

@php
$gallery = $property->galleryImages();
@endphp

@push('head')
<link rel="preconnect" href="https://office.lovethaihome.com" crossorigin>
@if (! empty($gallery[0]))
<link rel="preload" as="image" href="{{ $gallery[0] }}">
@endif
@endpush

@section('content')
<div class="bg-gray-50 antialiased" x-data="{
        activeImage: @js($gallery[0]),
        viewRecorded: false,
        init() {
            setTimeout(() => this.recordView(), 3000);
        },
        selectImage(image) {
            this.activeImage = image;
        },
        preloadImage(image) {
            if (! image) {
                return;
            }

            const loader = new Image();
            loader.decoding = 'async';
            loader.src = image;
        },
        recordView() {
            if (this.viewRecorded) {
                return;
            }

            this.viewRecorded = true;

            fetch(@js(route('properties.views', $property->id)), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': @js(csrf_token()),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                keepalive: true,
            }).catch(() => {});
        },
    }">
    <section class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
            <nav class="text-xs text-gray-500 md:text-sm">
                <a href="{{ route('home') }}" class="hover:text-blue-700">หน้าหลัก</a>
                <span class="mx-2">/</span>
                <a href="{{ route('properties.index', ['asset_type_id' => $property->assetType['id'] ?? null]) }}" class="hover:text-blue-700">รายการทรัพย์</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">#{{ $property->code }}</span>
            </nav>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-start justify-between gap-2 mb-4">
            <div>

                <h1 class="heading-font mt-1 text-lg font-bold leading-snug text-gray-900 sm:text-xl md:text-2xl">
                    {{ $property->name }}
                </h1>
            </div>
            <p class="text-2xl font-bold text-red-700 heading-font sm:text-3xl">{{ $property->formattedPrice() }}</p>
        </div>

        <div class="flex flex-col gap-8 lg:flex-row">
            {{-- Left 70% --}}
            <div class="w-full min-w-0 lg:w-[70%] lg:shrink-0">
                {{-- Gallery --}}
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="flex aspect-[16/10] items-center justify-center bg-gray-100">
                        <img :src="activeImage" alt="{{ $property->name }}" class="max-h-full max-w-full object-contain" loading="eager" decoding="async" fetchpriority="high">
                    </div>
                    @if (count($gallery) > 1)
                    <div class="flex gap-2 overflow-x-auto p-3">
                        @foreach ($gallery as $image)
                        <button type="button" @click="selectImage(@js($image))" @mouseenter="preloadImage(@js($image))" @focus="preloadImage(@js($image))" :class="activeImage === @js($image) ? 'ring-2 ring-blue-600' : 'ring-1 ring-gray-200'" class="flex h-20 w-28 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-gray-100">
                            <img src="{{ $image }}" alt="" class="max-h-full max-w-full object-contain" loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Main info --}}
                <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-4 shadow-sm sm:p-6">



                    <div class="mt-3 grid grid-cols-2 gap-4 sm:grid-cols-4">
                        @if ($property->formattedArea())
                        <div class="rounded-xl bg-gray-50 p-3 sm:p-4">
                            <p class="text-[11px] text-gray-500 sm:text-xs">พื้นที่</p>
                            <p class="mt-1 text-sm font-semibold text-gray-900 sm:text-base">{{ $property->formattedArea() }}</p>
                        </div>
                        @endif
                        @if ($property->bedroom)
                        <div class="rounded-xl bg-gray-50 p-3 sm:p-4">
                            <p class="text-[11px] text-gray-500 sm:text-xs">ห้องนอน</p>
                            <p class="mt-1 text-sm font-semibold text-gray-900 sm:text-base">{{ $property->bedroom }} ห้อง</p>
                        </div>
                        @endif
                        @if ($property->bathroom)
                        <div class="rounded-xl bg-gray-50 p-3 sm:p-4">
                            <p class="text-[11px] text-gray-500 sm:text-xs">ห้องน้ำ</p>
                            <p class="mt-1 text-sm font-semibold text-gray-900 sm:text-base">{{ $property->bathroom }} ห้อง</p>
                        </div>
                        @endif
                        @if ($property->pricePerWah)
                        <div class="rounded-xl bg-gray-50 p-3 sm:p-4">
                            <p class="text-[11px] text-gray-500 sm:text-xs mb-0">ราคาต่อ ตรว.</p>
                            <p class="mt-0 text-sm font-semibold text-red-700 sm:text-base">{{ number_format($property->pricePerWah) }} บาท</p>
                        </div>
                        @endif

                    </div>

                    @if ($property->formattedAddress())
                    <div class="mt-3 rounded-xl border border-blue-100 bg-blue-50/50 p-3 sm:p-4">
                        <p class="text-xs font-semibold text-blue-900 sm:text-sm">ที่ตั้ง</p>
                        <p class="mt-1 text-sm text-gray-700 sm:text-base">{{ $property->formattedAddress() }}</p>
                    </div>
                    @endif

                    <div class="mt-6 border-t border-gray-100 pt-6">
                        <h2 class="text-xs font-semibold text-gray-500 sm:text-sm">รหัสทรัพย์ #{{ $property->code }}</h2>
                        <h2 class="heading-font text-base font-bold text-blue-900 sm:text-lg">รายละเอียดเพิ่มเติม</h2>
                        @if ($property->description)
                        <div class="prose prose-sm md:prose-base prose-blue mt-3 max-w-none min-w-0 break-words text-sm text-gray-700 md:text-base [&_a]:break-all [&_a]:whitespace-normal [&_a]:text-blue-700 [&_a]:underline [&_h1]:text-lg [&_h2]:text-base [&_h3]:text-sm md:[&_h1]:text-xl md:[&_h2]:text-lg md:[&_h3]:text-base [&_img]:my-3 [&_img]:max-w-full [&_img]:rounded-lg [&_li]:text-sm md:[&_li]:text-base [&_p]:text-sm md:[&_p]:text-base">
                            {!! $property->renderedDescription() !!}
                        </div>
                        @else
                        <p class="mt-3 leading-relaxed text-gray-700">-</p>
                        @endif
                    </div>


                </div>
            </div>

            {{-- Right 30% --}}
            <div class="w-full lg:w-[30%] lg:shrink-0">
                <x-property-agent-sidebar :user="$user" :property="$property" />
            </div>
        </div>
    </div>
</div>
@endsection
