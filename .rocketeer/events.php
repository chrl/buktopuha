<?php

use Rocketeer\Facades\Rocketeer;

Rocketeer::before('dependencies', array(
  'composer self-update',
));