<?php

use Rocketeer\Facades\Rocketeer;

Rocketeer::before('dependencies', array(
  'composer self-update',
));


Rocketeer::after("deploy", array(
	'cp /home/deploy/shared/var/parameters.yml app/config/parameters.yml',
));

Rocketeer::after("deploy", array(
    'bin/console doctrine:schema:update --force',
));

Rocketeer::before('dependencies', function ($task) {
	$task->share('app/config/parameters.yml');
});