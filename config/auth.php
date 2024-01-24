<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'supervisor' => [
            'driver' => 'session',
            'provider' => 'supervisors'
        ],
        'project_leads' => [
            'driver' => 'session',
            'provider' => 'project_leads'
        ]
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'supervisors' => [
            'driver' => "eloquent",
            'model' => App\Models\Supervisor::class,
        ],
        'project_leads' => [
            'driver' => "eloquent",
            'model' => App\Models\ProjectLead::class,
        ]

    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
