<?php

include dirname(__FILE__).'/parent.php';

conf::set_from_array(
    [
        'databases'             => [
            'master' => [
                'driver'   => 'pgsql',
                'host'     => '127.0.0.1',
                'user'     => 'postgres',
                'password' => 'g28XN5[V85',
            ],
        ],
        'debug_email_address'   => false,
        'support_email_address' => 'mitray.nowak@gmail.com',

        // Error reporting
        'disable_db_exceptions' => true,

        // File storage
        'file_storage_path'     => '/var/storage',
    ]
);
