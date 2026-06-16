@extends('layouts.home')

@section('content')
@php
    $gallery = $property->galleryImages();
@endphp

<div class="bg-gray-50 antialiased" x-data="{ activeImage: @js($gallery[0]) }">
    <section class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-blue-700">หน้าหลัก</a>
                <span class="mx-2">/</span>
                <a href="{{ route('properties.index', ['asset_type_id' => $property->assetType['id'] ?? null]) }}" class="hover:text-blue-700">รายการทรัพย์</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">#{{ $property->code }}</span>
            </nav>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-8 lg:flex-row">
            {{-- Left 70% --}}
            <div class="w-full lg:w-[70%] lg:shrink-0">
                {{-- Gallery --}}
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="aspect-[16/10] bg-gray-100">
                        <img :src="activeImage" alt="{{ $property->name }}" class="h-full w-full object-cover">
                    </div>
                    @if (count($gallery) > 1)
                        <div class="flex gap-2 overflow-x-auto p-3">
                            @foreach ($gallery as $image)
                                <button
                                    type="button"
                                    @click="activeImage = @js($image)"
                                    :class="activeImage === @js($image) ? 'ring-2 ring-blue-600' : 'ring-1 ring-gray-200'"
                                    class="h-20 w-28 shrink-0 overflow-hidden rounded-lg">
                                    <img src="{{ $image }}" alt="" class="h-full w-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Main info --}}
                <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            @if ($property->code !== '')
                                <span class="text-sm font-semibold text-gray-500">รหัสทรัพย์ #{{ $property->code }}</span>
                            @endif
                            <h1 class="heading-font mt-1 text-2xl font-bold leading-snug text-gray-900 md:text-3xl">
                                {{ $property->name }}
                            </h1>
                        </div>
                        <p class="text-3xl font-bold text-blue-700">{{ $property->formattedPrice() }}</p>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        @if ($property->isRecommend)
                            <span class="rounded-full bg-amber-500 px-3 py-1 text-xs font-semibold text-white">แนะนำ</span>
                        @endif
                        @foreach ($property->listingLabels() as $label)
                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">{{ $label }}</span>
                        @endforeach
                        @if ($property->assetType)
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">{{ $property->assetType['name'] }}</span>
                        @endif
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-4">
                        @if ($property->zone)
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">โซน</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $property->zone['name'] }}</p>
                            </div>
                        @endif
                        @if ($property->formattedArea())
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">พื้นที่</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $property->formattedArea() }}</p>
                            </div>
                        @endif
                        @if ($property->bedroom)
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">ห้องนอน</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $property->bedroom }} ห้อง</p>
                            </div>
                        @endif
                        @if ($property->bathroom)
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">ห้องน้ำ</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $property->bathroom }} ห้อง</p>
                            </div>
                        @endif
                        @if ($property->pricePerWah)
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">ราคาต่อตร.วา</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ number_format($property->pricePerWah) }} บาท</p>
                            </div>
                        @endif
                        @if ($property->imagesCount > 0)
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">รูปภาพ</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $property->imagesCount }} รูป</p>
                            </div>
                        @endif
                    </div>

                    @if ($property->formattedAddress())
                        <div class="mt-6 rounded-xl border border-blue-100 bg-blue-50/50 p-4">
                            <p class="text-sm font-semibold text-blue-900">ที่อยู่</p>
                            <p class="mt-1 text-gray-700">{{ $property->formattedAddress() }}</p>
                        </div>
                    @endif

                    @if ($property->description)
                        <div class="mt-6 border-t border-gray-100 pt-6">
                            <h2 class="heading-font text-lg font-bold text-blue-900">รายละเอียดเพิ่มเติม</h2>
                            <div class="prose prose-sm prose-blue mt-3 max-w-none text-gray-700 [&_a]:text-blue-700 [&_a]:underline [&_img]:my-3 [&_img]:max-w-full [&_img]:rounded-lg">
                                {!! $property->renderedDescription() !!}
                            </div>
                        </div>
                    @else
                        <div class="mt-6 border-t border-gray-100 pt-6">
                            <h2 class="heading-font text-lg font-bold text-blue-900">รายละเอียด</h2>
                            <p class="mt-3 leading-relaxed text-gray-700">{{ $property->name }}</p>
                        </div>
                    @endif
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
