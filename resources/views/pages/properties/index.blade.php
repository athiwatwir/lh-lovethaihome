@extends('layouts.home')

@section('content')
<div class="bg-gray-50 antialiased">
    {{-- Header --}}
    <section class="border-b border-blue-100 bg-linear-to-r from-blue-800 to-blue-600 text-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <nav class="mb-4 text-sm text-blue-100">
                <a href="{{ route('home') }}" class="hover:text-white">หน้าหลัก</a>
                <span class="mx-2">/</span>
                <span class="text-white">รายการทรัพย์สิน</span>
            </nav>

            <h1 class="heading-font text-2xl font-bold md:text-3xl">
                @if ($currentUser)
                    ทรัพย์ของ {{ $currentUser->fullName() }}
                @elseif ($currentType)
                    {{ $currentType->name }}
                @else
                    รายการทรัพย์สินทั้งหมด
                @endif
            </h1>

            @if ($paginator)
                <p class="mt-2 text-blue-100">
                    พบ {{ number_format($totalCount) }} รายการ
                    @if ($paginator->currentPage() > 1)
                        — หน้า {{ $paginator->currentPage() }} จาก {{ $paginator->lastPage() }}
                    @endif
                </p>
            @endif
        </div>
    </section>

  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @php
            $listQuery = array_filter(['user_id' => $currentUser?->id]);
        @endphp

        {{-- Filter chips: property types --}}
        @if ($propertyTypes->isNotEmpty())
            <div class="mb-8 flex flex-wrap gap-2">
                <a
                    href="{{ route('properties.index', $listQuery) }}"
                    @class([
                        'rounded-full border px-4 py-2 text-sm font-medium transition',
                        'border-blue-700 bg-blue-700 text-white' => ! $currentType,
                        'border-gray-300 bg-white text-gray-700 hover:border-blue-400 hover:text-blue-700' => $currentType,
                    ])>
                    ทั้งหมด
                </a>
                @foreach ($propertyTypes as $type)
                    <a
                        href="{{ route('properties.index', array_merge($listQuery, ['asset_type_id' => $type->id])) }}"
                        @class([
                            'rounded-full border px-4 py-2 text-sm font-medium transition',
                            'border-blue-700 bg-blue-700 text-white' => $currentType?->id === $type->id,
                            'border-gray-300 bg-white text-gray-700 hover:border-blue-400 hover:text-blue-700' => $currentType?->id !== $type->id,
                        ])>
                        {{ $type->name }}
                    </a>
                @endforeach
            </div>
        @endif

        @if ($apiError)
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
                    <x-property-card :property="$property" />
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
