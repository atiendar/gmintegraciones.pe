<?php

return [
    'name' => env('APP_NAME'),
    'manifest' => [
        'name' => env('APP_NAME'),
        'short_name' => env('APP_NAME'),
        'start_url' => env('APP_URL'),
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'icons' => [
            '72x72' => '/storage/sistema/icons/icon-72x72.png',
            '96x96' => '/storage/sistema/icons/icon-96x96.png',
            '128x128' => '/storage/sistema/icons/icon-128x128.png',
            '144x144' => '/storage/sistema/icons/icon-144x144.png',
            '152x152' => '/storage/sistema/icons/icon-152x152.png',
            '192x192' => '/storage/sistema/icons/icon-192x192.png',
            '384x384' => '/storage/sistema/icons/icon-384x384.png',
            '512x512' => '/storage/sistema/icons/icon-512x512.png'
        ],
        'splash' => [
            '640x1136' => '/storage/sistema/icons/splash-640x1136.png',
            '750x1334' => '/storage/sistema/icons/splash-750x1334.png',
            '828x1792' => '/storage/sistema/icons/splash-828x1792.png',
            '1125x2436' => '/storage/sistema/icons/splash-1125x2436.png',
            '1242x2208' => '/storage/sistema/icons/splash-1242x2208.png',
            '1242x2688' => '/storage/sistema/icons/splash-1242x2688.png',
            '1536x2048' => '/storage/sistema/icons/splash-1536x2048.png',
            '1668x2224' => '/storage/sistema/icons/splash-1668x2224.png',
            '1668x2388' => '/storage/sistema/icons/splash-1668x2388.png',
            '2048x2732' => '/storage/sistema/icons/splash-2048x2732.png',
        ],
        'custom' => []
    ]
];
