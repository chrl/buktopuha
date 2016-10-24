<?php
namespace Chrl\AppBundle;

use Symfony\Component\DependencyInjection\Container;
use TelegramBot\Api\BotApi;

class BuktopuhaBotApi extends BotApi
{
    public function __construct(Container $container)
    {
        $token = $container->getParameter('buktopuha.config');
        parent::__construct($token['token']);
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}
