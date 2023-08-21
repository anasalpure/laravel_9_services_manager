<?php
 
return [
    'active_sources' => [
        'newsapi',
        'guardian',
        'new_york_times',

    ],

    
    'newsapi' => [
        'key' => env('APIS_NEWSAPI_KEY')
    ],
    'guardian' => [
        'key' => env('APIS_Guardian_KEY')
    ],
    'new_york_times' => [
        'key' => env('APIS_nytimes_KEY'),
        'secret' => env('APIS_nytimes_SECRET')
    ]
];

