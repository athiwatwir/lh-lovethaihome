@extends('layouts.home')

@section('content')
<div class="bg-gray-50 antialiased">
    <section class="relative overflow-hidden border-b border-blue-100 bg-linear-to-r from-blue-900 via-blue-800 to-indigo-800 text-white">
        <img src="{{ asset('images/cover/lovethaihome-cover-knowledge.webp') }}" alt="{{ $categoryName }}" class="absolute inset-0 h-full w-full object-cover opacity-20">
        <div class="absolute inset-0 bg-linear-to-r from-blue-950/85 via-blue-900/80 to-indigo-900/75"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <nav class="mb-4 text-sm text-blue-100">
                <a href="{{ route('home') }}" class="hover:text-white">หน้าหลัก</a>
                <span class="mx-2">/</span>
                <span class="text-white">{{ $categoryName }}</span>
            </nav>

            <h1 class="heading-font text-3xl font-bold md:text-4xl">{{ $categoryName }}</h1>
            <p class="mt-3 max-w-3xl text-blue-100">บทความและสาระน่ารู้ด้านอสังหาริมทรัพย์จาก Love Thai Home</p>
        </div>
    </section>

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        @if ($categories->isNotEmpty())
            <div class="mb-8 flex flex-wrap gap-2">
                @foreach ($categories as $category)
                    <a
                        href="{{ route('articles.category', $category->id) }}"
                        @class([
                            'rounded-full px-4 py-2 text-sm font-semibold transition',
                            'bg-blue-700 text-white shadow-sm' => $categoryId === $category->id,
                            'border border-gray-200 bg-white text-gray-700 hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700' => $categoryId !== $category->id,
                        ])
                    >
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif

        @if ($apiError)
            <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                {{ $apiError }}
            </div>
        @elseif ($articles->isEmpty())
            <div class="rounded-xl border border-gray-200 bg-white px-4 py-10 text-center text-gray-500 shadow-sm">
                ยังไม่มีบทความในหมวดนี้
            </div>
        @else
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($articles as $item)
                    <a href="{{ route('articles.show', $item->id) }}" class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                        <div class="relative aspect-[16/10] overflow-hidden bg-gray-100">
                            <x-lazy-image :src="$item->coverOrPlaceholder()" :alt="$item->name" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" />
                            <span class="pointer-events-none absolute inset-0 flex items-center justify-center" aria-hidden="true">
                                <span class="flex h-11 w-11 items-center justify-center rounded-full border border-white/80 bg-black/15 text-white backdrop-blur-[2px]">
                                    <svg class="ml-0.5 h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.25" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 5.5v13l11-6.5z" />
                                    </svg>
                                </span>
                            </span>
                        </div>
                        <div class="p-4">
                            <h2 class="line-clamp-2 text-base font-bold text-blue-900 group-hover:text-blue-700">{{ $item->name }}</h2>
                        </div>
                    </a>
                @endforeach
            </div>

            @if ($paginator && $paginator->hasPages())
                <div class="mt-8">
                    {{ $paginator->links() }}
                </div>
            @endif
        @endif
    </main>
</div>
@endsection
