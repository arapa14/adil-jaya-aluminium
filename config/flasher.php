<?php

return [
    'default' => 'theme.ruby',

    'drivers' => [
        'flasher' => [
            'root' => env('FLASHER_ROOT', base_path('vendor/flasher')),
            'translate' => env('FLASHER_TRANSLATE', true),
            'inject_assets' => env('FLASHER_INJECT_ASSETS', true),
            'options' => [
                'position' => 'top-center',
            ],
        ],
    ],

    'themes' => [
        'theme.ruby' => [
            'scripts' => [
                '/vendor/flasher/flasher.min.css',
                '/vendor/flasher/themes/theme.ruby.min.js',
            ],
            'styles' => [
                '/vendor/flasher/themes/theme.ruby.min.css',
            ],
        ],
    ],

    'presets' => [
        // Your custom presets here
    ],
];
