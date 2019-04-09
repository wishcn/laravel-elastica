<?php

return [

    'defaultConnection' => 'default',

    "type"  => "default",

    "prefix" => env(
        "ELASTICSEARCH_PREFIX",
        str_slug(str_replace('.', '_', env('APP_NAME', 'laravel')), '_').'_elasticsearch'
    ),

    'connections' => [

        'default' => [

            'hosts' => [
                [
                    'host'      => env('ELASTICSEARCH_HOST', 'localhost'),
                    'port'      => env('ELASTICSEARCH_PORT', 9200),
                    'transport' => env('ELASTICSEARCH_SCHEME', null),
                    'username'  => env('ELASTICSEARCH_USER', null),
                    'password'  => env('ELASTICSEARCH_PASS', null),
                ],
            ],

        ],

    ],

];
