<?php

return [
    'password' => [
        'client_id' => env('PASSWORD_CLIENT_ID', -1),
        'client_secret' => env('PASSWORD_CLIENT_SECRET', -1)
    ],
    'proxy' => [
        'grant_type'    => env('OAUTH_GRANT_TYPE'),
        'client_id'     => env('OAUTH_CLIENT_ID'),
        'client_secret' => env('OAUTH_CLIENT_SECRET'),
        'scope'          => env('OAUTH_SCOPE', '*'),
    ],

];
