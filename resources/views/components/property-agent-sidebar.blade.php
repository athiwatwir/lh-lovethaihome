@props(['user', 'property'])

<aside class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm lg:sticky lg:top-24">
    <h2 class="heading-font text-lg font-bold text-blue-900">ติดต่อตัวแทนขาย</h2>

    @if ($user)
    <div class="mt-5 text-center">
        <div class="mx-auto h-28 w-28 overflow-hidden rounded-full border-4 border-blue-100 shadow-md">
            <img src="{{ $user->profileImageOrPlaceholder() }}" alt="{{ $user->fullName() }}" class="h-full w-full object-cover">
        </div>

        <p class="heading-font mt-4 text-xl font-bold text-gray-900">{{ $user->fullName() }}</p>

    </div>

    <div class="mt-6 space-y-3">
        @if ($user->phone)
        <a href="{{ $user->telLink() }}" class="flex items-center gap-3 rounded-xl bg-blue-50 px-4 py-3 text-blue-800 transition hover:bg-blue-100">
            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-700 text-white">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                </svg>
            </span>
            <span class="font-semibold">{{ $user->phone }}</span>
        </a>
        @endif

        @if ($user->lineId)
        <div class="flex items-center gap-3 rounded-xl border border-gray-200 px-4 py-3 text-gray-700">
            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#06C755] text-xs font-bold text-white">LINE</span>
            <span>{{ $user->lineId }}</span>
        </div>
        @endif

        @if ($user->email)
        <a href="mailto:{{ $user->email }}" class="flex items-center gap-3 rounded-xl border border-gray-200 px-4 py-3 text-gray-700 transition hover:border-blue-300 hover:text-blue-700">
            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </span>
            <span class="truncate text-sm">{{ $user->email }}</span>
        </a>
        @endif

        @if ($user->id)
        <a href="{{ route('properties.index', ['user_id' => $user->id,'zone_id'=>'all']) }}" class="flex items-center justify-center gap-2 rounded-xl border-2 border-blue-200 bg-linear-to-r from-blue-50 to-indigo-50 px-4 py-3 text-sm font-semibold text-blue-800 transition hover:border-blue-400 hover:from-blue-100 hover:to-indigo-100">
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            ดูทรัพย์ทั้งหมดของ {{ $user->fullName() }}
        </a>
        @endif
    </div>
    @else
    <div class="mt-5 rounded-xl bg-gray-50 px-4 py-8 text-center text-gray-500">
        <p>ไม่พบข้อมูลตัวแทน</p>
        <p class="mt-2 text-sm">กรุณาติดต่อ 081-565-2025</p>
    </div>
    @endif

    <div class="mt-6 rounded-xl bg-blue-700 px-4 py-4 text-center text-white">
        <p class="heading-font mt-1 text-xl font-bold">ปรึกษาฟรี ไม่มีค่าใช้จ่าย!</p>
    </div>
</aside>
