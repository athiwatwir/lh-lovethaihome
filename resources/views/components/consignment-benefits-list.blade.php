@props([
    'compact' => false,
    'showHeading' => true,
])

@php
$benefits = [
    [
        'title' => 'บริษัทเรามีประสบการณ์ในการขายมากกว่า 30 ปี',
        'detail' => 'มีที่อยู่อาศัยสามารถตรวจสอบได้',
    ],
    [
        'title' => 'มีโฆษณาประชาสัมพันธ์ในสื่อออนไลน์ทุกแพลตฟอร์ม',
        'detail' => 'คนมองเห็นประกาศของเรากว่า 700,000 คนต่อเดือน และจะเพิ่มขึ้นเรื่อยๆ ทุกวัน',
    ],
    [
        'title' => 'เรามีการให้คำปรึกษาเรื่องการตั้งราคาขายที่เหมาะสม (ราคาตลาด)',
        'detail' => 'สามารถขายได้ไวและได้ราคา',
    ],
    [
        'title' => 'และยังมีผู้ซื้อรอคิวซื้อทรัพย์ของท่านมากกว่า 3,000 ราย',
        'detail' => 'และจะเพิ่มขึ้นเรื่อยๆ ทุกวัน',
    ],
    [
        'title' => 'ในกรณีที่ผู้ซื้อค้นหาทรัพย์ที่อยู่ในบริเวณนั้น ก็จะเจอทรัพย์ของท่าน',
        'detail' => 'อยู่ในหน้ารายการของ Google',
    ],
    [
        'title' => 'เบื้องต้นท่านยังไม่ต้องเสียค่าใช้จ่ายแต่อย่างใด (ฟรี!)',
        'detail' => 'จนกว่าจะขายได้ ขายได้คิด 3% จากราคาคำนวณได้ (นโยบายไม่มีบวกราคาเพิ่มของค่าคอมนะคะ)',
    ],
];
@endphp

<div {{ $attributes->class([
    'rounded-2xl border border-blue-100 bg-white shadow-sm',
    'p-4 md:p-6' => ! $compact,
    'p-4' => $compact,
]) }}>
    @if ($showHeading)
    <h3 @class([
        'heading-font font-bold text-blue-800',
        'mb-4 text-center text-xl md:mb-6 md:text-2xl' => ! $compact,
        'mb-3 text-lg' => $compact,
    ])>
        ข้อดีในการฝากขายกับทางบริษัทเรา
    </h3>
    @endif

    <ul @class([
        'space-y-5' => ! $compact,
        'space-y-4' => $compact,
    ])>
        @foreach ($benefits as $index => $benefit)
        <li class="flex items-start gap-3">
            <div @class([
                'flex shrink-0 items-center justify-center rounded-full bg-blue-800 font-bold text-white',
                'mt-0.5 h-8 w-8 text-sm' => ! $compact,
                'mt-0.5 h-7 w-7 text-xs' => $compact,
            ])>
                {{ $index + 1 }}
            </div>
            <div class="min-w-0">
                <p @class([
                    'font-medium text-blue-900',
                    'text-sm md:text-base' => ! $compact,
                    'text-sm' => $compact,
                ])>
                    {{ $benefit['title'] }}
                </p>
                <p @class([
                    'mt-0.5 text-gray-600',
                    'text-sm' => ! $compact,
                    'text-xs leading-relaxed' => $compact,
                ])>
                    {{ $benefit['detail'] }}
                </p>
            </div>
        </li>
        @endforeach
    </ul>
</div>
