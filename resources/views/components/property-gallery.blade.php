@props([
    'images',
    'alt',
])

<div
    x-data="propertyGallery(@js($images))"
    @keydown.window="onKeydown($event)"
    class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
    <div class="group relative aspect-[16/10] w-full bg-gray-100">
        <button
            type="button"
            @click="openLightbox()"
            class="flex h-full w-full cursor-zoom-in items-center justify-center focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 focus-visible:ring-inset"
            aria-label="ขยายรูปภาพ">
            <img
                :src="activeImage"
                src="{{ $images[0] ?? '' }}"
                alt="{{ $alt }}"
                class="max-h-full max-w-full object-contain transition group-hover:opacity-95"
                loading="eager"
                decoding="async"
                fetchpriority="high">
        </button>

        @if (count($images) > 1)
        <button
            type="button"
            @click.stop="prev()"
            class="absolute left-2 top-1/2 z-10 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-black/50 text-white shadow-md backdrop-blur-sm transition hover:bg-black/65 focus:outline-none focus-visible:ring-2 focus-visible:ring-white sm:left-3 sm:h-11 sm:w-11"
            aria-label="รูปก่อนหน้า">
            <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <button
            type="button"
            @click.stop="next()"
            class="absolute right-2 top-1/2 z-10 inline-flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-black/50 text-white shadow-md backdrop-blur-sm transition hover:bg-black/65 focus:outline-none focus-visible:ring-2 focus-visible:ring-white sm:right-3 sm:h-11 sm:w-11"
            aria-label="รูปถัดไป">
            <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <span class="pointer-events-none absolute bottom-3 right-3 rounded-full bg-black/60 px-3 py-1.5 text-xs font-medium text-white backdrop-blur-sm">
            <span class="inline-flex items-center gap-1.5">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                </svg>
                <span x-text="(activeIndex + 1) + ' / ' + images.length"></span>
            </span>
        </span>
        @else
        <span class="pointer-events-none absolute bottom-3 right-3 rounded-full bg-black/60 px-3 py-1.5 text-xs font-medium text-white backdrop-blur-sm">
            <span class="inline-flex items-center gap-1.5">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                </svg>
                แตะเพื่อขยาย
            </span>
        </span>
        @endif
    </div>

    @if (count($images) > 1)
    <div class="flex gap-2 overflow-x-auto p-3">
        @foreach ($images as $image)
        <button
            type="button"
            @click="selectImage({{ $loop->index }})"
            @mouseenter="preloadImage(@js($image))"
            @focus="preloadImage(@js($image))"
            :class="activeIndex === {{ $loop->index }} ? 'ring-2 ring-blue-600' : 'ring-1 ring-gray-200'"
            class="flex h-20 w-28 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-gray-100 transition hover:ring-blue-400"
            aria-label="{{ $alt }} รูปที่ {{ $loop->iteration }}">
            @if ($loop->first)
            <img src="{{ $image }}" alt="{{ $alt }} รูปที่ {{ $loop->iteration }}" class="max-h-full max-w-full object-cover" loading="eager" decoding="async">
            @else
            <x-lazy-image :src="$image" :alt="$alt.' รูปที่ '.$loop->iteration" :eager="false" class="max-h-full max-w-full object-cover" />
            @endif
        </button>
        @endforeach
    </div>
    @endif

    <div
        x-show="lightboxOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[200] flex flex-col bg-black/95"
        role="dialog"
        aria-modal="true"
        :aria-label="'{{ $alt }} — รูปที่ ' + (activeIndex + 1)"
        @click.self="closeLightbox()"
        @touchstart.passive="onTouchStart($event)"
        @touchend.passive="onTouchEnd($event)">
        <div class="flex shrink-0 items-center justify-between gap-3 px-4 py-3 text-white">
            <p class="text-sm font-medium tabular-nums" x-text="(activeIndex + 1) + ' / ' + images.length"></p>
            <button
                type="button"
                @click="closeLightbox()"
                class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/10 transition hover:bg-white/20"
                aria-label="ปิด">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="relative flex min-h-0 flex-1 items-center justify-center px-14 py-2 sm:px-20">
            <template x-if="hasMultiple">
                <button
                    type="button"
                    @click.stop="prev()"
                    class="absolute left-2 top-1/2 z-10 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20 sm:left-4 sm:h-12 sm:w-12"
                    aria-label="รูปก่อนหน้า">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </template>

            <img
                :src="activeImage"
                alt="{{ $alt }}"
                class="max-h-[calc(100dvh-8rem)] max-w-full object-contain"
                decoding="async"
                @click.stop>

            <template x-if="hasMultiple">
                <button
                    type="button"
                    @click.stop="next()"
                    class="absolute right-2 top-1/2 z-10 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white/20 sm:right-4 sm:h-12 sm:w-12"
                    aria-label="รูปถัดไป">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </template>
        </div>

        <p class="shrink-0 pb-[max(0.75rem,env(safe-area-inset-bottom))] text-center text-xs text-white/70">
            ปัดซ้าย/ขวาเพื่อเปลี่ยนรูป · กด Esc เพื่อปิด
        </p>
    </div>
</div>
