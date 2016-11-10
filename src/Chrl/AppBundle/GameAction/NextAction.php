<?php

namespace Chrl\AppBundle\GameAction;

class NextAction extends BaseGameAction implements GameActionInterface
{
    public function run($message, $user)
    {
		$game = $this->gameService->findGame($game);

		$this->botApi->sendMessage(
			$game->chatId,
			'Ok, changing question.',
			'markdown'
		);
		$this->gameService->em->persist($game);
		$this->gameService->em->flush();
		$this->gameService->askQuestion($game);
    }
}
