<?php

return [

    'route_prefixes'            => [
        'back-office' => env('ROUTE_PREFIX_BACK_OFFICE', 'admin'),
        'api'         => env('ROUTE_PREFIX_API', 'api'),
    ],

    /**
     * No. of days before unverified user can use system without
     * email verification. '0' for restriction without verification.
     */
    'email_verification_period' => 7,

];
