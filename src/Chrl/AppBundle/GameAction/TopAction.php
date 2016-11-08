<?php
/**
 * Created by PhpStorm.
 * User: chrl
 * Date: 27/10/16
 * Time: 11:08
 */

namespace Chrl\AppBundle\GameAction;

use Chrl\AppBundle\Entity\Game;

class TopAction extends BaseGameAction implements GameActionInterface
{
    public function run($message, $user)
    {
        $top = $this->gameService->getTopUsers();

        $text = 'Current top 10: '."\n";
        $i = 0;

        foreach ($top as $user) {
            $text .= ++$i.') '.$user['name']." (".$user['points']." points)\n";
        }

        $this->botApi->sendMessage($message['chat']['id'], $text);
    }
}
