@extends('layouts.home')

@section('content')
<div class="bg-gray-50 antialiased">
    <section class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <nav class="text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-blue-600">หน้าหลัก</a>
                <span class="mx-2">/</span>
                @if ($article->category)
                <a href="{{ route('articles.category', $article->category['id']) }}" class="hover:text-blue-600">
                    {{ $article->category['name'] }}
                </a>
                <span class="mx-2">/</span>
                @endif
                <span class="text-gray-700">{{ $article->name }}</span>
            </nav>

            <h1 class="heading-font mt-4 text-2xl font-bold text-blue-900 md:text-3xl">{{ $article->name }}</h1>
        </div>
    </section>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[minmax(0,1fr)_20rem] xl:grid-cols-[minmax(0,1fr)_22rem]">
            <div class="min-w-0">
                <article class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm md:p-8">
                    @if ($article->renderedText())
                    <div class="article-content">
                        {!! $article->renderedText() !!}
                    </div>
                    @else
                    <p class="text-gray-500">ไม่มีเนื้อหาบทความ</p>
                    @endif
                </article>

                @if ($article->category)
                <div class="mt-6 lg:hidden">
                    <a href="{{ route('articles.category', $article->category['id']) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-700 hover:text-blue-800">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        กลับไปหน้ารายการบทความ
                    </a>
                </div>
                @endif
            </div>

            @if ($relatedArticles->isNotEmpty())
            <aside class="lg:sticky lg:top-24 lg:self-start">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <h2 class="heading-font text-lg font-bold text-blue-900">
                        บทความในหมวดเดียวกัน
                    </h2>
                    @if ($article->category)
                    <p class="mt-1 text-sm text-gray-500">{{ $article->category['name'] }}</p>
                    @endif

                    <ul class="mt-4 space-y-2">
                        @foreach ($relatedArticles as $related)
                        <li>
                            <a href="{{ route('articles.show', $related->id) }}" class="group flex items-center gap-3 rounded-xl border border-transparent p-2 transition hover:border-gray-200 hover:bg-gray-50">
                                <span class="h-14 w-20 shrink-0 overflow-hidden rounded-lg bg-gray-100">
                                    <x-lazy-image
                                        :src="$related->coverOrPlaceholder()"
                                        :alt="$related->name"
                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                    />
                                </span>
                                <span class="min-w-0 flex-1 text-sm leading-snug text-gray-700 transition group-hover:text-blue-700">
                                    {{ $related->name }}
                                </span>
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    @if ($article->category)
                    <a href="{{ route('articles.category', $article->category['id']) }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-blue-700 hover:text-blue-800">
                        ดูทั้งหมด
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    @endif
                </div>
            </aside>
            @endif
        </div>
    </main>
</div>
@endsection
