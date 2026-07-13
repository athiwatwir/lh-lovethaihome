<!DOCTYPE html>
<html lang="th" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ไม่พบหน้านี้ (404) | Love Thai Home</title>
    <x-web-app-meta />
    <x-google-analytics />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>
<body class="max-md:pb-[calc(4.75rem+env(safe-area-inset-bottom))]">
    <x-Navbar />

    <main class="relative min-h-[70vh] overflow-hidden bg-gray-50 antialiased">
        <div class="absolute inset-0">
            <img
                src="{{ asset('images/cover/house.webp') }}"
                alt=""
                class="h-full w-full object-cover opacity-20"
                aria-hidden="true">
            <div class="absolute inset-0 bg-linear-to-b from-blue-950/80 via-blue-900/75 to-gray-50"></div>
        </div>

        <div class="relative mx-auto flex max-w-3xl flex-col items-center px-4 pb-16 pt-16 text-center sm:px-6 sm:pt-20 lg:px-8">
            <img
                src="{{ asset('images/logo/logo.png') }}"
                alt="Love Thai Home"
                class="mb-8 h-16 w-auto rounded-2xl bg-white p-2 shadow-lg sm:h-20">

            <p class="heading-font text-[6.5rem] font-black leading-none tracking-tight text-white/90 sm:text-[8rem]">
                404
            </p>

            <h1 class="heading-font mt-2 text-2xl font-bold text-white sm:text-3xl">
                ไม่พบหน้าที่คุณต้องการ
            </h1>
            <p class="mt-3 max-w-xl text-sm leading-relaxed text-blue-100 sm:text-base">
                ลิงก์อาจหมดอายุ ถูกย้าย หรือทรัพย์สินนี้ไม่มีในระบบแล้ว
                ลองกลับไปหน้าหลัก หรือค้นหาทรัพย์ที่สนใจได้เลย
            </p>

            <div class="mt-8 flex w-full max-w-md flex-col gap-3 sm:flex-row sm:justify-center">
                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-blue-900 shadow-md transition hover:-translate-y-0.5 hover:bg-blue-50"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    กลับหน้าหลัก
                </a>
                <a
                    href="{{ route('properties.index', ['zone_id' => 'all']) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-white/30 bg-white/10 px-5 py-3 text-sm font-bold text-white backdrop-blur-sm transition hover:-translate-y-0.5 hover:bg-white/20"
                >
                    ดูรายการทรัพย์
                </a>
            </div>
        </div>

        <div class="relative mx-auto max-w-4xl px-4 pb-16 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                <a
                    href="{{ route('property-requests.index') }}"
                    class="rounded-2xl border border-gray-200 bg-white p-5 text-left shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">บริการ</p>
                    <p class="heading-font mt-1 text-base font-bold text-blue-900">รับฝากขายบ้าน-ที่ดิน</p>
                    <p class="mt-1 text-sm text-gray-500">ปรึกษาฟรี ไม่มีค่าใช้จ่าย</p>
                </a>

                <a
                    href="{{ route('contact.index') }}"
                    class="rounded-2xl border border-gray-200 bg-white p-5 text-left shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-600">ติดต่อ</p>
                    <p class="heading-font mt-1 text-base font-bold text-blue-900">ติดต่อเรา</p>
                    <p class="mt-1 text-sm text-gray-500">โทร / LINE / Messenger</p>
                </a>

                <a
                    href="https://line.me/R/ti/p/@era101"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="rounded-2xl border border-[#06C755]/30 bg-[#06C755] p-5 text-left text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#05b34c]"
                >
                    <p class="text-xs font-semibold uppercase tracking-wide text-white/80">แชทด่วน</p>
                    <p class="heading-font mt-1 text-base font-bold">LINE @era101</p>
                    <p class="mt-1 text-sm text-white/85">สอบถามทรัพย์ได้ทันที</p>
                </a>
            </div>
        </div>
    </main>

    <x-Footer />
</body>
</html>
