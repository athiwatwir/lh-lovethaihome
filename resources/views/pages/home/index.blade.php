@extends('layouts.home')

@section('content')

<div class="antialiased">
    <div class="relative overflow-x-hidden bg-gray-100 py-6 pb-8 sm:py-8 lg:min-h-[600px] lg:py-10">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Luxury Home">
            <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/80 to-transparent"></div>
        </div>

        <div class="relative mx-auto flex max-w-7xl px-4 sm:px-6 lg:min-h-[580px] lg:items-center lg:px-8">
            <div class="max-w-2xl lg:pt-4">
                <h1 class="text-3xl lg:text-5xl font-extrabold text-blue-700 leading-tight mb-4">
                    รับฝากขายบ้าน-ที่ดิน-คอนโด<br>
                    <span class="text-3xl lg:text-4xl text-gray-800">และอสังหาริมทรัพย์ทุกประเภท</span><br>
                    <span class="inline-block bg-blue-700 text-white px-4 py-3 mt-2 rounded-sm text-sm lg:text-2xl">ในเขตกรุงเทพฯ และปริมณฑล</span>
                </h1>
                <p class="mt-4 text-gray-700 text-sm lg:text-base leading-relaxed max-w-lg">
                    บริษัท เบสท์แลนด์ แอนด์ เฮ้าส์ซิ่ง รับฝากขายบ้าน-ที่ดิน-คอนโด และอสังหาริมทรัพย์ทุกประเภท ในเขตกรุงเทพฯ และปริมณฑล ภายใต้แบรนด์ ERA แฟรนไชส์ของประเทศไทย ด้วยประสบการณ์เกือบ 30 ปี
                </p>

                <div class="mt-3 hidden grid-cols-2 gap-3 sm:mt-4 sm:grid md:mt-6 md:gap-4">
                    <div class="flex items-center text-sm font-semibold text-blue-900">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg></div>
                        ทีมงานมืออาชีพ
                    </div>
                    <div class="flex items-center text-sm font-semibold text-blue-900">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg></div>
                        ทีมงานมืออาชีพ ดูแลครบวงจร
                    </div>
                    <div class="flex items-center text-sm font-semibold text-blue-900">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg></div>
                        ขายง่ายเร็ว เก็บค่าคอม 3%
                    </div>
                    <div class="flex items-center text-sm font-semibold text-blue-900">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center mr-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
                            </svg></div>
                        ประสบการณ์กว่า 30 ปี
                    </div>
                </div>

                <div class="mt-4 mb-3 max-w-xl">
                    <div class="grid grid-cols-2 gap-2 sm:gap-3">
                        <a href="#property-types" class="group relative flex min-h-[4.5rem] flex-col items-center justify-center gap-1.5 overflow-hidden rounded-xl bg-linear-to-br from-blue-600 to-blue-800 px-2 py-3 text-center text-white shadow-lg shadow-blue-600/30 transition hover:-translate-y-0.5 hover:from-blue-700 hover:to-blue-900 hover:shadow-xl sm:min-h-0 sm:flex-row sm:gap-2.5 sm:px-4 sm:py-3.5">
                            <span class="absolute inset-0 bg-white/10 opacity-0 transition group-hover:opacity-100" aria-hidden="true"></span>
                            <span class="relative flex h-9 w-9 shrink-0 animate-cta-wiggle items-center justify-center rounded-full bg-white/20 sm:h-10 sm:w-10">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <span class="relative text-[11px] font-bold leading-tight sm:text-sm">ต้องการซื้อบ้าน</span>
                        </a>

                        <a href="{{ route('property-requests.index') }}" class="group relative flex min-h-[4.5rem] flex-col items-center justify-center gap-1.5 overflow-hidden rounded-xl bg-linear-to-br from-amber-500 to-orange-600 px-2 py-3 text-center text-white shadow-lg shadow-orange-500/30 transition hover:-translate-y-0.5 hover:from-amber-600 hover:to-orange-700 hover:shadow-xl sm:min-h-0 sm:flex-row sm:gap-2.5 sm:px-4 sm:py-3.5">
                            <span class="absolute inset-0 bg-white/10 opacity-0 transition group-hover:opacity-100" aria-hidden="true"></span>
                            <span class="relative flex h-9 w-9 shrink-0 animate-cta-wiggle items-center justify-center rounded-full bg-white/20 sm:h-10 sm:w-10" style="animation-delay: 0.35s;">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </span>
                            <span class="relative text-[11px] font-bold leading-tight sm:text-sm">ต้องการฝากขายบ้าน</span>
                        </a>
                    </div>
                    <a href="https://m.me/lovethaihome1" target="_blank" rel="noopener noreferrer" class="group mt-3 flex items-center justify-center gap-3 rounded-xl border border-blue-100/80 bg-white/70 px-3 py-2.5 shadow-sm backdrop-blur-sm transition hover:-translate-y-0.5 hover:border-[#0084FF]/40 hover:bg-white hover:shadow-md sm:justify-start" aria-label="ทักแชท Facebook Messenger ปรึกษาฟรี">
                        <span class="relative flex h-10 w-10 shrink-0 items-center justify-center">
                            <span class="absolute inset-0 rounded-full bg-[#0084FF]/25 animate-messenger-glow" aria-hidden="true"></span>
                            <span class="relative flex h-10 w-10 animate-cta-wiggle items-center justify-center rounded-full bg-[#0084FF] text-white shadow-md shadow-[#0084FF]/30 ring-2 ring-[#0084FF]/20 transition group-hover:bg-[#0078e7] group-hover:shadow-lg">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M12 0C5.373 0 0 4.975 0 11.111c0 3.497 1.745 6.616 4.472 8.652V24l4.088-2.242c1.09.3 2.246.464 3.44.464 6.627 0 12-4.974 12-11.111C24 4.975 18.627 0 12 0zm1.191 14.963-3.055-3.26-5.963 3.26L10.732 8.1l3.13 3.26L19.742 8.1l-6.551 6.863z" />
                                </svg>
                            </span>
                        </span>
                        <p class="min-w-0 flex-1 text-left text-sm leading-snug text-gray-700">
                            <span class="font-bold text-blue-800">ปรึกษาฟรี!</span>
                            <span class="text-gray-600"> ไม่มีค่าใช้จ่าย · ทุกเรื่องอสังหาฯ ยินดีให้คำแนะนำ</span>
                        </p>
                        <span class="hidden shrink-0 items-center gap-1 rounded-full bg-[#0084FF]/10 px-2.5 py-1 text-xs font-semibold text-[#0084FF] transition group-hover:bg-[#0084FF] group-hover:text-white sm:inline-flex">
                            ทักแชท
                            <svg class="h-3.5 w-3.5 transition group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 mt-2 md:-mt-16 mb-16" x-data="{
        tab: 'property',
        sellers: @js($sellers ?? []),
        agentQuery: '',
        selectedSellerId: '',
        showSuggestions: false,
        get filteredSellers() {
            const query = this.agentQuery.trim().toLowerCase();
            if (!query) {
                return this.sellers.slice(0, 50);
            }

            return this.sellers
                .filter((seller) => seller.name.toLowerCase().includes(query))
                .slice(0, 50);
        },
        selectSeller(seller) {
            this.agentQuery = seller.name;
            this.selectedSellerId = seller.id;
            this.showSuggestions = false;
        },
        clearSelectionOnType() {
            this.selectedSellerId = '';
            this.showSuggestions = true;
        },
    }">
        <div class="bg-white rounded-xl md:rounded-2xl shadow-xl p-3 md:p-6 border border-gray-100">

            <div class="flex space-x-3 md:space-x-6 border-b border-gray-200 mb-6">
                <button @click="tab = 'property'" :class="{ 'text-blue-700 border-blue-700 border-b-2 ': tab === 'property', 'text-gray-500 hover:text-blue-600': tab !== 'property' }" class="pb-3 flex items-center heading-font text-sm md:text-lg transition-colors">
                    <svg class="w-6 h-6 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    ค้นหาทรัพย์สิน
                </button>
                <button @click="tab = 'agent'" :class="{ 'text-blue-700 border-blue-700 border-b-2 ': tab === 'agent', 'text-gray-500 hover:text-blue-600': tab !== 'agent' }" class="pb-3 flex items-center heading-font text-sm md:text-lg transition-colors">
                    <svg class="w-6 h-6 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    ค้นหาตัวแทนขาย
                </button>
            </div>

            <div x-show="tab === 'property'" x-transition>
                <x-property-search-form :propertyTypes="$propertyTypes" />
            </div>

            <div x-show="tab === 'agent'" x-transition style="display: none;" class="space-y-4">
                <form method="GET" action="{{ route('properties.index') }}" class="flex flex-col gap-4 md:flex-row">
                    <input type="hidden" name="user_id" :value="selectedSellerId">
                    <input type="hidden" name="zone_id" value="all">

                    <div class="relative w-full" @click.outside="showSuggestions = false">
                        <input type="text" x-model="agentQuery" @focus="showSuggestions = true" @input="clearSelectionOnType()" class="block w-full rounded-md border border-gray-300 bg-gray-50 p-3 pl-4 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" placeholder="พิมพ์ชื่อตัวแทนขาย" autocomplete="off">

                        <div x-show="showSuggestions" x-cloak class="absolute z-20 mt-1 max-h-64 w-full overflow-auto rounded-xl border border-gray-200 bg-white shadow-lg">
                            <template x-if="filteredSellers.length === 0">
                                <p class="px-4 py-3 text-sm text-gray-500">ไม่พบรายชื่อตัวแทน</p>
                            </template>

                            <template x-for="seller in filteredSellers" :key="seller.id">
                                <button type="button" @click="selectSeller(seller)" class="w-full border-b border-gray-100 px-4 py-3 text-left text-sm text-gray-700 transition last:border-b-0 hover:bg-blue-50 hover:text-blue-700">
                                    <span x-text="seller.name"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <button type="submit" :disabled="!selectedSellerId" class="w-full whitespace-nowrap rounded-lg bg-blue-800 px-8 py-3 font-medium text-white shadow transition hover:bg-blue-900 disabled:cursor-not-allowed disabled:bg-gray-400 md:w-auto md:shrink-0">
                        ค้นหา
                    </button>
                </form>

                <div class="flex items-center gap-3">
                    <div class="h-px flex-1 bg-gray-200"></div>
                    <span class="text-xs font-medium text-gray-400">หรือ</span>
                    <div class="h-px flex-1 bg-gray-200"></div>
                </div>

                <a href="{{ route('sellers.index') }}" class="group flex w-full items-center justify-between gap-3 rounded-xl border-2 border-blue-200 bg-linear-to-r from-blue-50 to-indigo-50 px-4 py-3.5 shadow-sm transition hover:border-blue-400 hover:from-blue-100 hover:to-indigo-100 md:px-5">
                    <span class="flex min-w-0 items-center gap-3">
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-700 text-white shadow-sm transition group-hover:bg-blue-800">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                        <span class="min-w-0 text-left">
                            <span class="block text-sm font-semibold text-blue-900 md:text-base">ดูตัวแทนขายทั้งหมด</span>
                            <span class="block truncate text-xs text-blue-700/80">โปรไฟล์ ติดต่อ และทรัพย์ของแต่ละคน</span>
                        </span>
                    </span>
                    <svg class="h-5 w-5 shrink-0 text-blue-700 transition group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>
    </div>

    <div id="property-types" class="max-w-7xl mx-auto scroll-mt-24 px-4 sm:px-6 lg:px-8 mb-6">
        <h2 class="text-xl md:text-2xl font-bold text-center text-blue-800 mb-4">ประเภทอสังหาฯ</h2>
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-4">
            @forelse ($propertyTypes as $type)
            <a href="{{ route('properties.index', ['asset_type_id' => $type->id]) }}" class="group flex flex-col items-center">
                <div class="w-full aspect-square overflow-hidden rounded-xl border border-gray-200 mb-3 shadow-sm group-hover:shadow-md transition">
                    <x-lazy-image :src="$type->imageUrl ?? asset('images/cover/house.webp')" :alt="$type->name" class="h-full w-full object-cover transition duration-500 group-hover:scale-110" />
                </div>
                <h3 class="text-blue-800 font-semibold text-sm text-center">{{ $type->name }}</h3>
            </a>
            @empty
            <a href="#" class="group flex flex-col items-center">
                <div class="w-full aspect-square overflow-hidden rounded-xl border border-gray-200 mb-3 shadow-sm group-hover:shadow-md transition">
                    <img src="{{ asset('images/cover/house.webp') }}" alt="บ้านเดี่ยว/บ้านแฝด" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-blue-800 font-semibold text-sm text-center">บ้านเดี่ยว/บ้านแฝด</h3>
            </a>
            @endforelse
        </div>
    </div>

    <div class="bg-blue-50/50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 items-start gap-8 lg:grid-cols-2 lg:gap-10">
                <div class="flex w-full items-center justify-center lg:sticky lg:top-24">
                    <x-consignment-benefits-video class="max-w-3xl" />
                </div>

                <x-consignment-benefits-list />
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <a href="{{ route('articles.category', config('lovethaihome_articles.knowledge_category_id')) }}" class="group relative block overflow-hidden">
                    <x-lazy-image :src="asset('images/cover/lovethaihome-cover-knowledge.webp')" alt="ความรู้ด้านอสังหาริมทรัพย์" :eager="true" class="w-full object-cover transition duration-300 group-hover:scale-105" />
                    <span class="pointer-events-none absolute inset-0 flex items-center justify-center" aria-hidden="true">
                        <span class="flex h-12 w-12 items-center justify-center rounded-full border border-white/80 bg-black/15 text-white shadow-sm backdrop-blur-[2px] transition duration-300 group-hover:scale-110 group-hover:bg-black/25 sm:h-14 sm:w-14">
                            <svg class="ml-0.5 h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" stroke-width="1.25" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 5.5v13l11-6.5z" />
                            </svg>
                        </span>
                    </span>
                </a>
            </div>
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="relative aspect-video w-full bg-black">
                    <iframe
                        class="absolute inset-0 h-full w-full border-0"
                        src="https://www.youtube.com/embed/jBHaD0A9RvE"
                        title="วิดีโอ Love Thai Home"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen
                        loading="lazy"></iframe>
                </div>
            </div>
            <div class="flex h-full flex-col justify-center gap-5 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                <div class="text-center">
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">ติดตามเรา</p>
                    <h3 class="mt-1 text-lg font-bold leading-snug text-blue-900 sm:text-xl">รับข่าวสารผ่านโซเชียลมีเดีย</h3>
                </div>
                <x-social-follow-links />
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm">
                <div class="w-16 h-16 flex-shrink-0 flex items-center justify-center mr-4">
                    <img src="{{ asset('images/treasury.png') }}" alt="Appraisal" class="w-16 h-16">
                </div>
                <div>
                    <h4 class="font-bold text-blue-900">ค้นหาราคาประเมิน<br>(กรมธนารักษ์)</h4>
                    <a href="https://assessprice.treasury.go.th/" target="_blank" class="mt-2 bg-blue-600 text-white text-xs px-4 py-1.5 rounded hover:bg-blue-700">เข้าสู่เว็บไซต์</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm">
                <div class="w-16 h-16 flex-shrink-0 flex items-center justify-center mr-4">
                    <img src="{{ asset('images/lands-map.webp') }}" alt="LandsMaps" class="w-16 h-16">
                </div>
                <div>
                    <h4 class="font-bold text-blue-900">ค้นหาตำแหน่งแปลงที่ดิน<br>(LandsMaps)</h4>
                    <a href="https://landsmaps.dol.go.th/" target="_blank" class="mt-2 bg-blue-600 text-white text-xs px-4 py-1.5 rounded hover:bg-blue-700">เข้าสู่เว็บไซต์</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm">
                <div class="w-16 h-16 flex-shrink-0 flex items-center justify-center mr-4">
                    <img src="{{ asset('images/dol.webp') }}" alt="DOL" class="w-16 h-16">
                </div>
                <div>
                    <h4 class="font-bold text-blue-900">กรมที่ดิน (DOL)</h4>
                    <a href="https://www.dol.go.th/" target="_blank" class="mt-2 bg-blue-600 text-white text-xs px-4 py-1.5 rounded hover:bg-blue-700">เข้าสู่เว็บไซต์</a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
        <h3 class="text-2xl font-bold text-center text-blue-800 mb-4">ดาวน์โหลดเอกสารสำคัญ</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm justify-between">
                <div class="flex items-center">
                    <img src="https://placehold.co/40x50/white/ef4444?text=PDF" alt="PDF" class="w-10 mr-4">
                    <h4 class="font-bold text-blue-900 text-sm">สัญญาแต่งตั้งตัวแทนขาย</h4>
                </div>
                <a href="{{ asset('files/sales-agency-agreement.pdf') }}" download class="shrink-0 bg-blue-600 text-white text-xs px-4 py-2 rounded hover:bg-blue-700">
                    ดาวน์โหลด
                </a>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm justify-between">
                <div class="flex items-center">
                    <img src="https://placehold.co/40x50/white/ef4444?text=PDF" alt="PDF" class="w-10 mr-4">
                    <h4 class="font-bold text-blue-900 text-sm">สัญญาจะซื้อจะขาย</h4>
                </div>
                <a href="{{ asset('files/agreement.pdf') }}" download class="shrink-0 bg-blue-600 text-white text-xs px-4 py-2 rounded hover:bg-blue-700">
                    ดาวน์โหลด
                </a>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-200 flex items-center shadow-sm justify-between">
                <div class="flex items-center">
                    <img src="https://placehold.co/50x50/transparent/ef4444?text=Map" alt="Map" class="w-10 mr-4">
                    <h4 class="font-bold text-blue-900 text-sm">ที่ตั้งของบริษัท</h4>
                </div>
                <button class="shrink-0 bg-blue-600 text-white text-xs px-4 py-2 rounded hover:bg-blue-700">ดูแผนที่</button>
            </div>
        </div>
    </div>


</div>

@endsection
