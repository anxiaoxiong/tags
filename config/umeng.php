<?php

return [
    'ios_app_key'               => env('UMENG_IOS_APP_KEY',''),
    'ios_app_master_secret'     => env('UMENG_IOS_MS',''),
    'android_app_key'           => env('UMENG_ANDROID_APP_KEY',''),
    'android_app_master_secret' => env('UMENG_ANDROID_MS',''),
    'production_mode'           =>  env('UMENG_MODE', false)
];
