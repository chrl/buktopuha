<?php

use Rocketeer\Services\Connections\ConnectionsHandler;

return [

    'application_name' => 'buktopuha',

    'plugins'          => [
    ],
    'logs'             => function (ConnectionsHandler $connections) {
        return sprintf('%s-%s-%s.log', $connections->getConnection(), $connections->getStage(), date('Ymd'));
    },
    'default'          => ['staging'],
    'connections'      => [
        'production' => [
            'host'      => 'take2.ru',
            'username'  => 'root',
            'password'  => '',
            'key'       => null,
            'keyphrase' => null,
            'agent'     => '',
            'db_role'   => true,
        ],
        'staging' => [
            'host'      => 'take2.ru',
            'username'  => 'root',
            'password'  => '',
            'key'       => null,
            'keyphrase' => null,
            'agent'     => '',
            'db_role'   => true,
        ],
        
    ],
    'use_roles'        => false,
    'on'               => [
    'staging' => array(
	
    	    'root_directory' => '/home/stage/',
        
    ),
    'production' => array(
	
    	    'root_directory' => '/home/www/',
    	
    ),
    ],

];
