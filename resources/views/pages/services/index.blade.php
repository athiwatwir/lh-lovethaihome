@extends('layouts.home')

@section('content')
<div class="bg-gray-50 antialiased">
    <section class="relative overflow-hidden border-b border-blue-100 bg-linear-to-r from-blue-900 via-blue-800 to-indigo-800 text-white">
        <img
            src="{{ asset('images/cover/house.webp') }}"
            alt="แผนบริการ Lovethaihome"
            class="absolute inset-0 h-full w-full object-cover opacity-15">
        <div class="absolute inset-0 bg-linear-to-r from-blue-950/85 via-blue-900/80 to-indigo-900/75"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <nav class="mb-4 text-sm text-blue-100">
                <a href="{{ route('home') }}" class="hover:text-white">หน้าหลัก</a>
                <span class="mx-2">/</span>
                <span class="text-white">แผนบริการ</span>
            </nav>

            <h1 class="heading-font text-3xl font-bold md:text-4xl">แผนบริการในการทำงาน</h1>
            <p class="mt-3 max-w-3xl text-blue-100">
                Love Thai Home รับปรึกษาเรื่องการซื้อ-รับฝากขายบ้าน-รับฝากขายที่ดินและอสังหาฯอื่นๆ
                ในเขตกรุงเทพฯ และปริมณฑล โดยทีมงานมืออาชีพจากเครือข่าย ERA
            </p>

            <div class="mt-6 flex flex-wrap gap-3 text-sm">
                <a href="tel:0814421251" class="rounded-full bg-white/15 px-4 py-2 font-semibold text-white ring-1 ring-white/30 backdrop-blur-sm hover:bg-white/25">
                    คุณจุ๋ม 081-442-1251
                </a>
                <a href="tel:0815652025" class="rounded-full bg-white/15 px-4 py-2 font-semibold text-white ring-1 ring-white/30 backdrop-blur-sm hover:bg-white/25">
                    คุณชาญวิทย์ 081-565-2025
                </a>
                <a href="https://line.me/R/ti/p/@era101" target="_blank" rel="noopener noreferrer" class="rounded-full bg-[#06C755] px-4 py-2 font-semibold text-white hover:bg-[#05b34c]">
                    ปรึกษาผ่าน LINE @ERA101
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8 grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="rounded-2xl border border-blue-100 bg-white p-6 shadow-sm">
                <h2 class="heading-font text-2xl font-bold text-blue-900">สรุปจุดแข็งในการทำงานของเรา</h2>
                <p class="mt-3 leading-relaxed text-gray-600">
                    ทางเราสามารถช่วยแนะนำแนวทางแก้ปัญหาต่างๆ เพื่อให้จบการขาย เพราะด้วยความรู้และประสบการณ์
                    ที่ผ่านมา ผู้ขายจำนวนมากจึงเลือกฝากขายกับแบรนด์ ERA อย่างต่อเนื่อง
                </p>
                <div class="mt-5 grid grid-cols-2 gap-3 text-sm">
                    <div class="rounded-xl bg-blue-50 px-4 py-3 font-semibold text-blue-800">เครือข่าย Co-broker / Co-sales</div>
                    <div class="rounded-xl bg-blue-50 px-4 py-3 font-semibold text-blue-800">ค่าคอมมิชชั่น 3%</div>
                    <div class="rounded-xl bg-blue-50 px-4 py-3 font-semibold text-blue-800">การตลาดออนไลน์ครบช่องทาง</div>
                    <div class="rounded-xl bg-blue-50 px-4 py-3 font-semibold text-blue-800">คัดกรองผู้ซื้อก่อนชมทรัพย์</div>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <img src="{{ asset('images/logo/logo.png') }}" alt="โลโก้ Lovethaihome" class="h-56 w-full object-contain bg-white p-8">
                <div class="border-t border-gray-100 bg-gray-50 px-5 py-4 text-sm text-gray-600">
                    <p><span class="font-semibold text-gray-800">LINE:</span> @ERA101</p>
                    <p class="mt-1"><span class="font-semibold text-gray-800">โทร:</span> 081-442-1251, 081-565-2025</p>
                </div>
            </div>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            @foreach ($servicePoints as $index => $point)
                <article class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-full bg-blue-700 text-sm font-bold text-white">
                        {{ $index + 1 }}
                    </div>
                    <p class="leading-relaxed text-gray-700">{{ $point }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="pb-12">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-white p-8 text-center shadow-lg ring-1 ring-blue-100 md:p-10">
                <h2 class="heading-font text-2xl font-bold text-blue-900">ต้องการเริ่มฝากขายกับเรา?</h2>
                <p class="mx-auto mt-3 max-w-2xl text-gray-600">
                    ฝากขายบ้าน-ที่ดิน ฝากหาบ้าน-ที่ดิน แผนบริการ และคำปรึกษาเรื่องการขายแบบครบวงจร
                    สามารถเริ่มต้นได้ทันทีผ่านแบบฟอร์มฝากขาย หรือคุยกับทีมงานผ่าน LINE / โทรศัพท์
                </p>
                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('property-requests.index') }}" class="rounded-xl bg-blue-700 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-blue-800">
                        ฝากขายบ้าน-ที่ดิน
                    </a>
                    <a href="{{ route('contact.index') }}" class="rounded-xl border border-blue-200 bg-blue-50 px-6 py-3 font-semibold text-blue-800 transition hover:border-blue-300 hover:bg-blue-100">
                        ติดต่อทีมงาน
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
