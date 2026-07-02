@extends('layouts.home')

@push('head')
<link rel="preconnect" href="https://office.lovethaihome.com" crossorigin>
@endpush

@section('content')
<div class="bg-gray-50 antialiased" x-data="{
        query: '',
        sellers: @js($sellersForView),
        get filteredSellers() {
            const q = this.query.trim().toLowerCase();
            if (! q) {
                return this.sellers;
            }

            return this.sellers.filter((seller) => {
                const haystack = [
                    seller.name,
                    seller.phone ?? '',
                    seller.email ?? '',
                    seller.lineId ?? '',
                ].join(' ').toLowerCase();

                return haystack.includes(q);
            });
        },
    }">
    <section class="border-b border-blue-100 bg-linear-to-r from-blue-800 to-blue-600 text-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <nav class="mb-4 text-sm text-blue-100">
                <a href="{{ route('home') }}" class="hover:text-white">หน้าหลัก</a>
                <span class="mx-2">/</span>
                <span class="text-white">รายชื่อตัวแทนขาย</span>
            </nav>

            <h1 class="heading-font text-2xl font-bold md:text-3xl">รายชื่อตัวแทนขาย</h1>
            <p class="mt-2 max-w-2xl text-blue-100">
                ทีมงานมืออาชีพของ ERA เบสท์แลนด์ แอนด์ เฮ้าส์ซิ่ง พร้อมให้คำปรึกษาและดูแลทรัพย์ของคุณ
            </p>

            @if (! $apiError)
            <p class="mt-3 text-sm text-blue-100">
                ทั้งหมด {{ number_format($sellers->count()) }} คน
            </p>
            @endif
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if ($apiError)
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-6 text-center text-red-700">
            {{ $apiError }}
        </div>
        @else
        <div class="mb-8">
            <label for="seller-search" class="sr-only">ค้นหาตัวแทนขาย</label>
            <div class="relative max-w-xl">
                <svg class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input id="seller-search" type="search" x-model="query" placeholder="ค้นหาชื่อ เบอร์โทร อีเมล หรือ LINE" class="w-full rounded-xl border border-gray-300 bg-white py-3 pl-10 pr-4 text-sm shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <template x-for="seller in filteredSellers" :key="seller.id">
                <article class="flex h-full flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:border-blue-200 hover:shadow-md">
                    <div class="aspect-[1/1] w-full overflow-hidden bg-gray-100">
                        <img
                            :src="'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 4 3\'%3E%3Crect fill=\'%23f3f4f6\' width=\'4\' height=\'3\'/%3E%3C/svg%3E'"
                            :data-lazy-src="seller.profileImageUrl"
                            :alt="seller.name"
                            class="h-full w-full object-cover"
                            loading="lazy"
                            decoding="async">
                    </div>
                    <div class="px-5 pt-4 pb-2 text-center">
                        <h2 class="heading-font text-lg font-bold text-gray-900" x-text="seller.name"></h2>
                    </div>

                    <div class="flex flex-1 flex-col gap-2 px-5 pb-5">
                        <template x-if="seller.phone">
                            <a :href="seller.telLink" class="flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2 text-sm font-medium text-blue-800 transition hover:bg-blue-100">
                                <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                </svg>
                                <span x-text="seller.phone"></span>
                            </a>
                        </template>

                        <template x-if="seller.lineId">
                            <div class="flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700">
                                <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#06C755] text-[10px] font-bold text-white">LINE</span>
                                <span class="truncate" x-text="seller.lineId"></span>
                            </div>
                        </template>

                        <template x-if="seller.email">
                            <a :href="'mailto:' + seller.email" class="flex items-center gap-2 truncate rounded-lg border border-gray-200 px-3 py-2 text-sm text-gray-700 transition hover:border-blue-300 hover:text-blue-700">
                                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="truncate" x-text="seller.email"></span>
                            </a>
                        </template>

                        <a :href="seller.propertiesUrl" class="mt-auto flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-800">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            ดูทรัพย์ของตัวแทน
                        </a>
                    </div>
                </article>
            </template>
        </div>

        <p x-show="filteredSellers.length === 0" x-cloak class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center text-gray-600">
            ไม่พบตัวแทนที่ค้นหา
        </p>
        @endif
    </div>
</div>
@endsection
