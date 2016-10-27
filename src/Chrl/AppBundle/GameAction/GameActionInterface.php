<?php
/**
 * Created by PhpStorm.
 * User: chrl
 * Date: 27/10/16
 * Time: 11:00
 */

namespace Chrl\AppBundle\GameAction;


interface GameActionInterface
{
	public function run($message,$user);
}