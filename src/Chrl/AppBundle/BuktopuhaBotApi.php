<?php
namespace Chrl\AppBundle;

use TelegramBot\Api\BotApi;

class BuktopuhaBotApi extends BotApi
{
    public $token;

    public function __construct($config)
    {
        $this->token = $config['token'];
        parent::__construct($this->token);
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}
