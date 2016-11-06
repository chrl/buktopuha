<?php
/**
 * Created by PhpStorm.
 * User: chrl
 * Date: 27/10/16
 * Time: 11:09
 */

namespace Chrl\AppBundle\GameAction;

use Chrl\AppBundle\BuktopuhaBotApi;
use Chrl\AppBundle\Service\GameService;

abstract class BaseGameAction implements GameActionInterface
{
    /** @var GameService */
    public $gameService;
    public $botApi;

    public function __construct(GameService $gameService, BuktopuhaBotApi $botApi)
    {
        $this->gameService = $gameService;
        $this->botApi = $botApi;
    }

    public function run($message, $user)
    {
        // TODO: Implement run() method.
    }
}
