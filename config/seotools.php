<?php

$siteTitle = 'Love Thai Home: แหล่งรับฝาก-ขายบ้าน-ที่ดิน และอสังหาฯ ในเขตกรุงเทพฯ และปริมณฑล';
$siteDescription = 'รับฝากขายบ้าน ที่ดิน คอนโด และอสังหาริมทรัพย์ทุกประเภท ในเขตกรุงเทพฯ และปริมณฑล';

return [
    'meta' => [
        'defaults' => [
            'title' => $siteTitle,
            'description' => $siteDescription,
            'separator' => ' - ',
            'keywords' => [
                'บ้าน',
                'บ้านมือสอง',
                'บ้านใหม่',
                'คอนโด'
            ],
        ],
    ],
    'opengraph' => [
        'defaults' => [
            'title' => $siteTitle,
            'description' => $siteDescription,
            'site_name' => $siteTitle,
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card' => 'summary_large_image',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title' => $siteTitle,
            'description' => $siteDescription,
            'type' => false,
        ],
    ],
];
