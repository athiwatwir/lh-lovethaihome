@props([
    'property',
    'imageIndex' => null,
])

@php
    $loadEager = false;
    $highPriority = false;
@endphp

<article class="group relative flex h-full flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-lg">
    <a
        href="{{ route('properties.show', $property->id) }}"
        class="absolute inset-0 z-0"
        aria-label="{{ $property->name }}"></a>

    <div class="pointer-events-none relative z-10 flex flex-1 flex-col">
        <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
            <x-lazy-image
                :src="$property->thumbnailOrPlaceholder()"
                :alt="$property->name"
                :eager="$loadEager"
                :high-priority="$highPriority"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />

            <div class="absolute left-3 top-3 flex flex-wrap gap-1.5">
                @if ($property->isRecommend)
                <span class="rounded-full bg-amber-500 px-2.5 py-0.5 text-xs font-semibold text-white shadow">แนะนำ</span>
                @endif
                @foreach ($property->listingLabels() as $label)
                <span class="rounded-full bg-red-700/90 px-2.5 py-0.5 text-xs font-medium text-white shadow">{{ $label }}</span>
                @endforeach
            </div>

            @if ($property->code !== '')
            <span class="absolute bottom-3 left-3 rounded-md bg-black/65 px-2 py-1 text-xs font-semibold tracking-wide text-white">
                #{{ $property->code }}
            </span>
            @endif

            @if ($property->imagesCount > 0)
            <span class="absolute bottom-3 right-3 inline-flex items-center gap-1 rounded-md bg-black/65 px-2 py-1 text-xs text-white">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $property->imagesCount }}
            </span>
            @endif
        </div>

        <div class="flex flex-1 flex-col p-4">
            <p class="text-xl font-bold text-red-700 heading-font">{{ $property->formattedPrice() }}</p>

            @if ($location = $property->formattedAddress())
            <p class="mt-1 flex items-center gap-1 text-sm text-gray-500">
                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $location }}
            </p>
            @endif

            <h3 class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-gray-800">
                {{ $property->name }}
            </h3>

            @if ($property->seller)
            <div class="pointer-events-auto relative z-20 mt-3 flex items-center justify-between gap-2 text-xs font-medium text-blue-900/70">
                <span class="truncate">{{ $property->seller['name'] ?? '' }}</span>
                @if (! empty($property->seller['phone']))
                <a href="tel:{{ preg_replace('/\D/', '', $property->seller['phone']) }}" class="shrink-0 text-blue-700 hover:underline">
                    {{ $property->seller['phone'] }}
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>
</article>
