<?php

use Rocketeer\Services\Connections\ConnectionsHandler;

return [

    'application_name' => 'buktopuha',

    'plugins'          => [
    ],
    'logs'             => function (ConnectionsHandler $connections) {
        return sprintf('%s-%s-%s.log', $connections->getConnection(), $connections->getStage(), date('Ymd'));
    },
    'default'          => ['production'],
    'connections'      => [
        'production' => [
            'host'      => '02p.ru',
            'username'  => 'root',
            'password'  => '',
            'key'       => '',
            'keyphrase' => null,
            'agent'     => '',
            'db_role'   => true,
        ],
    ],
    'use_roles'        => false,
    'on'               => [
        'stages'      => [],
        'connections' => [],
    ],

];
