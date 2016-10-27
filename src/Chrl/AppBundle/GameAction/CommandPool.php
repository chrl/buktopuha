<?php
/**
 * Created by PhpStorm.
 * User: chrl
 * Date: 27/10/16
 * Time: 10:53
 */

namespace Chrl\AppBundle\GameAction;

use Chrl\AppBundle\BuktopuhaBotApi;
use Chrl\AppBundle\Service\GameService;

class CommandPool
{

    public $gameService;
    public $botApi;

    public function __construct(BuktopuhaBotApi $botApi)
    {
        $this->botApi = $botApi;
    }

    public function setGameService(GameService $gameService)
    {
        $this->gameService = $gameService;
        return $this;
    }

    public function findAction($message)
    {
        $text = trim($message['text']);

        if (false!== strpos($text, ' ')) {
            return false;
        }

        $text = str_replace('/', '', $text);
        $text = str_replace('@'.$this->botApi->getBotName(), '', $text);
        $text='Chrl\AppBundle\GameAction\\'.ucfirst(strtolower($text)).'Action';

        if (class_exists($text, true)) {

            /** @var BaseGameAction $gameAction */

            $gameAction = new $text($this->gameService, $this->botApi);

            if ($gameAction instanceof GameActionInterface) {
                return $gameAction;
            }
        }
        return $text;
    }
}
