{{-- Desktop: ลอยเหนือ header ชิดขวาบน (เฉพาะหน้าแรก) --}}
@if (request()->routeIs('home'))
<aside class="pointer-events-none fixed top-3 right-3 z-[60] hidden sm:top-2 sm:right-4 lg:block" aria-label="เบอร์ติดต่อ">
    <div class="pointer-events-auto rounded-xl border border-white/70 bg-white/70 px-4 py-2.5 text-right shadow-md shadow-blue-900/8 ring-1 ring-blue-100/50 backdrop-blur-md">
        <a href="tel:0815652025" class="group flex items-center justify-end gap-1 text-xl font-bold leading-tight text-red-700 transition-colors hover:text-blue-700">
            <svg class="h-5 w-5 shrink-0 transition-transform group-hover:scale-105" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
            </svg>
            <span>081-565-2025</span>
        </a>
        <span class="-mt-0.5 mb-1.5 block text-base text-gray-500">คุณชาญวิทย์</span>

        <a href="tel:0814421251" class="group flex items-center justify-end gap-1 text-xl font-bold leading-tight text-red-700 transition-colors hover:text-blue-700">
            <svg class="h-5 w-5 shrink-0 transition-transform group-hover:scale-105" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
            </svg>
            <span>081-442-1251</span>
        </a>
        <span class="-mt-0.5 block text-base text-gray-500">คุณจุ๋ม</span>
    </div>
</aside>
@endif

<header class="sticky top-0 z-50 bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center">
                <img class="h-14 w-auto" src="{{ asset('images/logo/logo.png') }}" alt="">
                <div class="heading-font ml-2 border-l-2 border-red-500 pl-2 text-md md:text-lg leading-tight text-blue-900">
                    แหล่งรับฝาก-ขายบ้าน-ที่ดิน และอสังหาฯ<br>
                    ในเขตกรุงเทพฯ และปริมณฑล
                </div>
            </a>

            <nav @class([ 'heading-font hidden space-x-8 md:flex' , 'lg:pr-44'=> request()->routeIs('home'),
                ])>
                <a href="{{ route('home') }}" @class([ 'pb-1 font-medium' , 'border-b-2 border-blue-700 text-blue-700'=> request()->routeIs('home'),
                    'text-gray-600 hover:text-blue-700' => ! request()->routeIs('home'),
                    ])
                    @if (request()->routeIs('home')) aria-current="page" @endif
                    >หน้าหลัก</a>
                <a href="{{ route('property-requests.index') }}" @class([ 'pb-1 font-medium' , 'border-b-2 border-blue-700 text-blue-700'=> request()->routeIs('property-requests.*'),
                    'text-gray-600 hover:text-blue-700' => ! request()->routeIs('property-requests.*'),
                    ])
                    @if (request()->routeIs('property-requests.*')) aria-current="page" @endif
                    >รับฝากขายบ้าน-ที่ดิน</a>
                <a href="{{ route('services.index') }}" @class([ 'pb-1 font-medium' , 'border-b-2 border-blue-700 text-blue-700'=> request()->routeIs('services.*'),
                    'text-gray-600 hover:text-blue-700' => ! request()->routeIs('services.*'),
                    ])
                    @if (request()->routeIs('services.*')) aria-current="page" @endif
                    >แผนบริการ</a>
                <a href="{{ route('careers.index') }}" @class([ 'pb-1 font-medium' , 'border-b-2 border-blue-700 text-blue-700'=> request()->routeIs('careers.*'),
                    'text-gray-600 hover:text-blue-700' => ! request()->routeIs('careers.*'),
                    ])
                    @if (request()->routeIs('careers.*')) aria-current="page" @endif
                    >รับสมัครงาน</a>
                <a href="{{ route('contact.index') }}" @class([ 'pb-1 font-medium' , 'border-b-2 border-blue-700 text-blue-700'=> request()->routeIs('contact.*'),
                    'text-gray-600 hover:text-blue-700' => ! request()->routeIs('contact.*'),
                    ])
                    @if (request()->routeIs('contact.*')) aria-current="page" @endif
                    >ติดต่อเรา</a>
            </nav>
        </div>
    </div>

    {{-- Mobile: แถวเบอร์โทรเต็มความกว้าง ต่อจาก header --}}
    @if (request()->routeIs('home'))
    <div class="w-full border-t border-gray-200 bg-gray-50/90 lg:hidden" aria-label="เบอร์ติดต่อ">
        <div class="grid grid-cols-2 divide-x divide-gray-200">
            <a href="tel:0815652025" class="flex flex-col items-center gap-0.5 px-3 py-1 text-center transition-colors hover:bg-blue-50/80">
                <span class="flex items-center gap-1 text-base font-bold text-red-700">
                    <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                    </svg>
                    081-565-2025
                </span>
                <span class="text-xs text-gray-500">คุณชาญวิทย์</span>
            </a>

            <a href="tel:0814421251" class="flex flex-col items-center gap-0.5 px-3 py-1 text-center transition-colors hover:bg-blue-50/80">
                <span class="flex items-center gap-1 text-base font-bold text-red-700">
                    <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                    </svg>
                    081-442-1251
                </span>
                <span class="text-xs text-gray-500">คุณจุ๋ม</span>
            </a>
        </div>
    </div>
    @endif
</header>
