<?php

namespace Chrl\AppBundle\GameAction;

use Chrl\AppBundle\Entity\Game;

class StopAction extends BaseGameAction implements GameActionInterface
{
    public function run($message, $user)
    {
        /** @var Game $game */
        $game = $this->gameService->findGame($message);

        if ($game->status == 1) {
            $game->status = 0;

            $this->gameService->em->persist($game);
            $this->gameService->em->flush();
            $this->botApi->sendMessage($message['chat']['id'], 'The game has stopped!');
        } else {
            $this->botApi->sendMessage(
                $message['chat']['id'],
                'The game is not running...Use /start command to run game.'
            );
        }
    }
}
