<?php
 
return [
    'active_sources' => [
        'newsapi',
        'guardian',
    ],

    
    'newsapi' => [
        'key' => env('APIS_NEWSAPI_KEY')
    ],
    'guardian' => [
        'key' => env('APIS_Guardian_KEY')
    ],
];

