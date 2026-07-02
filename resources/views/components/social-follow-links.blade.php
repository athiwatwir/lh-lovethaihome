@php
$links = [
    [
        'name' => 'LINE',
        'handle' => '@era101',
        'href' => 'https://line.me/R/ti/p/@era101',
        'bg' => 'bg-[#06C755] hover:bg-[#05b34c]',
        'icon' => '<path fill="currentColor" d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.349 0 .63.285.63.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314" />',
    ],
    [
        'name' => 'Facebook',
        'handle' => 'ศูนย์รับฝาก',
        'href' => 'https://www.facebook.com/Lovethaihomeera',
        'bg' => 'bg-[#1877F2] hover:bg-[#166FE5]',
        'icon' => '<path fill="currentColor" d="M9.101 23.691v-9.98H6.162V11.05h2.939V8.86c0-2.906 1.775-4.49 4.37-4.49 1.242 0 2.303.092 2.615.134v3.03l-1.794.001c-1.406 0-1.677.668-1.677 1.648v2.168h3.35l-.437 3.66h-2.913v9.98H9.101z" />',
    ],
    [
        'name' => 'Facebook',
        'handle' => 'lovethaihome',
        'href' => 'https://www.facebook.com/lovethaihome1/',
        'bg' => 'bg-[#1877F2] hover:bg-[#166FE5]',
        'icon' => '<path fill="currentColor" d="M9.101 23.691v-9.98H6.162V11.05h2.939V8.86c0-2.906 1.775-4.49 4.37-4.49 1.242 0 2.303.092 2.615.134v3.03l-1.794.001c-1.406 0-1.677.668-1.677 1.648v2.168h3.35l-.437 3.66h-2.913v9.98H9.101z" />',
    ],
];
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-wrap items-start justify-center gap-5 sm:gap-6']) }}>
    @foreach ($links as $link)
        <a
            href="{{ $link['href'] }}"
            target="_blank"
            rel="noopener noreferrer"
            title="{{ $link['name'] }} — {{ $link['handle'] }}"
            aria-label="{{ $link['name'] }} — {{ $link['handle'] }}"
            class="group flex min-w-[4.5rem] flex-col items-center gap-2 text-center"
        >
            <span class="flex h-12 w-12 items-center justify-center rounded-full text-white shadow-md shadow-black/10 transition duration-200 group-hover:scale-110 group-hover:shadow-lg {{ $link['bg'] }}">
                <svg class="h-6 w-6" viewBox="0 0 24 24" aria-hidden="true">
                    {!! $link['icon'] !!}
                </svg>
            </span>
            <span class="block text-xs font-bold text-gray-900">{{ $link['name'] }}</span>
            <span class="block max-w-[5.5rem] truncate text-[11px] leading-tight text-gray-500">{{ $link['handle'] }}</span>
        </a>
    @endforeach
</div>
