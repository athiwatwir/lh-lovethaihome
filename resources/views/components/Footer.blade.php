@php
$mobileNavItems = [
[
'label' => 'หน้าหลัก',
'short' => 'หน้าหลัก',
'href' => route('home'),
'active' => request()->routeIs('home'),
'icon' => '
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />',
],
[
'label' => 'รับฝากขายบ้าน-ที่ดิน',
'short' => 'ฝากขาย',
'href' => '#',
'active' => false,
'icon' => '
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />',
],
[
'label' => 'แผนบริการ',
'short' => 'แผนบริการ',
'href' => '#',
'active' => false,
'icon' => '
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />',
],
[
'label' => 'รับสมัครงาน',
'short' => 'สมัครงาน',
'href' => '#',
'active' => false,
'icon' => '
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />',
],
[
'label' => 'ติดต่อเรา',
'short' => 'ติดต่อ',
'href' => '#',
'active' => false,
'icon' => '
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />',
],
];
@endphp

{{-- Mobile bottom navigation --}}
<nav class="fixed inset-x-0 bottom-0 z-50 border-t border-gray-200 bg-white/95 backdrop-blur-md shadow-[0_-4px_24px_rgba(15,23,42,0.08)] md:hidden pb-[env(safe-area-inset-bottom)]" aria-label="เมนูหลัก">
    <div class="grid grid-cols-5 gap-0 px-1 pt-1.5 pb-2">
        @foreach ($mobileNavItems as $item)
        <a href="{{ $item['href'] }}" @class([ 'heading-font flex min-w-0 flex-col items-center justify-center gap-0.5 rounded-lg px-0.5 py-1 transition-colors' , 'text-blue-700'=> $item['active'],
            'text-gray-500 hover:text-blue-600' => ! $item['active'],
            ])
            @if ($item['active']) aria-current="page" @endif
            title="{{ $item['label'] }}">
            <span @class([ 'flex h-9 w-9 items-center justify-center rounded-full transition-colors' , 'bg-blue-50 ring-1 ring-blue-100'=> $item['active'],
                ])>
                <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    {!! $item['icon'] !!}
                </svg>
            </span>
            <span @class([ 'max-w-full truncate text-center text-[10px] font-medium leading-tight' , 'font-semibold'=> $item['active'],
                ])>{{ $item['short'] }}</span>
        </a>
        @endforeach
    </div>
</nav>

<footer class="border-t border-gray-200 bg-gray-50 pt-12 pb-10 md:pb-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
            <div class="text-center md:text-left">
                <img class="mx-auto mb-4 h-12 w-auto md:mx-0" src="{{ asset('images/logo/logo.png') }}" alt="ERA">
                <p class="text-sm leading-relaxed text-gray-600">
                    <strong>บริษัท เบสท์แลนด์ แอนด์ เฮ้าส์ซิ่ง จำกัด</strong><br>
                    257/6-7 ซอยลาดพร้าว 101 ถนนลาดพร้าว<br>
                    แขวงคลองเจ้าคุณสิงห์ เขตวังทองหลาง กรุงเทพมหานคร<br>
                    10310
                </p>
            </div>

            <div class="hidden md:block">
                <h4 class="mb-4 font-bold text-blue-900">เมนูหลัก</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><a href="#" class="hover:text-blue-600">รับฝากขายบ้าน-ที่ดิน</a></li>
                    <li><a href="#" class="hover:text-blue-600">แผนบริการ</a></li>
                    <li><a href="#" class="hover:text-blue-600">รับสมัครงาน</a></li>
                    <li><a href="#" class="hover:text-blue-600">ติดต่อเรา</a></li>
                </ul>
            </div>

            <div class="hidden md:block">
                <h4 class="mb-4 font-bold text-blue-900">ประเภทอสังหาฯ</h4>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><a href="#" class="hover:text-blue-600">บ้านเดี่ยว/บ้านแฝด</a></li>
                    <li><a href="#" class="hover:text-blue-600">ทาวน์เฮ้าส์/ทาวน์โฮม</a></li>
                    <li><a href="#" class="hover:text-blue-600">คอนโดมิเนียม</a></li>
                    <li><a href="#" class="hover:text-blue-600">ตึกแถว/อาคารพาณิชย์</a></li>
                    <li><a href="#" class="hover:text-blue-600">ที่ดินเปล่า</a></li>
                    <li><a href="#" class="hover:text-blue-600">โกดัง/โรงงาน</a></li>
                    <li><a href="#" class="hover:text-blue-600">อพาร์ทเมนต์/หอพัก/อื่นๆ</a></li>
                </ul>
            </div>

            <div class="hidden md:block">
                <h4 class="mb-4 font-bold text-blue-900">ติดตามเรา</h4>
                <div class="mb-6 flex space-x-2">
                    <div class="h-8 w-8 rounded-full bg-green-500"></div>
                    <div class="h-8 w-8 rounded-full bg-blue-600"></div>
                    <div class="h-8 w-8 rounded-full bg-linear-to-tr from-blue-500 to-pink-500"></div>
                    <div class="h-8 w-8 rounded-full bg-red-600"></div>
                    <div class="h-8 w-8 rounded-full bg-black"></div>
                </div>

                <div class="rounded-xl border border-blue-100 bg-blue-50 p-4 text-center">
                    <p class="mb-1 text-xs text-gray-600">ผู้เข้าชมเว็บไซต์กว่า</p>
                    <p class="text-2xl font-bold text-blue-700">700,000+</p>
                    <p class="mt-1 text-xs text-gray-600">คนต่อเดือน</p>
                </div>
            </div>
        </div>
    </div>
</footer>
