<?php
return
    [
        "telegram" => [
            "token" => '5737718318:AAHGQlashq_MQqHI4ECu1qA-iXkzBOGxIAM', #your bot token goes here
            "group_id" => '-1001201927536' # your intended group[chat] id goes here
        ],

        "providers" => [
            \Navid\TelegramTetherBot\Classes\TetherPriceProviders\AbanTether::class =>
            [
                "name" => 'aban_tether',
                'label' => 'ابان تتر',
                'url' => 'https://abantether.com/management/all-coins',
                'logo_url' => null,
                'enabled' => true
            ],
            \Navid\TelegramTetherBot\Classes\TetherPriceProviders\SarafiTether::class =>
            [
                "name" => 'sarafi_tether',
                'label' => 'صرافی تتر',
                'url' => 'https://panel.sarafitether.com/api/prices',
                'logo_url' => null,
                'enabled' => true
            ],
            \Navid\TelegramTetherBot\Classes\TetherPriceProviders\Tetherland::class =>
            [
                "name" => 'tetherland',
                'label' => 'تترلند',
                'url' => 'https://api.tetherland.com/currencies',
                'logo_url' => null,
                'enabled' => true
            ],
            \Navid\TelegramTetherBot\Classes\TetherPriceProviders\Tetheriran::class =>
            [
                "name" => 'tetheriran',
                'label' => 'تتر ایران',
                'url' => 'https://tetheriran.com/api_usdt/W3324ds24',
                'logo_url' => null,
                'enabled' => true
            ],
            \Navid\TelegramTetherBot\Classes\TetherPriceProviders\CryptoKif::class =>
            [
                "name" => 'cryptokif',
                'label' => ' کریپتو کیف',
                'url' => 'https://cryptokif.com/api_usdt/W3324ds24',
                'logo_url' => null,
                'enabled' => true
            ]
        ]
    ];
