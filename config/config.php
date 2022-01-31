<?php

return [
    /**
     * Upload size limit in bytes.
     */
    'max-upload-size' => [
        'general' => [
            'image' => '2048',
            'video' => '2048',
            'files' => '2048',
        ],

        'profile_picture' => '2048',
    ],

    /**
     * File expiry in seconds
     */
    'file_expiration' => env('FILE_EXPIRATION', 10 * 60),
];
