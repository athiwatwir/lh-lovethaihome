{{--
    Hero Section Component
    Usage: <x-hero />
--}}
<section class="relative overflow-hidden bg-gradient-to-br from-primary-800 via-primary-700 to-primary-900 min-h-[520px] flex items-center">

    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-10" style="background-image: url(\" data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg' %3E%3Cg fill='none' fill-rule='evenodd' %3E%3Cg fill='%23ffffff' fill-opacity='1' %3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E\")">
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12 grid lg:grid-cols-2 gap-10 items-center relative z-10">

        {{-- Left: Text --}}
        <div>
            <h1 class="font-heading font-extrabold text-white text-4xl md:text-5xl leading-tight mb-4">
                รับฝากขายบ้าน-ที่ดิน-คอนโด<br>
                <span class="text-blue-200">และอสังหาริมทรัพย์ทุกประเภท</span>
            </h1>
            <div class="inline-block bg-blue-200 text-primary-800 font-heading font-bold text-xl px-5 py-2 rounded-lg mb-5">
                ในเขตกรุงเทพฯ และปริมณฑล
            </div>
            <p class="text-blue-100 text-base leading-relaxed mb-6 max-w-lg">
                บริษัท เบสท์แลนด์ แอนด์ เอ้าส์ซี่ รับฝากขายบ้าน-ที่ดิน-คอนโด
                และอสังหาริมทรัพย์ทุกประเภท ในเขตกรุงเทพฯ และปริมณฑล
                ภายใต้แบรนด์ ERA แฟรนไชส์ของประเทศไทย
                ด้วยประสบการณ์เกือบ 30 ปี
            </p>

            {{-- USP badges --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-8">
                @php
                $usps = [
                ['icon' => 'chart-bar', 'text' => 'โดยทีมงาน<br>มืออาชีพ'],
                ['icon' => 'users', 'text' => 'ทีมงานมีอาชีวะ<br>คุณภาพครบวงจร'],
                ['icon' => 'trending-up', 'text' => 'ขายง่ายเร็ว<br>เก็บค่าตอม 3%'],
                ['icon' => 'star', 'text' => 'ประสบการณ์<br>กว่า 30 ปี'],
                ];
                @endphp
                @foreach($usps as $usp)
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3 text-center border border-white/20">
                    <p class="text-white text-xs leading-snug font-medium">{!! $usp['text'] !!}</p>
                </div>
                @endforeach
            </div>

            {{-- CTA Buttons --}}
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('consign') }}" class="inline-flex items-center gap-2 bg-white text-primary-700 font-heading font-bold
                          px-6 py-3.5 rounded-xl hover:bg-blue-50 transition-colors shadow-lg text-base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    ปรึกษาฟรี! ไม่มีค่าใช้จ่าย
                </a>
                <a href="#search-section" class="inline-flex items-center gap-2 bg-transparent border-2 border-white text-white
                          font-heading font-semibold px-6 py-3.5 rounded-xl hover:bg-white/10 transition-colors text-base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    ค้นหาอสังหาฯ
                </a>
            </div>
        </div>

        {{-- Right: Hero image --}}
        <div class="relative hidden lg:block">
            <div class="relative">
                <img src="{{ asset('images/hero-house.jpg') }}" alt="บ้านสวยในกรุงเทพ" class="w-full rounded-2xl shadow-2xl object-cover aspect-[4/3]" onerror="this.src='https://placehold.co/600x450/1e40af/white?text=ERA+Real+Estate'">
                {{-- Floating stats card --}}
                <div class="absolute -bottom-4 -left-6 bg-white rounded-xl shadow-xl p-4 min-w-[160px]">
                    <p class="text-gray-500 text-xs">ผู้ติดตามโซเชียล</p>
                    <p class="font-heading font-extrabold text-primary-700 text-2xl">700,000+</p>
                    <p class="text-gray-500 text-xs">คนต่อเดือน</p>
                </div>
                <div class="absolute -top-4 -right-6 bg-primary-600 rounded-xl shadow-xl p-4 min-w-[140px] text-white">
                    <p class="text-blue-200 text-xs">ประสบการณ์</p>
                    <p class="font-heading font-extrabold text-3xl">30+</p>
                    <p class="text-blue-200 text-xs">ปี ในวงการ</p>
                </div>
            </div>
        </div>
    </div>
</section>
