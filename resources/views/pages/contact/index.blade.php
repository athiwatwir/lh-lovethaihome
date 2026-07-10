@extends('layouts.home')

@section('content')
@php
$officeAddress = '257/6-7 ซอยลาดพร้าว 101 ถนนลาดพร้าว แขวงคลองเจ้าคุณสิงห์ เขตวังทองหลาง กรุงเทพมหานคร 10310';
$mapsQuery = urlencode($officeAddress);
$mapsEmbedUrl = 'https://maps.google.com/maps?q='.$mapsQuery.'&hl=th&z=16&output=embed';
$mapsDirectionsUrl = 'https://www.google.com/maps/dir/?api=1&destination='.$mapsQuery;
$contacts = [
    [
        'name' => 'คุณจุ๋ม',
        'role' => 'ที่ปรึกษาอสังหาฯ',
        'phone' => '081-442-1251',
        'tel' => '0814421251',
    ],
    [
        'name' => 'คุณชาญวิทย์',
        'role' => 'ที่ปรึกษาอสังหาฯ',
        'phone' => '081-565-2025',
        'tel' => '0815652025',
    ],
];
$channels = [
    [
        'label' => 'LINE Official',
        'value' => '@era101',
        'href' => 'https://line.me/R/ti/p/@era101',
        'class' => 'bg-[#06C755] hover:bg-[#05b34c]',
        'icon' => '<path fill="currentColor" d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314" />',
    ],
    [
        'label' => 'Messenger',
        'value' => 'ทักแชทปรึกษาฟรี',
        'href' => 'https://m.me/lovethaihome1',
        'class' => 'bg-[#0084FF] hover:bg-[#0073e6]',
        'icon' => '<path fill="currentColor" d="M12 2C6.36 2 2 6.13 2 11.7c0 2.91 1.19 5.44 3.14 7.17V22l2.87-1.58c1.22.34 2.52.52 3.99.52 5.64 0 10-4.13 10-9.7S17.64 2 12 2zm.99 13.08l-2.55-2.72-4.98 2.72 5.48-5.82 2.61 2.72 4.92-2.72-5.48 5.82z" />',
    ],
    [
        'label' => 'Facebook',
        'value' => 'ศูนย์รับฝาก',
        'href' => 'https://www.facebook.com/Lovethaihomeera',
        'class' => 'bg-[#1877F2] hover:bg-[#166FE5]',
        'icon' => '<path fill="currentColor" d="M9.101 23.691v-9.98H6.162V11.05h2.939V8.86c0-2.906 1.775-4.49 4.37-4.49 1.242 0 2.303.092 2.615.134v3.03l-1.794.001c-1.406 0-1.677.668-1.677 1.648v2.168h3.35l-.437 3.66h-2.913v9.98H9.101z" />',
    ],
];
@endphp

<div class="bg-gray-50 antialiased">
    <section class="relative overflow-hidden border-b border-blue-100 bg-linear-to-r from-blue-900 via-blue-800 to-indigo-800 text-white">
        <img src="{{ asset('images/cover/house.webp') }}" alt="ติดต่อ Love Thai Home" class="absolute inset-0 h-full w-full object-cover opacity-20">
        <div class="absolute inset-0 bg-linear-to-r from-blue-950/85 via-blue-900/80 to-indigo-900/75"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <nav class="mb-4 text-sm text-blue-100">
                <a href="{{ route('home') }}" class="hover:text-white">หน้าหลัก</a>
                <span class="mx-2">/</span>
                <span class="text-white">ติดต่อเรา</span>
            </nav>

            <div class="grid items-end gap-8 lg:grid-cols-[1.2fr_0.8fr]">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wide text-blue-200">Love Thai Home · ERA</p>
                    <h1 class="heading-font mt-2 text-3xl font-bold md:text-4xl">ติดต่อเรา</h1>
                    <p class="mt-3 max-w-2xl text-blue-100">
                        พร้อมให้คำปรึกษาเรื่องซื้อ-ขาย ฝากขายบ้าน ที่ดิน และอสังหาฯ ในกรุงเทพฯ และปริมณฑล
                        โดยทีมงานมืออาชีพจากเครือข่าย ERA
                    </p>
                </div>

                <div class="rounded-2xl border border-white/20 bg-white/10 p-5 backdrop-blur-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-100">สำนักงาน</p>
                    <p class="mt-2 text-sm leading-relaxed text-white">
                        <strong>บริษัท เบสท์แลนด์ แอนด์ เฮ้าส์ซิ่ง จำกัด</strong><br>
                        {{ $officeAddress }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            @foreach ($channels as $channel)
            <a
                href="{{ $channel['href'] }}"
                target="_blank"
                rel="noopener noreferrer"
                class="group flex items-center gap-4 rounded-2xl border border-gray-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md"
            >
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full text-white shadow-md transition group-hover:scale-105 {{ $channel['class'] }}">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" aria-hidden="true">{!! $channel['icon'] !!}</svg>
                </span>
                <span>
                    <span class="block text-xs font-semibold uppercase tracking-wide text-gray-500">{{ $channel['label'] }}</span>
                    <span class="mt-0.5 block text-base font-bold text-gray-900">{{ $channel['value'] }}</span>
                </span>
            </a>
            @endforeach
        </div>

        <div class="mt-8 grid grid-cols-1 items-start gap-6 lg:grid-cols-2 lg:gap-8">
            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-5 py-4 sm:px-6">
                    <h2 class="heading-font text-lg font-bold text-blue-900 sm:text-xl">แผนที่สำนักงาน</h2>
                    <p class="mt-1 text-sm text-gray-500">ซอยลาดพร้าว 101 · เขตวังทองหลาง</p>
                </div>

                <div class="relative aspect-[16/11] w-full bg-gray-100">
                    <iframe
                        class="absolute inset-0 h-full w-full border-0"
                        src="{{ $mapsEmbedUrl }}"
                        title="แผนที่สำนักงาน Love Thai Home"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen></iframe>
                </div>

                <div class="flex flex-wrap gap-3 p-5 sm:p-6">
                    <a
                        href="{{ $mapsDirectionsUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-800 sm:flex-none"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        เปิดเส้นทางใน Google Maps
                    </a>
                    <a
                        href="https://maps.google.com/?q={{ $mapsQuery }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex flex-1 items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm font-semibold text-gray-700 transition hover:border-blue-300 hover:text-blue-700 sm:flex-none"
                    >
                        ดูบนแผนที่
                    </a>
                </div>
            </section>

            <section class="space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                    <h2 class="heading-font text-lg font-bold text-blue-900 sm:text-xl">เบอร์โทรติดต่อ</h2>
                    <p class="mt-1 text-sm text-gray-500">โทรหรือนัดหมายล่วงหน้าได้ทุกวันทำการ</p>

                    <div class="mt-5 space-y-3">
                        @foreach ($contacts as $contact)
                        <a
                            href="tel:{{ $contact['tel'] }}"
                            class="flex items-center justify-between gap-4 rounded-xl border border-blue-100 bg-blue-50/70 px-4 py-4 transition hover:border-blue-200 hover:bg-blue-50"
                        >
                            <span class="min-w-0">
                                <span class="block text-sm font-bold text-blue-900">{{ $contact['name'] }}</span>
                                <span class="block text-xs text-gray-500">{{ $contact['role'] }}</span>
                            </span>
                            <span class="shrink-0 text-base font-bold text-blue-700 heading-font">{{ $contact['phone'] }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                    <h2 class="heading-font text-lg font-bold text-blue-900 sm:text-xl">ติดตามเรา</h2>
                    <p class="mt-1 text-sm text-gray-500">รับข่าวสารอสังหาฯ และทรัพย์แนะนำผ่านโซเชียล</p>
                    <div class="mt-5">
                        <x-social-follow-links />
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <a
                        href="{{ route('property-requests.index') }}"
                        class="rounded-2xl border border-blue-200 bg-linear-to-br from-blue-700 to-blue-800 p-5 text-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"
                    >
                        <p class="text-xs font-semibold uppercase tracking-wide text-blue-100">บริการ</p>
                        <p class="heading-font mt-1 text-lg font-bold">รับฝากขายบ้าน-ที่ดิน</p>
                        <p class="mt-2 text-sm text-blue-100">ปรึกษาฟรี ไม่มีค่าใช้จ่าย</p>
                    </a>
                    <a
                        href="{{ route('careers.index') }}"
                        class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md"
                    >
                        <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">ร่วมงานกับเรา</p>
                        <p class="heading-font mt-1 text-lg font-bold text-blue-900">รับสมัครงาน</p>
                        <p class="mt-2 text-sm text-gray-500">อบรมฟรี · คอมมิชชั่น · โบนัส</p>
                    </a>
                </div>
            </section>
        </div>
    </main>
</div>
@endsection
