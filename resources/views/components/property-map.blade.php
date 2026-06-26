@props([
'latitude',
'longitude',
'label' => 'ตำแหน่งทรัพย์',
'googleMapsUrl',
'googleMapsDirectionsUrl',
])

@once
@push('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mapElement = document.getElementById('property-map');

        if (!mapElement || typeof L === 'undefined') {
            return;
        }

        const latitude = Number(mapElement.dataset.lat);
        const longitude = Number(mapElement.dataset.lng);
        const label = mapElement.dataset.label || 'ตำแหน่งทรัพย์';

        if (!Number.isFinite(latitude) || !Number.isFinite(longitude)) {
            return;
        }

        const map = L.map(mapElement, {
            scrollWheelZoom: false
            , tap: true
        , }).setView([latitude, longitude], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
            , attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        , }).addTo(map);

        L.marker([latitude, longitude]).addTo(map).bindPopup(label);

        const resizeMap = () => map.invalidateSize();

        resizeMap();
        window.addEventListener('resize', resizeMap);
        window.addEventListener('orientationchange', () => {
            setTimeout(resizeMap, 200);
        });
    });

</script>
@endpush
@endonce

<div class="mt-3 rounded-xl border border-blue-100 bg-blue-50/50 p-3 sm:p-4">
    <p class="text-xs font-semibold text-blue-900 sm:text-sm">แผนที่</p>

    <div id="property-map" class="mt-3 h-56 w-full overflow-hidden rounded-xl border border-gray-200 bg-gray-100 sm:h-72 z-10" data-lat="{{ $latitude }}" data-lng="{{ $longitude }}" data-label="{{ e($label) }}" role="img" aria-label="แผนที่ตำแหน่งทรัพย์"></div>

    <div class="mt-3 grid grid-cols-1 gap-2 sm:grid-cols-2">
        <a href="{{ $googleMapsUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl border border-blue-200 bg-white px-4 py-2.5 text-sm font-semibold text-blue-800 transition hover:border-blue-300 hover:bg-blue-50">
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            เปิด Google Maps
        </a>
        <a href="{{ $googleMapsDirectionsUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-800">
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A2 2 0 013 16.382V5.618a2 2 0 011.553-1.894L12 2l7.447 1.724A2 2 0 0121 5.618v10.764a2 2 0 01-1.553 1.894L12 20z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l3 2" />
            </svg>
            นำทาง
        </a>
    </div>
</div>
