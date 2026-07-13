@extends('layouts.home')

@php
$images = $property->masterGalleryImages();
@endphp

@push('head')
<link rel="preconnect" href="https://office.lovethaihome.com" crossorigin>
@if (! empty($images[0]))
<link rel="preload" as="image" href="{{ route('properties.showImageFile', [$property->id, 0]) }}">
@endif
@endpush

@section('content')
<div class="bg-gray-50 antialiased">
    <section class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
            <nav class="text-xs text-gray-500 md:text-sm" aria-label="breadcrumb">
                <ol class="flex flex-wrap items-center">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-blue-700">หน้าหลัก</a>
                    </li>
                    <li class="mx-2" aria-hidden="true">/</li>
                    <li>
                        <a href="{{ route('properties.show', $property->id) }}" class="hover:text-blue-700">#{{ $property->code }}</a>
                    </li>
                    <li class="mx-2" aria-hidden="true">/</li>
                    <li class="text-gray-800" aria-current="page">รูปภาพทั้งหมด</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
        <div class="mb-6 flex flex-wrap items-start justify-between gap-3">
            <div class="min-w-0">
                <p class="text-xs font-semibold text-gray-500 sm:text-sm">รหัสทรัพย์ #{{ $property->code }}</p>
                <h1 class="heading-font mt-1 text-lg font-bold text-blue-900 sm:text-2xl">รูปภาพทั้งหมด</h1>
                <p class="mt-1 line-clamp-2 text-sm text-gray-600">{{ $property->name }}</p>
                <p class="mt-2 text-xs text-gray-500">รูปถูกแปลงเป็น JPG เพื่อให้บันทึกลงเครื่องได้ทันที</p>
            </div>

            <a href="{{ route('properties.show', $property->id) }}" class="inline-flex shrink-0 items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-blue-800 shadow-sm transition hover:border-blue-300 hover:bg-blue-50">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                กลับหน้ารายละเอียด
            </a>
        </div>

        @if ($images === [])
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">
            <p class="text-lg font-medium text-gray-700">ยังไม่มีรูปภาพสำหรับทรัพย์นี้</p>
            <a href="{{ route('properties.show', $property->id) }}" class="mt-4 inline-block text-blue-700 hover:underline">กลับหน้ารายละเอียด</a>
        </div>
        @else
        <p class="mb-4 text-sm text-gray-500">ทั้งหมด {{ number_format(count($images)) }} รูป</p>

        <div class="space-y-4 md:space-y-6">
            @foreach ($images as $index => $imageUrl)
            @php
                $jpgUrl = route('properties.showImageFile', [$property->id, $index]);
                $downloadUrl = route('properties.showImageFile', [$property->id, $index, 'download' => 1]);
                $filename = ($property->code !== '' ? $property->code : $property->id).'-'.($index + 1).'.jpg';
            @endphp
            <figure class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <img
                    src="{{ $jpgUrl }}"
                    alt="{{ $property->name }} — รูปที่ {{ $index + 1 }}"
                    class="mx-auto h-auto w-full object-contain bg-gray-100"
                    loading="{{ $index < 2 ? 'eager' : 'lazy' }}"
                    decoding="async"
                    @if ($index === 0) fetchpriority="high" @endif
                >
                <figcaption class="flex items-center justify-between gap-3 border-t border-gray-100 px-4 py-2.5">
                    <span class="text-xs text-gray-500">รูปที่ {{ $index + 1 }} / {{ count($images) }} · JPG</span>
                    <a
                        href="{{ $downloadUrl }}"
                        download="{{ $filename }}"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-blue-700 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-blue-800"
                    >
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                        </svg>
                        บันทึกรูป
                    </a>
                </figcaption>
            </figure>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
