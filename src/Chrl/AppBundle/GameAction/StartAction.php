<?php
/**
 * Created by PhpStorm.
 * User: chrl
 * Date: 27/10/16
 * Time: 11:08
 */

namespace Chrl\AppBundle\GameAction;

use Chrl\AppBundle\Entity\Game;
use Chrl\AppBundle\Entity\Question;

class StartAction extends BaseGameAction implements GameActionInterface
{
    public function run($message, $user)
    {
		/** @var Game $game */
        $game = $this->gameService->findGame($message);

        if ($game->status == 0) {
			$game->status = 1;
			$this->gameService->em->persist($game);
			$this->gameService->em->flush();
			$this->botApi->sendMessage($message['chat']['id'], 'The game has started!');
		} else {
			$this->botApi->sendMessage($message['chat']['id'], 'The game is already running...');
			$question = $this->gameService->getRandomQuestion();
		}
    }
}
