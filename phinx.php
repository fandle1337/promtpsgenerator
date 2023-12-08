<?php

require_once "./config/bootstrap.php";

return
    [
        'paths'         => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
            'seeds'      => '%%PHINX_CONFIG_DIR%%/database/seeds'
        ],
        'environments'  => [
            'default_migration_table' => 'phinxlog',
            'default_environment'     => 'development',
            'development'             => [
                'adapter' => 'mysql',
                'host'    => $_ENV['DB_HOSTNAME'],
                'name'    => $_ENV['DB_NAME'],
                'user'    => $_ENV['DB_LOGIN'],
                'pass'    => $_ENV['DB_PASSWORD'],
                'port'    => '3306',
                'charset' => 'utf8',
            ],
        ],
        'version_order' => 'creation'
    ];
