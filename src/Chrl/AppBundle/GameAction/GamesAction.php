<?php
/**
 * Created by PhpStorm.
 * User: chrl
 * Date: 27/10/16
 * Time: 11:08
 */

namespace Chrl\AppBundle\GameAction;


use Chrl\AppBundle\Entity\Game;

class GamesAction extends BaseGameAction implements GameActionInterface
{
	public function run($message, $user)
	{
		$games = $this->gameService->getActiveGames();

		$text = 'Current active games: '."\n";

		/** @var Game $game */
		foreach ($games as $game) {
			$text.='- '.$game->title."\n";
		}

		if (count($games)==0) {
			$text.='- No active games, sorry. Invite me into group, and press /start';
		}

		$this->botApi->sendMessage($message['chat']['id'],$text);

	}
}