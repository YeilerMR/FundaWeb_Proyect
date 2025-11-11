<?php

return [

    'driver' => env('HASH_DRIVER', 'argon2id'),

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 12),
    ],

    'argon' => [
        'memory'  => 65536, // 64MB
        'threads' => 2,
        'time'    => 4,
    ],

];
