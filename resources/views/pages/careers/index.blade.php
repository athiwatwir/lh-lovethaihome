@extends('layouts.home')

@section('content')
<div class="bg-gray-50 antialiased">
    <section class="relative overflow-hidden border-b border-blue-100 bg-linear-to-r from-blue-900 via-blue-800 to-indigo-800 text-white">
        <img src="{{ asset('images/cover/house.webp') }}" alt="สมัครงาน Lovethaihome" class="absolute inset-0 h-full w-full object-cover opacity-20">
        <div class="absolute inset-0 bg-linear-to-r from-blue-950/85 via-blue-900/80 to-indigo-900/75"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <nav class="mb-4 text-sm text-blue-100">
                <a href="{{ route('home') }}" class="hover:text-white">หน้าหลัก</a>
                <span class="mx-2">/</span>
                <span class="text-white">สมัครงาน</span>
            </nav>

            <h1 class="heading-font text-3xl font-bold md:text-4xl">สมัครงาน</h1>
            <p class="mt-3 max-w-5xl text-blue-100">
                สำหรับผู้ที่สนใจจะร่วมงานกับบริษัท ERA เบสท์แลนด์ แอนด์เฮ้าส์ซิ่ง จำกัด
                ทางบริษัทต้องการผู้ที่ร่วมงานมีคุณสมบัติ ดังนี้
            </p>
        </div>
    </section>

    <main class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <article class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm md:p-8">
            <img src="{{ asset('images/logo/logo.png') }}" alt="ERA Lovethaihome" class="mx-auto mb-6 h-24 w-auto object-contain">

            <h2 class="heading-font text-xl font-bold text-blue-900">
                สำหรับผู้ที่สนใจจะร่วมงานกับบริษัท ERA เบสท์แลนด์ แอนด์เฮ้าส์ซิ่ง จำกัด ทางบริษัทต้องการผู้ที่ร่วมงานมีคุณสมบัติ ดังนี้
            </h2>

            <ul class="mt-5 space-y-3 leading-relaxed text-gray-700">
                @foreach ($qualifications as $item)
                <li class="flex items-start gap-3 rounded-lg bg-blue-50 px-3 py-2">
                    <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-600 text-white">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    <span>{{ $item }}</span>
                </li>
                @endforeach
            </ul>

            <h3 class="heading-font mt-8 text-lg font-bold text-blue-900">
                สำหรับผู้ที่ผ่านการพิจารณา ทางบริษัทจะมีการอบรมให้ก่อนเข้าทำงาน (ฟรี) รายได้ คอมมิชชั่น โบนัส จ่ายให้ทุกๆ 3 เดือน
            </h3>

            <h3 class="heading-font mt-8 text-lg font-bold text-blue-900">เอกสารที่ใช้ในการสมัครงานได้แก่</h3>
            <ul class="mt-4 space-y-2 text-gray-700">
                @foreach ($documents as $doc)
                <li class="flex items-center gap-3 rounded-lg bg-blue-50 px-3 py-2">
                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-600 text-white">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </span>
                    <span>{{ $doc }}</span>
                </li>
                @endforeach
            </ul>

            <h3 class="heading-font mt-8 text-lg font-bold text-blue-900">วิธีสมัคร</h3>
            <p class="mt-3 leading-relaxed text-gray-700">
                ให้โทรมานัดหมายล่วงหน้าเพื่อรอการสัมภาษณ์ได้ที่ เบอร์โทร : 081-565-2025 ติดต่อ คุณชาญวิทย์
                หรือ คุยทางไลน์ ID Line : 0815652025
            </p>

            <div class="mt-6 grid grid-cols-2 gap-3">
                <a href="tel:0815652025" class="inline-flex items-center justify-center rounded-xl bg-blue-700 px-6 py-3 text-center font-semibold text-white hover:bg-blue-800">
                    โทร 081-565-2025
                </a>
                <a href="https://line.me/ti/p/0815652025" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-xl bg-[#06C755] px-6 py-3 text-center font-semibold text-white hover:bg-[#05b34c]">
                    LINE 0815652025
                </a>
            </div>
        </article>
    </main>
</div>
@endsection
