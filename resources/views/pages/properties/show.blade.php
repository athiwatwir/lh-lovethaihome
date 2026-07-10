@extends('layouts.home')

@php
use App\Support\PropertySeo;

$gallery = $property->galleryImages();
$listQuery = array_filter([
'zone_id' => 'all',
'asset_type_id' => $property->assetType['id'] ?? null,
]);
$breadcrumbSchemaJson = json_encode(PropertySeo::breadcrumbSchema($property), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
@endphp

@push('head')
<link rel="preconnect" href="https://office.lovethaihome.com" crossorigin>
@if (! empty($gallery[0]))
<link rel="preload" as="image" href="{{ $gallery[0] }}">
@endif
<script type="application/ld+json">
    {
        !!$breadcrumbSchemaJson!!
    }

</script>
@endpush

@section('content')
<div class="bg-gray-50 antialiased" x-data="{
        viewRecorded: false,
        init() {
            setTimeout(() => this.recordView(), 3000);
        },
        recordView() {
            if (this.viewRecorded) {
                return;
            }

            this.viewRecorded = true;

            fetch(@js(route('properties.views', $property->id)), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': @js(csrf_token()),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                keepalive: true,
            }).catch(() => {});
        },
    }">
    <section class="border-b border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
            <nav class="text-xs text-gray-500 md:text-sm" aria-label="breadcrumb">
                <ol class="flex flex-wrap items-center">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-blue-700">หน้าหลัก</a>
                    </li>
                    <li class="mx-2" aria-hidden="true">/</li>
                    <li>
                        <a href="{{ route('properties.index', $listQuery) }}" class="hover:text-blue-700">รายการทรัพย์</a>
                    </li>
                    <li class="mx-2" aria-hidden="true">/</li>
                    <li class="text-gray-800" aria-current="page">#{{ $property->code }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-4 space-y-3">


            <div class="flex flex-wrap items-start justify-between gap-2">
                <div>

                    <h1 class="heading-font mt-1 text-lg font-bold leading-snug text-gray-900 sm:text-xl md:text-2xl">
                        {{ $property->name }}
                    </h1>
                </div>
                <p class="text-2xl font-bold text-red-700 heading-font sm:text-3xl">
                    @foreach ($property->priceDisplayLines() as $priceLine)
                    <span class="block sm:inline">
                        <span class="border-s border-gray-200 px-2">{{ $priceLine['label'] }}</span>
                        <span>{{ $priceLine['value'] }}</span>
                    </span>
                    @endforeach
                </p>
            </div>
        </div>

        <div class="flex flex-col gap-8 lg:flex-row">
            {{-- Left 70% --}}
            <div class="w-full min-w-0 lg:w-[70%] lg:shrink-0">
                @if ($youtubeEmbedUrl = $property->youtubeEmbedUrl())
                <div class="mt-3 overflow-hidden rounded-2xl border border-gray-200 mb-3 bg-white shadow-sm md:mt-6">
                    <div class="border-b border-gray-100 px-3 py-3 md:px-4">
                        <h2 class="heading-font text-base font-bold text-blue-900 sm:text-lg">วิดีโอแนะนำทรัพย์</h2>
                    </div>
                    <div class="bg-black">
                        <div class="relative aspect-video w-full">
                            <iframe class="absolute inset-0 h-full w-full border-0" src="{{ $youtubeEmbedUrl }}" title="วิดีโอ {{ $property->name }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Gallery --}}
                @if (! empty($gallery))
                <x-property-gallery :images="$gallery" :alt="$property->name" />
                @endif



                {{-- Main info --}}
                <div class="mt-3 md:mt-6 rounded-xl border border-gray-200 bg-white p-2 md:p-4 shadow-sm">



                    <div class="mt-3 grid grid-cols-2 gap-4 sm:grid-cols-4">
                        @if ($property->formattedArea())
                        <div class="rounded-xl bg-gray-50 p-3 sm:p-4">
                            <p class="text-[11px] text-gray-500 sm:text-xs">พื้นที่</p>
                            <p class="mt-1 text-sm font-semibold text-gray-900 sm:text-base">{{ $property->formattedArea() }}</p>
                        </div>
                        @endif
                        @if ($property->bedroom)
                        <div class="rounded-xl bg-gray-50 p-3 sm:p-4">
                            <p class="text-[11px] text-gray-500 sm:text-xs">ห้องนอน</p>
                            <p class="mt-1 text-sm font-semibold text-gray-900 sm:text-base">{{ $property->bedroom }} ห้อง</p>
                        </div>
                        @endif
                        @if ($property->bathroom)
                        <div class="rounded-xl bg-gray-50 p-3 sm:p-4">
                            <p class="text-[11px] text-gray-500 sm:text-xs">ห้องน้ำ</p>
                            <p class="mt-1 text-sm font-semibold text-gray-900 sm:text-base">{{ $property->bathroom }} ห้อง</p>
                        </div>
                        @endif


                    </div>

                    @if ($property->formattedAddress())
                    <div class="mt-3 rounded-xl border border-blue-100 bg-blue-50/50 p-3 sm:p-4">
                        <p class="text-xs font-semibold text-blue-900 sm:text-sm">ที่ตั้ง</p>
                        <p class="mt-1 text-sm text-gray-700 sm:text-base">{{ $property->formattedAddress() }}</p>
                    </div>
                    @endif



                    <div class="mt-6 border-t border-gray-100 pt-6">
                        <p class="text-xs font-semibold text-gray-500 sm:text-sm">รหัสทรัพย์ #{{ $property->code }}</p>
                        <h2 class="heading-font text-base font-bold text-blue-900 sm:text-lg">รายละเอียดเพิ่มเติม</h2>
                        @if ($property->description)
                        <div class="article-content mt-3 min-w-0">
                            {!! $property->renderedDescription() !!}
                        </div>
                        @else
                        <p class="mt-3 leading-relaxed text-gray-700">-</p>
                        @endif
                    </div>

                    @if (! empty($property->tags))
                    <div class="rounded-xl border border-blue-100 bg-blue-50/60 p-2 sm:p-3">
                        <p class="mb-2 text-[11px] font-semibold uppercase tracking-wide text-blue-700 sm:text-xs">แท็กทำเล</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($property->tags as $tag)
                            <a href="{{ route('properties.index', ['zone_id' => 'all', 'tag_id' => $tag['id'], 'tag_name' => $tag['name']]) }}" class="inline-flex min-h-8 items-center rounded-full border border-blue-200 bg-white px-3 py-1 text-xs font-semibold text-blue-700 shadow-xs transition hover:-translate-y-0.5 hover:border-blue-300 hover:bg-blue-100 hover:text-blue-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-1">
                                #{{ $tag['name'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if ($property->hasMapCoordinates())
                    <x-property-map :latitude="$property->latitude" :longitude="$property->longitude" :label="$property->name" :google-maps-url="$property->googleMapsUrl()" :google-maps-directions-url="$property->googleMapsDirectionsUrl()" />
                    @endif


                </div>
            </div>

            {{-- Right 30% --}}
            <div class="w-full lg:w-[30%] lg:shrink-0">
                <x-property-agent-sidebar :user="$user" :property="$property" />
            </div>
        </div>
    </div>
</div>
@endsection
